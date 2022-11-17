
<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/session.php');
	Session::checkLogin();


	
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');

?>

<?php

	/**
	 * 
	 */
	class adminlogin 
	{
		// tao file database rieng de goi tới
		private $db;

		// forrmat chữ cho ngắn lại
		private $fm;
		
		public function __construct()
		{
			// code...
			$this->db = new Database();
			$this->fm = new Format();

		}

		public function login_admin($admin_user,$admin_pass){
			$admin_user = $this->fm->validation($admin_user);
			$admin_pass = $this->fm->validation($admin_pass);

			$admin_user = mysqli_escape_string($this->db->link,$admin_user);//ky tu db la sai
			$admin_pass = mysqli_escape_string($this->db->link,$admin_pass);

			if (empty($admin_user) || empty($admin_pass)) {
				$alert = "User and password must be empty";
			} else {
				$query = "SELECT * FROM admin WHERE admin_user = '$admin_user' AND admin_pass = '$admin_pass' LIMIT 1";
				$result = $this->db->select($query);

				if ($result != false) {
					// code...
					$value = $result->fetch_assoc();
					Session::set('adminlogin', true);//save in session
					Session::set('admin_id', $value['admin_id']);
					Session::set('admin_user', $value['admin_user']);
					Session::set('admin_name', $value['admin_name']);

					header('Location:index.php');
				} else {
					$alert = "User and password not exits";
					return $alert;
				}


			}
		}

	}

?>