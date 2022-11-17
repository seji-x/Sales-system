
<?php
	
		$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');

?>

<?php

	/**
	 * 
	 */
	class category 
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			// code...
			$this->db = new Database();
			$this->fm = new Format();

		}

		public function insert_category($cat_name){

			$cat_name = $this->fm->validation($cat_name);
			$cat_name = mysqli_real_escape_string($this->db->link,$cat_name);

			if (empty($cat_name)) {
				$alert = "<span class='error'> Category must be empty  </span>";
				return $alert;
			} else {
				$query = "INSERT INTO category(cat_name) VALUES('$cat_name')";
				$result = $this->db->insert($query);

				if ($result) {
					$alert = "<span class='success'> Insert category successfully  </span>";
					return $alert;
				} else {
					$alert = "<span class='error'> Insert category not success  </span>";
					return $alert;
				}
			}

		}

		public function show_category(){
			$query = "SELECT * FROM category order by cat_id desc";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_category($cat_name, $cat_id) {

			$cat_name = $this->fm->validation($cat_name);

			$cat_name = mysqli_real_escape_string($this->db->link,$cat_name);
			$cat_id = mysqli_real_escape_string($this->db->link,$cat_id);

			if (empty($cat_name)) {
				$alert = "<span class='error'> Category must be empty  </span>";
				return $alert;
			} else {
				$query = "UPDATE category SET cat_name='$cat_name' WHERE cat_id='$cat_id' ";
				$result = $this->db->update($query);

				if ($result) {
					$alert = "<span class='success'> Category updated successfully  </span>";
					return $alert;
				} else {
					$alert = "<span class='error'> Category updated not success  </span>";
					return $alert;
				}
			}
		}

		public function getcatbyId($id){
			$query = "SELECT * FROM category WHERE cat_id='$id' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_category($id){
			$query = "DELETE FROM category WHERE cat_id='$id' ";
			$result = $this->db->delete($query);

			if ($result) {
				$alert = "<span class='success'> Category deleted successfully  </span>";
				return $alert;
			} else {
				$alert = "<span class='error'> Category not success  </span>";
				return $alert;
			}
				
		}
}

?>