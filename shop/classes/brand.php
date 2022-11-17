
<?php
	
		$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');

?>

<?php

	/**
	 * 
	 */
	class brand 
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			// code...
			$this->db = new Database();
			$this->fm = new Format();

		}

		public function insert_brand($brand_name){

			$brand_name = $this->fm->validation($brand_name);
			$brand_name = mysqli_real_escape_string($this->db->link,$brand_name);

			if (empty($brand_name)) {
				$alert = "<span class='error'> Brand's name must be empty  </span>";
				return $alert;
			} else {
				$query = "INSERT INTO brand(brand_name) VALUES('$brand_name')";
				$result = $this->db->insert($query);

				if ($result) {
					$alert = "<span class='success'> Insert brand's name successfully  </span>";
					return $alert;
				} else {
					$alert = "<span class='error'> Insert brand's name not success  </span>";
					return $alert;
				}
			}

		}

		public function show_brand(){
			$query = "SELECT * FROM brand order by brand_id desc";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($brand_name, $brand_id) {

			$brand_name = $this->fm->validation($brand_name);

			$brand_name = mysqli_real_escape_string($this->db->link,$brand_name);
			$brand_id = mysqli_real_escape_string($this->db->link,$brand_id);

			if (empty($brand_name)) {
				$alert = "<span class='error'> Brand's name must be empty  </span>";
				return $alert;
			} else {
				$query = "UPDATE brand SET brand_name='$brand_name' WHERE brand_id='$brand_id' ";
				$result = $this->db->update($query);

				if ($result) {
					$alert = "<span class='success'> Brand's name updated successfully  </span>";
					return $alert;
				} else {
					$alert = "<span class='error'> Brand's name updated not success  </span>";
					return $alert;
				}
			}
		}

		public function getbrandbyId($id){
			$query = "SELECT * FROM brand WHERE brand_id='$id' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_brand($id){
			$query = "DELETE FROM brand WHERE brand_id='$id' ";
			$result = $this->db->delete($query);

			if ($result) {
				$alert = "<span class='success'> Brand's name deleted successfully  </span>";
				return $alert;
			} else {
				$alert = "<span class='error'> Brand's name not success  </span>";
				return $alert;
			}
				
		}
}

?>