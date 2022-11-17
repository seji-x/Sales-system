<?php
	include 'inc/header.php';
	include 'inc/slider.php'
?>
<?php echo session_id();  ?>
		

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      		$getProductFeathered = $product->getproduct_feathered();//dung de truy van lay ra ds
	      		if ($getProductFeathered) {
	      			$i=0;
	      			while($res = $getProductFeathered->fetch_assoc()){
	      				$i++;

	      	?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php">
					 	<img src="admin/uploads/<?php echo $res['product_img'] ?>" alt="" />
					 </a>
					 <h2><?php echo $res['product_name'] ?> </h2>
					 <p><?php echo $fm->textShorten($res['product_desc'],50) ?> </p>
					 <p><span class="price"><?php echo $res['product_price']."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?product_detail_id=<?php echo $res['product_id'] ?>" class="details">Details</a></span></div>
				</div>

				<?php  
						}	
	      		}
				?>


				
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">

				<?php 
	      		$getProductNew = $product->getproduct_new();
	      		if ($getProductNew) {
	      			$i=0;
	      			while($res = $getProductNew->fetch_assoc()){
	      				$i++;

	      	?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php">
					 	<img src="admin/uploads/<?php echo $res['product_img'] ?>" alt="" />
					 </a>
					 <h2><?php echo $res['product_name'] ?> </h2>
					 <p><?php echo $fm->textShorten($res['product_desc'],50) ?> </p>
					 <p><span class="price"><?php echo $res['product_price']."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?product_detail_id=<?php echo $res['product_id'] ?>" class="details">Details</a></span></div>
				</div>
				
				<?php  
						}	
	      		}
				?>
				
			</div>
    </div>
 </div>


<?php
	include 'inc/footer.php'; 
?>
