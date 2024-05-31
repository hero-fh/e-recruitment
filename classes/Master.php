<?php
require_once('../config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


class Master extends DBConnection
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
	function capture_err()
	{
		if (!$this->conn->error)
			return false;
		else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_category()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$this->conn->real_escape_string($v)}' ";
			}
		}

		$check = $this->conn->query("SELECT * FROM `category_list` where `name` = '{$name}'  " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Category already exists.";
		} else {
			if (empty($id)) {
				$sql = "INSERT INTO `category_list` set {$data} ";
			} else {
				$sql = "UPDATE `category_list` set {$data} where id = '{$id}' ";
			}
			$save = $this->conn->query($sql);
			if ($save) {
				$resp['status'] = 'success';
				if (empty($id))
					$resp['msg'] = " New Category successfully saved.";
				else
					$resp['msg'] = " Category successfully updated.";
			} else {
				$resp['status'] = 'failed';
				$resp['err'] = $this->conn->error . "[{$sql}]";
			}
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function holiday()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$this->conn->real_escape_string($v)}' ";
			}
		}

		$check = $this->conn->query("SELECT * FROM `holiday_list` where `holiday` = '{$holiday}'  " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "holiday already exists.";
		} else {
			if (empty($id)) {
				$sql = "INSERT INTO `holiday_list` set {$data} ";
			} else {
				$sql = "UPDATE `holiday_list` set {$data} where id = '{$id}' ";
			}
			$save = $this->conn->query($sql);
			if ($save) {
				$resp['status'] = 'success';
				if (empty($id))
					$resp['msg'] = " New holiday successfully saved.";
				else
					$resp['msg'] = " holiday successfully updated.";
			} else {
				$resp['status'] = 'failed';
				$resp['err'] = $this->conn->error . "[{$sql}]";
			}
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function save_position()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$this->conn->real_escape_string($v)}' ";
			}
		}

		$check = $this->conn->query("SELECT * FROM `position` where `position` = '{$position}'  " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Position already exists.";
		} else {
			if (empty($id)) {
				$sql = "INSERT INTO `position` set {$data} ";
			} else {
				$sql = "UPDATE `position` set {$data} where id = '{$id}' ";
			}
			$save = $this->conn->query($sql);
			if ($save) {
				$resp['status'] = 'success';
				if (empty($id))
					$resp['msg'] = " New position successfully saved.";
				else
					$resp['msg'] = " position successfully updated.";
			} else {
				$resp['status'] = 'failed';
				$resp['err'] = $this->conn->error . "[{$sql}]";
			}
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function save_test()
	{

		extract($_POST);
		$data = '';
		foreach ($_POST as $k => $v) {
			// $v = str_replace(' ', '', $v);
			$v = trim($v);
			if (!empty($data)) $data .= ",";
			$data .= " `{$k}`='{$v}' ";
		}
		// str_replace(' ', '', $data);
		// var_dump($data);
		if (empty($id)) {
			$sql = "INSERT INTO `enumeration` set {$data} ";
		} else {
			$sql = "UPDATE `enumeration` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if ($save) {

			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			if (empty($id))
				$resp['msg'] = " Test II has failed to save.";
			else
				$resp['msg'] = " Test II has failed to update.";
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		if ($resp['status'] == 'success')
			// $this->settings->set_flashdata('success', $resp['msg']);
			return json_encode($resp);
	}

	function save_essay()
	{
		extract($_POST);
		$data = "";
		$p_fields = [
			'id', 'applicant_id', 'essayq1', 'essayq2', 'unit1', 'unit2', 'unit3', 'unit4'
		];
		foreach ($_POST as $k => $v) {
			if (in_array($k, $p_fields)) {
				// if (!empty($data)) $data .= ",";
				// $data .= " `{$k}`='{$this->conn->real_escape_string($v)}' ";
				$v = trim($v);
				if (!empty($data)) $data .= ",";
				$v = !empty($v) ? addslashes($v) : null;
				$data .= "`{$k}`" . ($v !== null ? "='{$v}'" : " = NULL");
			}
		}
		// extract($_POST);
		// $data = '';
		// foreach ($_POST as $k => $v) {
		// 	// $v = str_replace(' ', '', $v);
		// 	$v = trim($v);
		// 	if (!empty($data)) $data .= ",";
		// 	$data .= " `{$k}`='{$v}' ";
		// }
		// str_replace(' ', '', $data);
		// var_dump($data);
		if (empty($_POST['has_id'])) {
			$sql = "INSERT INTO `essay` set {$data} ";
		} else {
			$sql = "UPDATE `essay` set {$data} where applicant_id = '{$applicant_id}' ";
		}
		$save = $this->conn->query($sql);
		if ($save) {
			$resp['status'] = 'success';
			// $resp['redirect'] = "./?p=view_score&id=" . isset($_POST['c_id']) ? $_POST['c_id'] : '';
		} else {
			$resp['status'] = 'failed';
			if (empty($id))
				$resp['msg'] = " Essay has failed to save.";
			else
				$resp['msg'] = " Essay has failed to update.";
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		$resp['id'] = $applicant_id;
		if ($resp['status'] == 'success')
			// $this->settings->set_flashdata('success', $resp['msg']);
			return json_encode($resp);
	}
	function delete_category()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE q,e,c,o FROM `category_list` c left join `exam_list` e on c.id=e.category_id left join `question_list` q on q.exam_id=e.id left join `option_list` o on o.question_id = q.id where c.id='{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Category successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_holiday()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE  FROM `holiday_list` where id='{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Holiday successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_position()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `position` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Position successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_exam()
	{
		if (empty($_POST['id'])) {
			$prefix = date("Ym-");
			$code = sprintf("%'.05d", 1);
			while (true) {
				$check = $this->conn->query("SELECT * FROM `exam_list` where code = '{$prefix}{$code}' ")->num_rows;
				if ($check > 0) {
					$code = sprintf("%'.05d", ceil($code) + 1);
				} else {
					break;
				}
			}
			$_POST['code'] = $prefix . $code;
		}
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$this->conn->real_escape_string($v)}' ";
			}
		}

		if (empty($id)) {
			$sql = "INSERT INTO `exam_list` set {$data} ";
		} else {
			$sql = "UPDATE `exam_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if ($save) {
			$eid = empty($id) ? $this->conn->insert_id : $id;
			$resp['eid'] = $eid;
			$resp['status'] = 'success';
			if (empty($id))
				$resp['msg'] = " New Exam successfully saved.";
			else
				$resp['msg'] = " Exam successfully updated.";
		} else {
			$resp['status'] = 'failed';
			if (empty($id))
				$resp['msg'] = " Exam has failed to save.";
			else
				$resp['msg'] = " Exam has failed to update.";
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function delete_exam()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE q,e,o FROM `exam_list` e left join `question_list` q on e.id=q.exam_id left join `option_list` o on o.question_id=q.id  where e.id='{$id}'");

		// $del = $this->conn->query("DELETE FROM `exam_list` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Exam successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_question()
	{
		$_POST['question'] = htmlentities($_POST['question']);
		extract($_POST);
		$data = "";
		$q_fields = ['exam_id', 'points', 'question'];
		foreach ($_POST as $k => $v) {
			if (in_array($k, $q_fields)) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$this->conn->real_escape_string($v)}' ";
			}
		}

		if (empty($id)) {
			$sql = "INSERT INTO `question_list` set {$data} ";
		} else {
			$sql = "UPDATE `question_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if ($save) {
			$qid = empty($id) ? $this->conn->insert_id : $id;
			$resp['qid'] = $qid;
			$data = "";
			foreach ($opt_id as $k => $v) {
				$v = empty($v) ? NULL : $v;
				$is_right[$k] = isset($is_right[$k]) ? $is_right[$k] : 0;
				$option[$k] = $this->conn->real_escape_string($option[$k]);
				if (!empty($data)) $data .= ",";
				$data .= "('{$v}','{$qid}','{$option[$k]}','{$is_right[$k]}')";
			}
			if (!empty($data)) {
				$this->conn->query("DELETE FROM `option_list` where question_id = '{$qid}'");
				$sql2 = "INSERT INTO `option_list` (`id`,`question_id`,`option`,`is_right`) VALUES {$data}";
				$save2 = $this->conn->query($sql2);
				if ($sql2) {
					$resp['status'] = 'success';
					if (empty($id))
						$resp['msg'] = " New Question successfully saved.";
					else
						$resp['msg'] = " Question successfully updated.";
				} else {
					$resp['status'] = 'failed';
					if (empty($id)) {
						$this->conn->query("DELETE FROM `question_list` where id = '{$qid}'");
						$resp['msg'] = " Question has failed save.";
					} else {
						$resp['msg'] = " Question has failed update.";
					}
					$resp['error'] = $this->conn->error;
				}
			} elseif (empty($data)) {
				$this->conn->query("DELETE FROM `question_list` where id = '{$qid}'");
				$resp['msg'] = " Question has failed save.";
			} else {
				$resp['msg'] = " Question has failed update.";
			}
			$resp['error'] = $this->conn->error;
		} else {
			$resp['status'] = 'failed';
			if (empty($id))
				$resp['msg'] = " Question has failed to save.";
			else
				$resp['msg'] = " Question has failed to update.";
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function delete_question()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE q,o FROM `question_list` q left join `option_list` o on q.id=o.question_id where q.id='{$id}'");

		// $del = $this->conn->query("DELETE FROM `question_list` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Question successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function calculate_score()
	{
		extract($_POST);
		$score = 0;
		$c_id = $_POST['c_id'];
		$client_id = $_POST['client_id'];
		if (empty($this->settings->userdata('id'))) {
			$log_in = $this->conn->query("SELECT *,concat(surname,', ',firstname,' ',middlename) as fullname from applicants where id = '$client_id' ");
			if ($log_in->num_rows > 0) {
				foreach ($log_in->fetch_array() as $k => $v) {
					$this->settings->set_userdata($k, $v);
				}
				$this->settings->set_userdata('login_type', 2);
			}
		}
		// var_dump($ans);
		foreach ($answer as $qid => $selectedOptions) {
			$get_q = $this->conn->query("SELECT points FROM `question_list` WHERE id = '{$qid}'")->fetch_array()[0];
			$correctOptions = $this->conn->query("SELECT * FROM `option_list` WHERE question_id = '{$qid}' AND is_right = 1");
			$incorrectOptions = $this->conn->query("SELECT * FROM `option_list` WHERE question_id = '{$qid}' AND is_right = 0");

			$correctOptionIds = array();
			while ($row = $correctOptions->fetch_assoc()) {
				$correctOptionIds[] = $row['id'];
			}
			$incorrectOptionIds = array();
			while ($row = $incorrectOptions->fetch_assoc()) {
				$incorrectOptionIds[] = $row['id'];
			}

			$isCorrect = false;

			if (is_array($selectedOptions)) {

				$isCorrect = count($correctOptionIds) === count($selectedOptions) && empty(array_diff($correctOptionIds, $selectedOptions)) && count($incorrectOptionIds) !== count($selectedOptions);
			} else {
				$isCorrect = in_array($selectedOptions, $correctOptionIds);
			}

			if ($isCorrect) {
				$score += $get_q;
			}
		}

		$resp['score'] =  $score;
		// session_start();
		// $_SESSION['score'] = $score;
		if (!empty($score)) {

			$this_cid = $this->conn->query("SELECT c.id from `exam_list` e inner join category_list c on e.category_id = c.id where md5(c.id) = '{$c_id}' ")->fetch_array()[0];
			// var_dump($this_cid);
			// if ($qry->num_rows > 0) {
			// 	foreach ($qry->fetch_assoc() as $k => $v) {
			// 		$$k = $v;
			// 	}
			if (empty($this->settings->userdata('recommended_pos'))) {
				$total_items = $this->conn->query("SELECT q.*,e.*,c.* FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$this_cid}'")->num_rows;
				$total_points = $this->conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$this_cid}'")->fetch_array()[0];
				// $total_points = $this->conn->query("SELECT SUM(points) FROM  `question_list` where exam_id = '{$id}'")->fetch_array()[0];
				$total_points = $total_points > 0 ? $total_points : 0;
				$passing_score = $this->conn->query("SELECT SUM(passing_score) FROM  `exam_list` where status = 1 and category_id= '{$this_cid}'")->fetch_array()[0];
				$passing_score = $passing_score > 0 ? $passing_score : 0;
			} else {
				$total_items = $this->conn->query("SELECT q.*,e.*,c.* FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$this_cid}'")->num_rows;
				$total_points = $this->conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$this_cid}'")->fetch_array()[0];
				$total_points = $total_points > 0 ? $total_points : 0;
				$passing_score = $this->conn->query("SELECT SUM(passing_score) FROM  `exam_list` where status = 1 and category_id= '{$this_cid}'")->fetch_array()[0];
				$passing_score = $passing_score > 0 ? $passing_score : 0;
			}
			// } else {
			// 	echo '<script> alert("Unable to access this page."); location.replace("./");</script>';
			// 	exit;
			// }

			if (!empty($score)) {

				if (empty($this->settings->userdata('recommended_pos'))) {
					$score = $score;
				} else {
					$re_exam = $this->conn->query("UPDATE `applicants` set re_exam = 1 where id = '{$client_id}'");
					$set = $this->conn->query("SELECT score FROM  `applicant_score` where applicant_id = '{$client_id}'")->fetch_array()[0];
					$score = $score + $set;
				}
			} else {
				$score = $this->conn->query("SELECT score FROM  `applicant_score` where applicant_id = '{$client_id}'")->fetch_array()[0];
			}


			// var_dump($this->settings->userdata('id'));
			if (isset($passing_score)) :
				if ($score >= $passing_score) {

					$save1 = $this->conn->query("UPDATE `applicants` set passed = 1 where id = '{$client_id}'");
				} else {
					$save1 = $this->conn->query("UPDATE `applicants` set passed = 2 where id = '{$client_id}'");
				}
			endif;

			$check = $this->conn->query("SELECT * FROM  `applicant_score` where applicant_id = '{$client_id}'");
			$application_id = $this->conn->query("SELECT application_id FROM `position` where position='{$client_id}'")->fetch_array();
			if (isset($application_id[0]) && $application_id[0] != 3) {
				$del_enum_score = $this->conn->query("DELETE FROM `enumeration_score` where applicant_id = '{$client_id}'");
			}

			if ($check->num_rows == 0) {
				$is_save = $this->conn->query("INSERT INTO `applicant_score` SET total_score= $total_points, score = $score, category_id = '{$this_cid}', applicant_id = '{$client_id}'");
			} else {
				$is_save = $this->conn->query("UPDATE `applicant_score` set total_score= $total_points, score = $score, category_id = '{$this_cid}' where applicant_id = '{$client_id}'");
			}
			if ($is_save) {
				// unset($_GET['score']);
				$resp['status'] = 'success';
			}
		} else {
			$resp['status'] = 'failed';
		}
		// $this->settings->set_info('score', $score);
		return json_encode($resp);
	}
	function qa_score()
	{
		extract($_POST);

		$save = $this->conn->query("UPDATE `applicant_score` set test2 = '{$result}'  where applicant_id =  '{$id}'");
		if ($save) {
			$recommended_pos = $this->conn->query("SELECT recommended_pos FROM  `applicants` where id = '{$id}'")->fetch_array();
			if (empty($recommended_pos[0])) {
				$apply = $this->conn->query("SELECT application FROM  `applicants` where id = '{$id}'")->fetch_array()[0];
				$score = $this->conn->query("SELECT score FROM  `applicant_score` where applicant_id = '{$id}'")->fetch_array()[0];
				$cid = $this->conn->query("SELECT category_id FROM  `applicant_score` where applicant_id = '{$id}'")->fetch_array()[0];
				$total_score =  $this->conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$cid}'")->fetch_array()[0];
				$passing_score = $this->conn->query("SELECT SUM(passing_score) FROM  `exam_list` where status = 1 and category_id= '{$cid}'")->fetch_array()[0];
			} else {
				$recom_id = $recommended_pos[0];
				$apply = $this->conn->query("SELECT `application_id` FROM  `position` where `position` = '$recom_id'")->fetch_array()[0];
				$score = $this->conn->query("SELECT score FROM  `applicant_score` where applicant_id = '{$id}'")->fetch_array()[0];
				$cid = $this->conn->query("SELECT category_id FROM  `applicant_score` where applicant_id = '{$id}'")->fetch_array()[0];
				$total_score =  $this->conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$cid}'")->fetch_array()[0];
				$passing_score = $this->conn->query("SELECT SUM(passing_score) FROM  `exam_list` where status = 1 and category_id= '{$cid}'")->fetch_array()[0];
				$re_exam = $this->conn->query("UPDATE `applicants` set re_exam = 1 where id = '{$id}'");
				// 	$score = $this->conn->query("SELECT score FROM  `applicant_score` where applicant_id = '{$id}'")->fetch_array()[0];
				// 	$cid = $this->conn->query("SELECT category_id FROM  `applicant_score` where applicant_id = '{$id}'")->fetch_array()[0];
				// 	$total_score =  $this->conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = 19 and e.id>=39 and e.id<=41 ")->fetch_array()[0];
				// 	$passing_score = $this->conn->query("SELECT SUM(passing_score) FROM  `exam_list` where status = 1 and category_id= 19 and id>=39 and id<=41 ")->fetch_array()[0];
			}
			// var_dump($total_score);

			if ($apply == 2) {
				$test2 = $passing_score + 28;
				$all = $total_score + 56;
			} elseif ($apply == 4) {
				$test2 = $passing_score + 37;
				$all = $total_score + 74;
			} elseif ($apply == 3) {
				$test2 = $passing_score + 6;
				$all = $total_score + 12;
			} elseif ($apply == 1) {
				$test2 = $passing_score + 6;
				$all = $total_score + 12;
			}
			$passed = $result + $score;
			$total = $this->conn->query("UPDATE `applicant_score` set total_score = '{$all}' where applicant_id = '{$id}'");
			if ($passed >= $test2) {
				$save1 = $this->conn->query("UPDATE `applicants` set passed = 1 where id = '{$id}'");
			} else {
				$save1 = $this->conn->query("UPDATE `applicants` set passed = 2 where id = '{$id}'");
			}
			if ($save1) {
				$resp['msg'] = 'Applicant Score successfully updated.';
				$resp['status'] = 'success';
			}
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = 'An error occured. Error: ' . $this->conn->error;
		}
		return json_encode($resp);
	}
	function qa_score1()
	{
		// extract($_POST);
		// $data = "";
		// foreach ($_POST as $k => $v) {
		// 	if (!empty($data)) $data .= ",";
		// 	$data .= " `{$k}`='{$v}' ";
		// }
		extract($_POST);
		$data = "";
		$p_fields = [
			'applicant_id', 'b1', 'b2', 'b3', 'b4', 'b5', 'b6', 'b7', 'c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'o1', 'e1', 'r1', 'essay1', 'essay2', 'dum1', 'dum2'
		];
		foreach ($_POST as $k => $v) {
			if (in_array($k, $p_fields)) {
				// if (!empty($data)) $data .= ",";
				// $data .= " `{$k}`='{$this->conn->real_escape_string($v)}' ";
				if (!empty($data)) $data .= ",";
				$v = !empty($v) ? addslashes($v) : null;
				$data .= "`{$k}`" . ($v !== null ? "='{$v}'" : " = NULL");
			}
		}
		// var_dump($data);
		$check = $this->conn->query("SELECT * FROM `enumeration_score` where `applicant_id` = '{$applicant_id}'  ")->num_rows;
		if ($check == 0) {
			$save = $this->conn->query("INSERT INTO `enumeration_score` set $data");
		} else if ($check > 0) {
			$save = $this->conn->query("UPDATE `enumeration_score` set $data WHERE `applicant_id` = '{$applicant_id}'");
		}
		if ($save) {
			$resp['msg'] = 'Applicant Score successfully updated.';
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = 'An error occurred. Error: ' . $this->conn->error;
		}
		$resp['id'] = $applicant_id;
		return json_encode($resp); // Output the response as JSON
	}
	public function upload()
	{
		extract($_POST);
		// $client_id = $this->settings->userdata('id');
		// $data = " id = '{$id}' ";
		$data = " applicant_id = '{$applicant_id}' ";
		// $data .= " ,description = '{$description}' ";
		$file_name = $_FILES['img']['name'];
		$add_ons = $file_name[0];
		$data .= " ,loc = '{$add_ons}' ";
		if ($file_name != NULL) {
			$save = $this->conn->query("INSERT INTO `requirements` set $data");
		}
		// if ($save) {
		// 	foreach ($_POST as $k => $v) {
		// 		$this->settings->set_userdata($k, $v);
		// 	}
		// 	$resp['status'] = 'success';
		// } else {
		// 	$resp['status'] = 'failed';
		// 	$resp['error'] = $this->conn->error;
		// }
		$act = $this->conn->query("SELECT * FROM `applicants` where `id` = '{$applicant_id}'  ");
		while ($row = $act->fetch_assoc()) {
			if ($save) {
				// var_dump($qid);
				if (isset($_FILES['img']) && $_FILES['img']['name'] != '') {
					if (!is_dir(base_app . 'admin/uploads/' . strtolower($row['surname']) . '_' . strtolower($row['firstname']) . '_' . strtolower(mb_substr($row['middlename'], 0, 1)))) {
						mkdir(base_app . 'admin/uploads/' . strtolower($row['surname']) . '_' . strtolower($row['firstname']) . '_' . strtolower(mb_substr($row['middlename'], 0, 1)));

						$fname = 'admin/uploads/' . strtolower($row['surname']) . '_' . strtolower($row['firstname']) . '_' . strtolower(mb_substr($row['middlename'], 0, 1)) . '/';
						$file =  $_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'], '../' . $fname . $file);
					} else {

						$fname = 'admin/uploads/' . strtolower($row['surname']) . '_' . strtolower($row['firstname']) . '_' . strtolower(mb_substr($row['middlename'], 0, 1)) . '/';
						$file =  $_FILES['img']['name'];

						$move = move_uploaded_file($_FILES['img']['tmp_name'], '../' . $fname . $file);
					}
					$qid = $this->conn->query("SELECT MAX(id) FROM requirements WHERE applicant_id = $applicant_id")->fetch_array()[0];
					$qry = $this->conn->query("UPDATE requirements SET `loc` = '{$fname}', `file_name` = '{$file}' WHERE applicant_id = '{$applicant_id}' AND id = $qid");
					$qry1 = $this->conn->query("UPDATE `applicants` set `pdf` = 1 where `id` = '{$row['id']}'");
					if ($qry) {
						$resp['msg'] = 'Applicant Details successfully updated.';
						$resp['status'] = 'success';
						return json_encode($resp);
					}
				}
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = 'An error occured. Error: ' . $this->conn->error;
				return json_encode($resp);
			}
		}
	}
	function delete_file()
	{
		extract($_POST);
		$row = $this->conn->query("SELECT * FROM `requirements` WHERE id = '{$id}'")->fetch_array();
		$act = $this->conn->query("SELECT * FROM `applicants` where `id` = '{$row['applicant_id']}'");
		while ($row1 = $act->fetch_assoc()) {
			if ($row) {
				if (is_dir(base_app . 'admin/uploads/' . strtolower($row1['surname']) . '_' . strtolower($row1['firstname']) . '_' . strtolower(mb_substr($row1['middlename'], 0, 1)))) {
					// $file = scandir(base_app . 'admin/uploads/applicant_id_' . $id);
					// foreach ($file as $img) {
					// 	if (in_array($img, array('..', '.')))
					// 		continue;
					unlink(base_app . 'admin/uploads/' . strtolower($row1['surname']) . '_' . strtolower($row1['firstname']) . '_' . strtolower(mb_substr($row1['middlename'], 0, 1)) . '/' . $row['file_name']);
					// }
					// rmdir(base_app . 'admin/uploads/applicant_id_' . $row['applicant_id']);
					$del = $this->conn->query("DELETE FROM `requirements` where id = '{$id}'");
					$resp['status'] = 'success';
					$pdf_count = $this->conn->query("SELECT SUM(id) FROM `requirements` where applicant_id = '{$row['applicant_id']}'")->fetch_array()[0];
					if ($del) {
						if ($pdf_count < 1) {
							$qry1 = $this->conn->query("UPDATE applicants set pdf = 0 where id = '{$row['applicant_id']}'");
							rmdir(base_app . 'admin/uploads/' . strtolower($row1['surname']) . '_' . strtolower($row1['firstname']) . '_' . strtolower(mb_substr($row1['middlename'], 0, 1)));
							$resp['status'] = 'success';
						} else {
							$resp['status'] = 'success';
						}
					}
				}
				$this->settings->set_flashdata('success', "File successfully deleted.");
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
			}
			return json_encode($resp);
		}
	}
	function yearly()
	{
		extract($_POST);
		$data = "";
		if (isset($id)) {
			foreach ($id as $k => $v) {
				$id[$k] = isset($id[$k]) ? $id[$k] : 0;
				if (!empty($data)) $data .= ",";
				$data .= "('{$id[$k]}')";
			}
			$act = $this->conn->query("SELECT * FROM `requirements` WHERE `id` IN ($data)");
			while ($row1 = $act->fetch_assoc()) {
				// Get the directory path from the fetched row
				$directoryPath = (base_app . $row1['loc']);
				// var_dump($directoryPath);

				// Remove the directory and its contents
				if (is_dir($directoryPath)) {
					$files = glob($directoryPath . '/*');
					foreach ($files as $file) {
						if (is_file($file)) {
							unlink($file);
						}
					}
					$resp['status'] = 'success';

					rmdir($directoryPath);
					$qry1 = $this->conn->query("UPDATE `applicants` set pdf = 2 WHERE `id` = '{$row1['applicant_id']}'");
					$del = $this->conn->query("DELETE FROM `requirements` WHERE `applicant_id`='{$row1['applicant_id']}'");
				}
			}
		}
		$resp['status'] = 'success';
		return json_encode($resp);
	}
	function save_prf_request()
	{
		extract($_POST);
		$data = "";
		$p_fields = [
			'id', 'requestor_id',  'requestor_name', 'requestor_department', 'no_req', 'job_title', 'productline', 'station', 'job_desc',
			'job_quali', 'prf_reason', 'employment_status', 'dh_name', 'od_name', 'dh_sign_date', 'od_sign_date', 'dh_status', 'od_status', 'prf_status', 'requestor_pl'
		];
		foreach ($_POST as $k => $v) {
			if (in_array($k, $p_fields)) {
				if (!empty($data)) $data .= ",";
				$v = !empty($v) ? addslashes($v) : null;
				$data .= "`{$k}`" . ($v !== null ? "='{$v}'" : " = NULL");
			}
		}


		if (!empty($data)) $data .= ",";
		$year = date('Y'); // Get the current year
		$control_no = $this->conn->query("SELECT * FROM prf_request WHERE YEAR(date_created) = $year")->num_rows;
		if ($year == '2023') {
			$prf_no = 'Rec' . date('Y') . '-' . sprintf("%03d", $control_no + 1);
		} else {
			$prf_no = date('Y') . '-' . sprintf("%03d", $control_no + 1);
		}
		$data .= "`prf_no`='{$prf_no}'";

		// extract($_POST);
		// $data = '';
		// foreach ($_POST as $k => $v) {
		// 	if (!empty($data)) $data .= ",";
		// 	$data .= " `{$k}`='{$v}' ";
		// }
		if (empty($id)) {
			$sql = "INSERT INTO `prf_request` set {$data} ";
			$qid = $prf_no;
			if ($prf_reason == 'Replacement') {
				$data = "";
				foreach ($replacement as $k => $v) {
					$v = empty($v) ? NULL : $v;
					$replacement[$k] = isset($replacement[$k]) ? $replacement[$k] : '';
					if (!empty($data)) $data .= ",";
					$data .= "('{$prf_no}','{$replacement[$k]}')";
				}

				if (!empty($data)) {
					$this->conn->query("DELETE FROM `prf_replacement` where `prf_no` = '{$qid}'");
					$sql2 =  $this->conn->query("INSERT INTO `prf_replacement` (`prf_no`,`replacement`) VALUES {$data}");
					if ($sql2) {
						$resp['status'] = 'success';
					} else {
						$resp['status'] = 'failed';
						$resp['error'] = $this->conn->error;
					}
				}
			}
		} else {
			$sql = "UPDATE `prf_request` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if ($save) {
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			if (empty($id))
				$resp['msg'] = " PRF failed to save.";
			else
				$resp['msg'] = " PRF has failed to update.";
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		if ($resp['status'] == 'success')
			// $this->settings->set_flashdata('success', $resp['msg']);
			return json_encode($resp);
	}
	function appr_prf()
	{
		extract($_POST);
		// var_dump($val);
		if ($sign == 1) {
			$del = $this->conn->query("UPDATE `prf_request` set  `dh_name` = '{$od}',`dh_status` = '{$val}',`dh_sign_date`=NOW() where id = '{$id}'");
			if ($val == 1) {
				$appr = $this->conn->query("UPDATE `prf_request` set `prf_status` = 1 where id = '{$id}'");
			} elseif ($val == 2) {
				$appr = $this->conn->query("UPDATE `prf_request` set `prf_status` = 3 where id = '{$id}'");
			}
		} elseif ($sign == 2) {
			$del = $this->conn->query("UPDATE `prf_request` set `od_name` = '{$od}',`od_status` = '{$val}',`od_sign_date`=NOW() where id = '{$id}'");
			if ($val == 1) {
				$appr = $this->conn->query("UPDATE `prf_request` set `prf_status` = 2 where id = '{$id}'");
			} elseif ($val == 2) {
				$appr = $this->conn->query("UPDATE `prf_request` set `prf_status` = 3 where id = '{$id}'");
			}
		} elseif ($sign == 3) {
			$del = $this->conn->query("UPDATE `prf_applicants` set `recruitment_status` = '{$val}' where id = '{$id}'");
		} elseif ($sign == 5) {
			$del = $this->conn->query("UPDATE `prf_request` set `prf_status` = '{$val}' where id = '{$id}'");
		} elseif ($sign == 6) {
			$del = $this->conn->query("UPDATE `prf_request` set `prf_hold` = '{$val}',date_hold = NOW() where id = '{$id}'");
		} elseif ($sign == 4) {
			$idsString = $id;

			// Split the string into an array of individual IDs
			$idsArray = explode(",", $idsString);

			// Convert the array of IDs into a comma-separated string for the SQL query
			$idsList = implode(",", $idsArray);
			$del = $this->conn->query("UPDATE `prf_applicants` set `training_status` = '{$val}' where id IN ({$idsList})");
			$sel_prf_no = $this->conn->query("SELECT `prf_no`from `prf_applicants` where id = '{$id}'")->fetch_array()[0];
			$no_req = $this->conn->query("SELECT no_req FROM prf_request where prf_no = '{$sel_prf_no}'")->fetch_array()[0];
			$hired = $this->conn->query("SELECT count(pa.id) FROM prf_applicants pa inner join prf_request pr on pa.prf_no = pr.prf_no where pr.prf_no = '{$sel_prf_no}' and pa.training_status = 4")->fetch_array()[0];
			if ($hired == $no_req) {
				// $up = $this->conn->query("UPDATE `prf_request` set `prf_status` = 6, date_updated = date('Y-m-d') where prf_no = '{$prf_no}'");
				$up = $this->conn->query("UPDATE `prf_request` SET `prf_status` = 6, `date_served` = NOW() WHERE prf_no = '{$sel_prf_no}'");
			}
		}

		if ($del) {
			$resp['id'] = $id;
			$resp['status'] = 'success';
			if ($sign >= 2 || $sign <= 5) {
				$this->settings->set_flashdata('success', "PRF successfully updated.");
			} elseif ($sign == 3 || $sign == 4) {
				$this->settings->set_flashdata('success', "Appplicant status successfully updated.");
			}
		} else {
			$resp['id'] = $id;
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function disappr_prf()
	{
		extract($_POST);
		// var_dump($disappr_reason);
		// $del = $this->conn->query("UPDATE `prf_request` set `dh_status` = 2,`od_status` = 2,`prf_status` = 3,`disappr_reason`='{$disappr_reason}' where id = '{$id}'");
		if ($sign == 1) {
			$del = $this->conn->query("UPDATE `prf_request` set `dh_name` = '{$od}',`dh_status` = '{$val}',`dh_sign_date`=NOW(),`disappr_reason`='{$disappr_reason}' where id = '{$id}'");
			if ($val == 1) {
				$appr = $this->conn->query("UPDATE `prf_request` set `prf_status` = 1 where id = '{$id}'");
			} elseif ($val == 2) {
				$appr = $this->conn->query("UPDATE `prf_request` set `prf_status` = 3 where id = '{$id}'");
			}
		} elseif ($sign == 2) {
			$del = $this->conn->query("UPDATE `prf_request` set `od_name` = '{$od}',`od_status` = '{$val}',`od_sign_date`=NOW(),`disappr_reason`='{$disappr_reason}' where id = '{$id}'");
			if ($val == 1) {
				$appr = $this->conn->query("UPDATE `prf_request` set `prf_status` = 2 where id = '{$id}'");
			} elseif ($val == 2) {
				$appr = $this->conn->query("UPDATE `prf_request` set `prf_status` = 3 where id = '{$id}'");
			}
		}
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "PRF disapproved.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function cancel_prf()
	{
		extract($_POST);
		// var_dump($disappr_reason);
		// $del = $this->conn->query("UPDATE `prf_request` set `dh_status` = 2,`od_status` = 2,`prf_status` = 3,`disappr_reason`='{$disappr_reason}' where id = '{$id}'");

		$del = $this->conn->query("UPDATE `prf_request` set `prf_status` = 4 ,`cancel_reason`='{$cancel_reason}' where id = '{$id}'");

		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "PRF disapproved.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function close_prf()
	{
		extract($_POST);
		// var_dump($disappr_reason);
		// $del = $this->conn->query("UPDATE `prf_request` set `dh_status` = 2,`od_status` = 2,`prf_status` = 3,`disappr_reason`='{$disappr_reason}' where id = '{$id}'");

		$del = $this->conn->query("UPDATE `prf_request` SET `prf_status` = 6, `date_served` = NOW() WHERE id = '{$id}'");

		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "PRF successfully close.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function rebatch()
	{
		extract($_POST);
		$idsString = $id;
		$idsArray = explode(",", $idsString);
		$idsList = implode(",", $idsArray);
		$del = $this->conn->query("UPDATE `prf_applicants` set `training_status` = 6,`date_rebatched` = '$date_rebatched' where id IN ({$idsList})");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Applicants rebatched.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function reneop()
	{
		extract($_POST);
		$idsString = $id;
		$idsArray = explode(",", $idsString);
		$idsList = implode(",", $idsArray);
		$del = $this->conn->query("UPDATE `prf_applicants` set `date_commencement` = '$date_commencement' where id IN ({$idsList})");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "NEOP successfully rescheduled.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function request_personnel()
	{

		$prf_no = strval($_POST['prf_no']);

		extract($_POST);
		$data = "";
		$p_fields = [
			'id', 'prf_no', 'date_commencement'
		];
		foreach ($_POST as $k => $v) {
			if (in_array($k, $p_fields)) {
				if (!empty($data)) $data .= ",";
				$v = !empty($v) ? addslashes($v) : null;
				$data .= "`{$k}`" . ($v !== null ? "='{$v}'" : " = NULL");
			}
		}

		// if (!empty($id)) {
		// 	$cond = $this->conn->query("SELECT date_closed FROM  `prf_request` where id = $id ")->fetch_array()[0];
		// 	if (!empty($status) && $status == 3 && ($cond == '0000-00-00' || $cond === null)) {
		// 		if (!empty($data)) $data .= ",";
		// 		$date_closed = $status == 3 ? date('Y-m-d') : null;
		// 		$data .= "`date_closed`='{$date_closed}'";
		// 	}
		// 	if ((!empty($d_head) && $d_head == 2) || (!empty($a_sign) && $a_sign == 2) || (!empty($noted_by) && $noted_by == 2)) {
		// 		if (!empty($data)) $data .= ",";
		// 		$cancel = 2;
		// 		$res2 = "Disapproved by {$_POST['ud']}";
		// 		$data .= "`status`='{$cancel}',";
		// 		$data .= "`reason2`='{$res2}'";
		// 	}
		// 	if ((!empty($noted_by) && $noted_by == 1)) {
		// 		if (!empty($data)) $data .= ",";
		// 		$date_now = $noted_by == 1 ? date('Y-m-d') : null;
		// 		$data .= "`hr_received`='{$date_now}',";
		// 		$data .= "`ads_date`='{$date_now}'";
		// 	}
		// 	// var_dump($data);
		// 	$sql = "UPDATE `prf_request` set {$data} where id = $id";
		// } else {
		// 	$sql = "INSERT INTO `prf_request` set {$data} ";
		// 	$resp['status'] = 'success';
		// }
		// $save = $this->conn->query($sql);

		// if (!empty($applicant_name)) {
		$data = "";
		foreach ($applicant_name as $k => $v) {
			$v = empty($v) ? NULL : $v;
			$applicant_name[$k] = isset($applicant_name[$k]) ? $applicant_name[$k] : '';
			$date_commencement = isset($date_commencement) ? $date_commencement : '';
			if (!empty($data)) $data .= ",";
			$data .= "('{$prf_no}','{$applicant_name[$k]}','{$date_commencement}' )";
			$check = $this->conn->query("SELECT * FROM `prf_applicants` where `applicant_name` = '{$applicant_name[$k]}'  " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		}
		// var_dump($data);
		if ($check > 0) {
			$resp['status'] = 'duplicate';
			// $this->settings->set_flashdata('error', "Applicant already exists.");
			return json_encode($resp);
		}
		if (!empty($data)) {
			$sql2 =  $this->conn->query("INSERT INTO `prf_applicants` (`prf_no`,`applicant_name`,`date_commencement` ) VALUES {$data}");

			// $left = "UPDATE `prf_request` SET date_commencement = '$date_commencement' WHERE id = $id";
			// $right = $this->conn->query($left);
			if ($sql2) {
				$this->settings->set_flashdata('success', "Applicants added.");
				$resp['status'] = 'success';
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
			}
		}
		// $req_no = $_POST['req_no'];
		// $hired = $this->conn->query("SELECT COUNT(id) FROM  `prf_applicants` where prf_no = '$prf_no'GROUP BY id")->num_rows;
		// $delta = $req_no - $hired;
		// if ($delta <= 0) {
		// 	$dc = date('Y-m-d');
		// 	// var_dump($dc);
		// 	$up = "UPDATE `prf_request` SET status = 3, date_closed = '$dc' WHERE id = $id";
		// 	$down = $this->conn->query($up);
		// }
		// }
		// if (empty($applicant_name)) {
		// 	$resp['status'] = 'success';
		// }
		// if ($save) {
		// 	$resp['id'] = md5($prf_no);
		// 	$resp['status'] = 'success';
		// } else {
		// 	$resp['status'] = 'failed';
		// 	$resp['err'] = $this->conn->error . "[{$sql}]";
		// }
		return json_encode($resp);
	}
	function save_operator()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$this->conn->real_escape_string($v)}' ";
			}
		}

		$check = $this->conn->query("SELECT * FROM `ters_operator` where `emp_no` = '{$emp_no}'  " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "TERS operator number already exists.";
		} else {
			if (empty($id)) {
				$sql = "INSERT INTO `ters_operator` set {$data} ";
			} else {
				$sql = "UPDATE `ters_operator` set {$data} where id = '{$id}' ";
			}
			$save = $this->conn->query($sql);
			if ($save) {
				$resp['status'] = 'success';
				if (empty($id))
					$resp['msg'] = "New TERS operator successfully saved.";
				else
					$resp['msg'] = "TERS operator  successfully updated.";
			} else {
				$resp['status'] = 'failed';
				$resp['err'] = $this->conn->error . "[{$sql}]";
			}
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function delete_operator()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE  FROM `ters_operator` where id='{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "TERS operator successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_category':
		echo $Master->save_category();
		break;
	case 'holiday':
		echo $Master->holiday();
		break;
	case 'save_position':
		echo $Master->save_position();
		break;
	case 'yearly':
		echo $Master->yearly();
		break;
	case 'delete_category':
		echo $Master->delete_category();
		break;
	case 'delete_holiday':
		echo $Master->delete_holiday();
		break;
	case 'delete_position':
		echo $Master->delete_position();
		break;
	case 'save_exam':
		echo $Master->save_exam();
		break;
	case 'delete_exam':
		echo $Master->delete_exam();
		break;
	case 'save_question':
		echo $Master->save_question();
		break;
	case 'delete_question':
		echo $Master->delete_question();
		break;
	case 'calculate_score':
		echo $Master->calculate_score();
		break;
	case 'upload':
		echo $Master->upload();
		break;
	case 'delete_file':
		echo $Master->delete_file();
		break;
	case 'save_test':
		echo $Master->save_test();
		break;
	case 'save_essay':
		echo $Master->save_essay();
		break;
	case 'qa_score':
		echo $Master->qa_score();
		break;
	case 'qa_score1':
		echo $Master->qa_score1();
		break;
	case 'save_prf_request':
		echo $Master->save_prf_request();
		break;
	case 'appr_prf':
		echo $Master->appr_prf();
		break;
	case 'disappr_prf':
		echo $Master->disappr_prf();
		break;
	case 'cancel_prf':
		echo $Master->cancel_prf();
		break;
	case 'rebatch':
		echo $Master->rebatch();
		break;
	case 'reneop':
		echo $Master->reneop();
		break;
	case 'request_personnel':
		echo $Master->request_personnel();
		break;
	case 'close_prf':
		echo $Master->close_prf();
		break;
	case 'save_operator':
		echo $Master->save_operator();
		break;
	case 'delete_operator':
		echo $Master->delete_operator();
		break;
	default:
		// echo $sysset->index();
		break;
}
