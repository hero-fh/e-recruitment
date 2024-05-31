<?php
require_once('../config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
class Users extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	public function save_users()
	{
		extract($_POST);
		$oid = $id;
		$data = '';
		if (isset($oldpassword)) {
			if (md5($oldpassword) != $this->settings->userdata('password')) {
				return 4;
			}
		}
		$chk = $this->conn->query("SELECT * FROM `users` where username ='{$username}' " . ($id > 0 ? " and id!= '{$id}' " : ""))->num_rows;
		if ($chk > 0) {
			return 3;
			exit;
		}
		foreach ($_POST as $k => $v) {
			if (in_array($k, array('firstname', 'middlename', 'lastname', 'username', 'type'))) {
				if (!empty($data)) $data .= " , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if (!empty($password)) {
			$password = md5($password);
			if (!empty($data)) $data .= " , ";
			$data .= " `password` = '{$password}' ";
		}

		if (empty($id)) {
			$qry = $this->conn->query("INSERT INTO users set {$data}");
			if ($qry) {
				$id = $this->conn->insert_id;
				$this->settings->set_flashdata('success', 'User Details successfully saved.');
				$resp['status'] = 1;
			} else {
				$resp['status'] = 2;
			}
		} else {
			$qry = $this->conn->query("UPDATE users set $data where id = {$id}");
			if ($qry) {
				$this->settings->set_flashdata('success', 'User Details successfully updated.');
				if ($id == $this->settings->userdata('id')) {
					foreach ($_POST as $k => $v) {
						if ($k != 'id') {
							if (!empty($data)) $data .= " , ";
							$this->settings->set_userdata($k, $v);
						}
					}
				}
				$resp['status'] = 1;
			} else {
				$resp['status'] = 2;
			}
		}
		if ($resp['status'] == 1) {
			$data = "";
			foreach ($_POST as $k => $v) {
				if (!in_array($k, array('id', 'firstname', 'middlename', 'lastname', 'username', 'password', 'type', 'oldpassword'))) {
					if (!empty($data)) $data .= ", ";
					$v = $this->conn->real_escape_string($v);
					$data .= "('{$id}','{$k}', '{$v}')";
				}
			}
			if (!empty($data)) {
				$this->conn->query("DELETE * FROM `user_meta` where user_id = '{$id}' ");
				$save = $this->conn->query("INSERT INTO `user_meta` (user_id,`meta_field`,`meta_value`) VALUES {$data}");
				if (!$save) {
					$resp['status'] = 2;
					if (empty($oid)) {
						$this->conn->query("DELETE * FROM `users` where id = '{$id}' ");
					}
				}
			}
		}

		if (isset($_FILES['pdf']) && $_FILES['pdf']['tmp_name'] != '') {
			$fname = 'uploads/avatar-' . $id . '.png';
			$dir_path = base_app . $fname;
			$upload = $_FILES['pdf']['tmp_name'];
			$type = mime_content_type($upload);
			$allowed = array('image/png', 'image/jpeg');
			if (!in_array($type, $allowed)) {
				$resp['msg'] .= " But Image failed to upload due to invalid file type.";
			} else {
				$new_height = 200;
				$new_width = 200;

				list($width, $height) = getimagesize($upload);
				$t_image = imagecreatetruecolor($new_width, $new_height);
				imagealphablending($t_image, false);
				imagesavealpha($t_image, true);
				$gdpdf = ($type == 'image/png') ? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
				imagecopyresampled($t_image, $gdpdf, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				if ($gdpdf) {
					if (is_file($dir_path))
						unlink($dir_path);
					$uploaded_pdf = imagepng($t_image, $dir_path);
					imagedestroy($gdpdf);
					imagedestroy($t_image);
				} else {
					$resp['msg'] .= " But Image failed to upload due to unkown reason.";
				}
			}
			if (isset($uploaded_pdf)) {
				$this->conn->query("UPDATE users set `avatar` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}' ");
				if ($id == $this->settings->userdata('id')) {
					$this->settings->set_userdata('avatar', $fname);
				}
			}
		}
		if (isset($resp['msg']))
			$this->settings->set_flashdata('success', $resp['msg']);
		return  $resp['status'];
	}
	public function delete_users()
	{
		extract($_POST);
		$avatar = $this->conn->query("SELECT avatar FROM users where id = '{$id}'")->fetch_array()['avatar'];
		$qry = $this->conn->query("DELETE FROM users where id = $id");
		if ($qry) {
			$avatar = explode("?", $avatar)[0];
			$this->settings->set_flashdata('success', 'User Details successfully deleted.');
			if (is_file(base_app . $avatar))
				unlink(base_app . $avatar);
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}
	public function save_client()
	{
		extract($_POST);
		if (!empty($position)) {
			foreach ($position as $k => $v) {
				$start[$k] = isset($start[$k]) ? $start[$k] . '-01' : null;
				$end[$k] = isset($end[$k]) ? $end[$k] . '-01' : null;
				if (strtotime($start[$k]) > strtotime($end[$k])) {
					$resp['status'] = 'failed';
					$resp['msg'] = 'Error in Work Experience Date' . $this->conn->error;
					return json_encode($resp);
				}
			}
		}
		if (!empty($email)) {
			$chked = $this->conn->query("SELECT * FROM `applicants` WHERE email = '{$email}' " . ($id > 0 ? "AND id != '{$id}'" : ""))->num_rows;
			if ($chked > 0) {
				$resp['status'] = 'failed';
				$resp['msg'] = 'Email Already Taken' . $this->conn->error;
				return json_encode($resp);
			}
		}

		$data = "";
		$q_fields = [
			'id', 'firstname', 'middlename', 'surname', 'nickname', 'birthdate', 'age', 'mobile_number',
			'region', 'province', 'city', 'barangay', 'current_address', 'zip',
			'perma_region', 'perma_province', 'perma_city', 'perma_barangay', 'permanent_address', 'perma_zip',
			'gender', 'height', 'weight',
			'religion', 'dialect_spoken', 'hobbies', 'talent', 'email', 'license', 'philhealth', 'tin', 'sss',
			'sssloan', 'pagibig', 'pagibigloan', 'civil_status', 'children', 'caretaker', 'spouse', 'occupation1', 'age1',
			'father', 'occupation2', 'age2', 'mother', 'occupation3', 'age3', 'contact_person', 'contact_person_number',
			'relationship',  'relative', 'shifting_schedule', 'education', 'course',
			'computer_literate', 'tor', 'shs_diploma', 'hs_diploma', 'form137', 'gap', 'fb', 'attendance', 'vaccine', 'firstdose',
			'seconddose', 'lgu', 'remarks', 'pending_application', 'expected_salary', 'application', 'position_name', 'status', 'unfit_remarks'
		];
		foreach ($_POST as $k => $v) {
			if (in_array($k, $q_fields)) {
				// if (!empty($data)) $data .= ",";
				// $data .= " `{$k}`='{$this->conn->real_escape_string($v)}' ";
				if (!empty($data)) $data .= ",";
				$v = !empty($v) ? addslashes($v) : null;
				$data .= "`{$k}`" . ($v !== null ? "='{$v}'" : " = NULL");
			}
		}
		// var_dump($data);
		// $data = "";
		// foreach ($_POST as $k => $v) {
		// 	if (!in_array($k, array('id', 'medical', 'award'))) {
		// 		if (!empty($data)) $data .= ",";
		// 		$v = !empty($v) ? addslashes($v) : null;
		// 		$data .= "`{$k}`" . ($v !== null ? "='{$v}'" : " = NULL");
		// 	}
		// }

		if (isset($_POST['medical'])) {
			if (!empty($data)) $data .= ",";
			$medical = !empty($medical) ? addslashes(htmlentities($medical)) : null;
			$data .= "`medical`='{$medical}'";
		}

		if (isset($_POST['award'])) {
			if (!empty($data)) $data .= ",";
			$award = !empty($award) ? addslashes(htmlentities($award)) : null;
			$data .= "`award`='{$award}'";
		}

		if (!isset($_POST['perma_region'])) {
			if (!empty($data)) $data .= ",";
			$region = !empty($region) ? addslashes(htmlentities($region)) : null;
			$data .= "`perma_region`='{$region}'";
		}
		if (!isset($_POST['perma_province'])) {
			if (!empty($data)) $data .= ",";
			$province = !empty($province) ? addslashes(htmlentities($province)) : null;
			$data .= "`perma_province`='{$province}'";
		}
		if (!isset($_POST['perma_city'])) {
			if (!empty($data)) $data .= ",";
			$city = !empty($city) ? addslashes(htmlentities($city)) : null;
			$data .= "`perma_city`='{$city}'";
		}
		if (!isset($_POST['perma_barangay'])) {
			if (!empty($data)) $data .= ",";
			$barangay = !empty($barangay) ? addslashes(htmlentities($barangay)) : null;
			$data .= "`perma_barangay`='{$barangay}'";
		}
		if (!isset($_POST['permanent_address'])) {
			if (!empty($data)) $data .= ",";
			$current_address = !empty($current_address) ? addslashes(htmlentities($current_address)) : null;
			$data .= "`permanent_address`='{$current_address}'";
		}
		if (!isset($_POST['perma_zip'])) {
			if (!empty($data)) $data .= ",";
			$zip = !empty($zip) ? addslashes(htmlentities($zip)) : null;
			$data .= "`perma_zip`='{$zip}'";
		}

		// var_dump($data);
		if (empty($id)) {
			$save = $this->conn->query("INSERT INTO `applicants` set $data");

			if ($save) {
				foreach ($_POST as $k => $v) {
					$this->settings->set_userdata($k, $v);
				}
				$this->settings->set_userdata('id', $this->conn->insert_id);
				$qid = empty($id) ? $this->conn->insert_id : $id;
				$saver = $this->conn->query("INSERT INTO `applicant_score` SET `total_score` = 1, `applicant_id` = {$qid}");
				if (!empty($sibling_name) && !(is_array($sibling_name) && count($sibling_name) === 1 && $sibling_name[0] === "")) {
					$data = "";
					foreach ($sibling_name as $k => $v) {
						$v = empty($v) ? NULL : $v;
						$sibling_occupation[$k] = isset($sibling_occupation[$k]) ? $sibling_occupation[$k] : '';
						$sibling_age[$k] = isset($sibling_age[$k]) ? $sibling_age[$k] : 0;
						$sibling_occupation[$k] = $this->conn->real_escape_string($sibling_occupation[$k]);
						if (!empty($data)) $data .= ",";
						$data .= "('{$qid}','{$sibling_name[$k]}','{$sibling_occupation[$k]}','{$sibling_age[$k]}')";
					}

					if (!empty($data)) {
						$this->conn->query("DELETE FROM `sibling` where `applicant_id` = '{$qid}'");
						$sql2 =  $this->conn->query("INSERT INTO `sibling` (`applicant_id`,`sibling_name`,`sibling_occupation`,`sibling_age`) VALUES {$data}");
						if ($sql2) {
							$resp['status'] = 'success';
						} else {
							$resp['status'] = 'failed';
							$resp['error'] = $this->conn->error;
						}
					}
				}
				if (!empty($position) && !(is_array($position) && count($position) === 1 && $position[0] === "")) {
					// $qid =  $id;
					$data = "";

					foreach ($position as $k => $v) {
						$v = empty($v) ? NULL : $v;
						$company[$k] = isset($company[$k]) ? $company[$k] : '';
						$company_address[$k] = isset($company_address[$k]) ? $company_address[$k] : '';
						$start[$k] = isset($start[$k]) ? $start[$k] . '-01' : '';
						$end[$k] = isset($end[$k]) ? $end[$k] . '-01' : '';
						$reason[$k] = isset($reason[$k]) ? $reason[$k] : '';
						$last_contact_person[$k] = isset($last_contact_person[$k]) ? $last_contact_person[$k] : '';
						$reason[$k] = $this->conn->real_escape_string($reason[$k]);
						$company[$k] = $this->conn->real_escape_string($company[$k]);
						$company_address[$k] = $this->conn->real_escape_string($company_address[$k]);
						if (!empty($data)) $data .= ",";
						$data .= "('{$qid}','{$position[$k]}','{$company[$k]}','{$company_address[$k]}','{$start[$k]}','{$end[$k]}','{$reason[$k]}','{$last_contact_person[$k]}')";
					}
					// var_dump($data);

					if (!empty($data)) {
						$this->conn->query("DELETE FROM `work_experience` where `applicant_id` = '{$qid}'");
						$sql2 =  $this->conn->query("INSERT INTO `work_experience` (`applicant_id`,`position`,`company`,`company_address`,`start`,`end`,`reason`,`last_contact_person`) VALUES {$data}");
						if ($sql2) {
							$resp['status'] = 'success';
						} else {
							$resp['status'] = 'failed';
							$resp['error'] = $this->conn->error;
						}
					}
				}
				if (!empty($booster) && !(is_array($booster) && count($booster) === 1 && $booster[0] === "")) {
					// $qid =  $id;
					$data = "";
					foreach ($booster as $k => $v) {
						$v = empty($v) ? NULL : $v;
						$booster[$k] = isset($booster[$k]) ? $booster[$k] : '';
						$dose[$k] = isset($dose[$k]) ? $dose[$k] : '';
						$lgu1[$k] = isset($lgu1[$k]) ? $lgu1[$k] : '';
						$lgu1[$k] = $this->conn->real_escape_string($lgu1[$k]);
						$booster[$k] = $this->conn->real_escape_string($booster[$k]);
						if (!empty($data)) $data .= ",";
						$data .= "('{$qid}','{$booster[$k]}','{$dose[$k]}','{$lgu1[$k]}')";
					}
					if (!empty($data)) {
						$this->conn->query("DELETE FROM `booster` where `applicant_id` = '{$qid}'");
						$sql2 =  $this->conn->query("INSERT INTO `booster` (`applicant_id`,`booster`,`dose`,`lgu1`) VALUES {$data}");
						if ($sql2) {
							$resp['status'] = 'success';
						} else {
							$resp['status'] = 'failed';
							$resp['error'] = $this->conn->error;
						}
					}
				}
				// var_dump($certificate);

				if (!empty($certificate) && !(is_array($certificate) && count($certificate) === 1 && $certificate[0] === "")) {
					// $qid =  $id;
					$data = "";
					foreach ($certificate as $k => $v) {
						$v = empty($v) ? NULL : $v;
						$certificate[$k] = isset($certificate[$k]) ? $certificate[$k] : '';
						$year_attended[$k] = isset($year_attended[$k]) ? $year_attended[$k] . '-01' : '';
						$year_attended[$k] = $this->conn->real_escape_string($year_attended[$k]);
						$certificate[$k] = $this->conn->real_escape_string($certificate[$k]);
						if (!empty($data)) $data .= ",";
						$data .= "('{$qid}','{$certificate[$k]}','{$year_attended[$k]}')";
						// $data .= "`{$k}`" . ($v !== null ? "='{$v}'" : " = NULL");
					}
					if (!empty($data)) {
						$this->conn->query("DELETE FROM `training` where `applicant_id` = '{$qid}'");
						$sql2 =  $this->conn->query("INSERT INTO `training` (`applicant_id`,`certificate`,`year_attended`) VALUES {$data}");
						if ($certificate == '') {
							$this->conn->query("DELETE FROM `training` where `applicant_id` = '{$qid}'");
						}
						if ($sql2) {
							$resp['status'] = 'success';
						} else {
							$resp['status'] = 'failed';
							$resp['error'] = $this->conn->error;
						}
					}
				}

				if (empty($sibling) && empty($position) && empty($booster)) {
					$resp['status'] = 'success';
				}
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
			}
		} else {
			$save = $this->conn->query("UPDATE `applicants` set $data WHERE `id` = '{$id}'");
			if ($save) {
				$resp['id'] = $id;
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = 'An error occured. Error: ' . $this->conn->error;
			}
		}


		if ($save) {
			$resp['status'] = 'success';
			$resp['application'] = $application;
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	public function delete_client()
	{
		extract($_POST);
		$avatar = $this->conn->query("SELECT avatar FROM applicants where id = '{$id}'")->fetch_array()['avatar'];
		$qry = $this->conn->query("DELETE FROM applicants where id = $id");
		if ($qry) {
			$avatar = explode("?", $avatar)[0];
			$this->settings->set_flashdata('success', 'Client has successfully deleted.');
			if (is_file(base_app . $avatar))
				unlink(base_app . $avatar);
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}
	function accept_()
	{
		extract($_POST);
		if ($sign == 1) {
			$del = $this->conn->query("UPDATE `applicants` set `job_offer` = '{$val}' where id = '{$id}'");
		} elseif ($sign == 2) {
			$del = $this->conn->query("UPDATE `applicants` set `job_offer` = '{$val}' where id = '{$id}'");
		}

		if ($del) {
			$resp['id'] = $id;
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Job offer succesfully updated.");
		} else {
			$resp['id'] = $id;
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function assess_client()
	{
		extract($_POST);
		$data = "";
		$q_fields = [
			'id',   'date', 'a_position', 'rating', 'a_remarks', 'conducted_by', 'rating1',
			'rating2', 'rating3', 'rating4', 'comment', 'interview', 'position1', 'date1', 'decide', 'commencement', 'noted',
			'approve', 'prf_no'
		];
		foreach ($_POST as $k => $v) {
			if (in_array($k, $q_fields)) {
				// if (!empty($data)) $data .= ",";
				// $data .= " `{$k}`='{$this->conn->real_escape_string($v)}' ";
				if (!empty($data)) $data .= ",";
				$v = !empty($v) ? addslashes($v) : null;
				$data .= "`{$k}`" . ($v !== null ? "='{$v}'" : " = NULL");
			}
		}
		if (isset($_POST['name'])) {
			if (!empty($data)) $data .= ",";
			$name = !empty($name) ? ucwords(strtolower($name)) : null;
			$data .= "`name`='{$name}'";
		}
		// $data = " applicant_id = '" . $this->settings->userdata('id') . "' ";
		// $data = '';
		// foreach ($_POST as $k => $v) {
		// 	// if (!empty($data)) $data .= ",";
		// 	// $data .= " `{$k}`='{$v}' ";
		// 	if (!empty($data)) $data .= ",";
		// 	$v = !empty($v) ? addslashes($v) : null;
		// 	$data .= "`{$k}`" . ($v !== null ? "='{$v}'" : " = NULL");
		// }
		// var_dump($data);l
		// $data = " applicant_id = '{$applicant_id}' ";
		// $current_applicant_id = $_POST['id'];
		$check = $this->conn->query("SELECT * FROM `assessment` where `id` ='{$id}' ")->num_rows;
		// $check = $this->conn->query("SELECT * FROM `assessment` where `applicant_id` = '{$applicant_id}'  ")->num_rows;
		if ($check > 0) {
			// $sql = "INSERT INTO `assessment` set {$data} ";
			$sql = ("UPDATE `assessment` set {$data} where `id` = '{$id}'");
		} else {
			$sql = "INSERT INTO `assessment` set {$data} ";
			// $sql1 = ("UPDATE `applicants` set `assess` = 1 where `id` = '{$id}'");
			$qry = $this->conn->query("UPDATE applicants set assess = 1 where id = {$id}");
		}

		if (!empty($comment1)) {
			// $qid =  $id;
			// var_dump($_POST['rating5']);
			$data = "";
			foreach ($rating5 as $k => $v) {
				$v = empty($v) ? NULL : $v;
				$aid = empty($id) ? $this->conn->insert_id : $id;
				$rate5[$k] = isset($rating5[$k]) ? $rating5[$k] : '';
				$rate6[$k] = isset($rating6[$k]) ? $rating6[$k] : '';
				$rate7[$k] = isset($rating7[$k]) ? $rating7[$k] : '';
				$rate8[$k] = isset($rating8[$k]) ? $rating8[$k] : '';
				$expected[$k] = isset($expected[$k]) ? $expected[$k] : '';
				$recommended[$k] = isset($recommended[$k]) ? $recommended[$k] : '';
				$com[$k] = $this->conn->real_escape_string($comment1[$k]);
				$inter[$k] = isset($interview1[$k]) ? $interview1[$k] : '';
				$pos2[$k] = isset($position2[$k]) ? $position2[$k] : '';
				$dat2[$k] = $this->conn->real_escape_string($date2[$k]);
				$choose[$k] = isset($choose[$k]) ? $choose[$k] : '';
				$recommended_pos[$k] = isset($recommended_pos[$k]) ? $recommended_pos[$k] : $a_position;
				$recommended_pos[$k] = $this->conn->real_escape_string($recommended_pos[$k]);
				if (!empty($data)) $data .= ",";
				$data .= "('{$aid}','{$rate5[$k]}','{$rate6[$k]}','{$rate7[$k]}','{$rate8[$k]}','{$com[$k]}','{$inter[$k]}','{$pos2[$k]}','{$dat2[$k]}','{$choose[$k]}','{$expected[$k]}','{$recommended[$k]}','{$recommended_pos[$k]}')";
			}
			if (!empty($data)) {
				$this->conn->query("DELETE FROM `add_interview` where `assessment_id` = '{$id}'");
				$sql2 =  $this->conn->query("INSERT INTO `add_interview` (`assessment_id`,`rate5`,`rate6`,`rate7`,`rate8`,`com`,`inter`,`pos2`,`dat2`,`choose`,`expected`,`recommended`,`recommended_pos`) VALUES {$data}");
				$sss = $this->conn->query("UPDATE `assessment` SET `rating5` = '{$rating5[$k]}', `rating6` = '{$rating6[$k]}', `rating7` = '{$rating7[$k]}', `rating8` = '{$rating8[$k]}', `comment1` = '{$comment1[$k]}', `interview1` = '{$interview1[$k]}', `position2` = '{$position2[$k]}', `date2` = '{$date2[$k]}', `choose` = '{$choose[$k]}', `expected` = '{$expected[$k]}', `recommended` = '{$recommended[$k]}', `recommended_pos` = '{$recommended_pos[$k]}' WHERE `id` = '{$aid}'");
				$sss1 = $this->conn->query("UPDATE `applicants` SET `recommended_pos` = '{$recommended_pos[$k]}' WHERE `id` = '{$aid}'");
				// var_dump($data);
				// $sss =  $this->conn->query("UPDATE `assessment` SET (`assessment_id`,`rating5`,`rating6`,`rating7`,`rating8`,`comment1`,`interview1`,`position2`,`date2`,`choice`) VALUES {$data}");
				if ($sql2) {
					$resp['status'] = 'success';
				} else {
					$resp['status'] = 'failed';
					$resp['error'] = $this->conn->error;
				}
			}
		}
		$up_p = $this->conn->query("UPDATE applicants set passed = {$a_remarks} where id = {$id}");
		$save = $this->conn->query($sql);

		if ($save) {
			$resp['status'] = 'success';
			$resp['id'] = $id;
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
			$resp['id'] = $id;
		}
		return json_encode($resp);
	}
	function author_pass()
	{

		extract($_POST);
		$data = '';
		foreach ($_POST as $k => $v) {
			if (!empty($data)) $data .= ",";
			$v = !empty($v) ? addslashes($v) : null;
			$data .= "`{$k}`" . ($v !== null ? "='{$v}'" : " = NULL");
		}
		$insertQuery = $this->conn->query("UPDATE employee_masterlist set USERNAME='$USERNAME',password='{$_POST['PASSWORD']}' where EMPLOYID = {$EMPLOYID}");
		// var_dump($data);
		// var_dump($newusername);
		// var_dump($$_POST['USERNAME']);
		if ($insertQuery) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', 'Account successfully saved.');
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$insertQuery}]";
		}
		return json_encode($resp);
	}
}

$users = new users();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'save':
		echo $users->save_users();
		break;
	case 'delete':
		echo $users->delete_users();
		break;
	case 'save_client':
		echo $users->save_client();
		break;;
	case 'delete_client':
		echo $users->delete_client();
		break;
	case 'accept_':
		echo $users->accept_();
		break;
	case 'assess_client':
		echo $users->assess_client();
		break;
	case 'author_pass':
		echo $users->author_pass();
		break;

	default:
		// echo $sysset->index();
		break;
}
