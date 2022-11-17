<?php
	include 'inc/header.php';
	// include 'inc/slider.php'
?>
<?php 

	  $product = new product();
     if (isset($_GET['product_detail_id']) && $_GET['product_detail_id']!=NULL) {
        $id = $_GET['product_detail_id'];
    }else{
        echo "<script> window.location = '404.php'  </script>";
    }

     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

        $quantity = $_POST['quantity'];
        $addToCart = $cart->add_to_cart($quantity,$id);
     }

?>

 <div class="main">
    <div class="content">
    	<div class="section group">

    		<?php 
    			$get_product_detail = $product->getproduct_details($id);
               if ($get_product_detail) {
               $i = 0;
                  while ($result = $get_product_detail->fetch_assoc()) {
                  $i++;
               
    		?>

				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result['product_img'] ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['product_name']?></h2>
					<p><?php echo $fm->textShorten($result['product_desc'],390)?></p>					
					<div class="price">
						<p>Price: <span><?php echo $result['product_price']." "."VNĐ"  ?></span></p>
						<p>Category: <span><?php echo $result['cat_name']?></span></p>
						<p>Brand:<span><?php echo $result['brand_name']?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1" />
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						<?php 
							if (isset($addToCart)) {
								echo "<span style='color:red; font-size:18px; ' > Product already added</span>";
							}
						?>
					</form>				
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['product_desc']?></p>
	    </div>
				
	</div>
			<?php
			      }
			   }  
			?>

				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>


				      <li><a href="productbycat.php">Mobile Phones</a></li>
				     
    				</ul>
    	
 				</div>
 		</div>

 		

 	</div>

 	
<?php
	include 'inc/footer.php'; 
?>
