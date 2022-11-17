
<?php
	
		$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');

?>

<?php

	/**
	 * 
	 */
	class cart 
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			// code...
			$this->db = new Database();
			$this->fm = new Format();

		}

		public function add_to_cart($quantity,$id){
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link,$quantity);
			$id = mysqli_real_escape_string($this->db->link,$id);

			$ssId = session_id();
			$query = "SELECT * FROM product WHERE product.product_id='$id' ";
			$res = $this->db->select($query)->fetch_assoc();

			$name = $res['product_name'];
			$price = $res['product_price'];
			
			$img = $res['product_img'];

			$check_cart = "SELECT * FROM cart WHERE product_id='$id' AND session_id='$ssId'  ";
			if ($check_cart) {
				$msg = "Product already added";
				return $msg;
			} else {
				$query_cart = "INSERT INTO cart(product_id,session_id,product_name,price,quantity,img) VALUES('$id', '$sId', '$name', '$price', '$quantity', '$img')";


			$insert_cart = $this->db->insert($query_cart);

				if ($query_cart) {
					header('Location:cart.php');
					// header('Location:details.php?product_detail_id='). echo $id;
				} else {
					header('Location:404.php');
				}
			}

			

		}

		public function get_product_cart(){
			$sId = session_id();
			$query = "SELECT * FROM cart WHERE session_id='$sId' ";
			$res = $this->db->select($query);
			return $res;
		}

		public function update_quantity_cart($quantity,$cart_id){
			$quantity = mysqli_real_escape_string($this->db->link,$quantity);
			$cart_id = mysqli_real_escape_string($this->db->link,$cart_id);

			$query = "UPDATE cart SET
					
					quantity= '$quantity'

					WHERE cart_id='$cart_id' ";
			$result = $this->db->update($query);
			if ($result) {
				return $msg = "<span class='success' > Product quantity updated successfully </span>";
			} else {
				return $msg = "<span class='error' > Product quantity not success </span>";
			}

			
		}

		public function del_product_cart($id){
			$id = mysqli_real_escape_string($this->db->link,$id);
			$query = "DELETE FROM cart WHERE cart_id='$id' ";
			$res = $this->db->delete($query);
			if ($res) {
				header('Location:cart.php');
				// return $msg = "<span class='success' > Product deleted successfully </span>";
			} else {
				return $msg = "<span class='error' > Product deleted not success </span>";
			}
		}

}

?>