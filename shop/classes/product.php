
<?php
	
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');

?>

<?php

	/**
	 * 
	 */
	class product 
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			// code...
			$this->db = new Database();
			$this->fm = new Format();

		}

		public function insert_product($data, $files){

			$product_name = mysqli_real_escape_string($this->db->link,$data['product_name']);
			$cat_id = mysqli_real_escape_string($this->db->link,$data['cat_id']);
			$brand_id = mysqli_real_escape_string($this->db->link,$data['brand_id']);
			$product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
			$product_price = mysqli_real_escape_string($this->db->link,$data['product_price']);
			$product_type = mysqli_real_escape_string($this->db->link,$data['product_type']);

				// kiem tra va lay hinh anh cho vao folder upload
				$permitted = array('jpg','jpeg','png','gif');
				$file_name = $_FILES['product_img']['name'];
				$file_size = $_FILES['product_img']['size'];
				$file_temp = $_FILES['product_img']['tmp_name'];

				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				$unique_img = substr(md5(time()), 0, 10).'.'.$file_ext;
				$uploaded_img = "uploads/".$unique_img;


		

			if ($product_name == "" || $cat_id == "" || $brand_id == "" ||
				$product_desc == "" || $product_price == "" || $product_type == "" || $file_name =="" ) {

				$alert = "<span class='error'> Fields must be empty  </span>";
				return $alert;
			} else {
				move_uploaded_file($file_temp, $uploaded_img);
				$query = "INSERT INTO product(product_name, cat_id, brand_id, product_desc, product_type, product_price, product_img) VALUES('$product_name', '$cat_id', '$brand_id', '$product_desc', '$product_type', '$product_price', '$unique_img')";
				$result = $this->db->insert($query);

				if ($result) {
					$alert = "<span class='success'> Insert product successfully  </span>";
					return $alert;
				} else {
					$alert = "<span class='error'> Insert product not success  </span>";
					return $alert;
				}
			}

		}

		public function show_product(){
			// $query = "SELECT * FROM product order by product_id desc";

			$query="SELECT product.*, category.cat_name, brand.brand_name
					FROM product INNER JOIN category ON product.cat_id = category.cat_id
					INNER JOIN brand ON product.brand_id = brand.brand_id
					order by product.product_id desc";


			$result = $this->db->select($query);
			return $result;
		}

		public function update_product($data,$files,$id) {

			$product_name = mysqli_real_escape_string($this->db->link,$data['product_name']);
			$cat_id = mysqli_real_escape_string($this->db->link,$data['cat_id']);
			$brand_id = mysqli_real_escape_string($this->db->link,$data['brand_id']);
			$product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
			$product_price = mysqli_real_escape_string($this->db->link,$data['product_price']);
			$product_type = mysqli_real_escape_string($this->db->link,$data['product_type']);

				// kiem tra va lay hinh anh cho vao folder upload
				$permitted = array('jpg','jpeg','png','gif');
				$file_name = $_FILES['product_img']['name'];
				$file_size = $_FILES['product_img']['size'];
				$file_temp = $_FILES['product_img']['tmp_name'];

				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				$unique_img = substr(md5(time()), 0, 10).'.'.$file_ext;
				$uploaded_img = "uploads/".$unique_img;

			if ($product_name == "" || $cat_id == "" || $brand_id == "" ||
				$product_desc == "" || $product_price == "" || $product_type == "" ) {

				$alert = "<span class='error'> Fields must be empty  </span>";
				return $alert;
			} else {

				if (!empty($file_name)) {
					// Nếu người dùng chọn ảnh
					if ($file_size > 2048 ) {
						$alert = "<span class='error'> Img size should be less then 2MB</span>";
						return $alert;
					} else if(in_array($file_ext, $permitted) === false) {

						// echo "<span class='error'> You can upload only:-"
						// .implode('.', $permitted)."</span>";

				$alert = "<span class='error'> You can upload only:-".implode(',', $permitted)."</span>";
					return $alert;
					}
					// move_uploaded_file($file_temp, $uploaded_img);
					$query = "UPDATE product SET
					product_name='$product_name',
					cat_id='$cat_id',
					brand_id='$brand_id',
					product_desc='$product_desc',
					product_price='$product_price',
					product_type='$product_type',
					product_img='$unique_img'

					WHERE product_id='$id' ";
					

				} else {
					// Nếu người dùng không chọn ảnh
					$query = "UPDATE product SET
					product_name='$product_name',
					cat_id='$cat_id',
					brand_id='$brand_id',
					product_desc='$product_desc',
					product_price='$product_price',
					product_type='$product_type'
					

					WHERE product_id ='$id' ";

				}	
			

				$result = $this->db->update($query);

				if ($result) {
					$alert = "<span class='success'> Product updated successfully  </span>";
					return $alert;
				} else {
					$alert = "<span class='error'> Product updated not success  </span>";
					return $alert;
				}
			}
		}

		public function getproductbyId($id){
			$query = "SELECT * FROM product WHERE product_id='$id' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_product($id){
			$query = "DELETE FROM product WHERE product_id='$id' ";
			$result = $this->db->delete($query);

			if ($result) {
				$alert = "<span class='success'> Product deleted successfully  </span>";
				return $alert;
			} else {
				$alert = "<span class='error'> Product not success  </span>";
				return $alert;
			}
				
		}

		// END BACKEND
		public function getproduct_feathered(){
			$query = "SELECT * FROM product WHERE product_type='1' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproduct_new(){
			$query = "SELECT * FROM product order by product_id desc LIMIT 4 ";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproduct_details($id){
			$query="SELECT product.*, category.cat_name, brand.brand_name
					FROM product INNER JOIN category ON product.cat_id = category.cat_id
					INNER JOIN brand ON product.brand_id = brand.brand_id
					WHERE product.product_id ='$id' ";
			$result = $this->db->select($query);
			return $result;
		}
}

?>