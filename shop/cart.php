<?php
	include 'inc/header.php';
	// include 'inc/slider.php'
?>
<?php 
	if (isset($_GET['cart_id'])) {
		$id = $_GET['cart_id'];
		$del_cart = $cart->del_product_cart($id);
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		  $cart_id = $_POST['cart_id'];
        $quantity = $_POST['quantity'];
        $updateCart = $cart->update_quantity_cart($quantity,$cart_id);
     }
?>


 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php 
			    		if (isset($updateCart)) {
			    			echo $updateCart;
			    		}
			    	?>
			    	<?php 
			    		if (isset($del_cart)) {
			    			echo $del_cart;
			    		}
			    	?>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php 
								$subtotal = 0;
								$get_product_cart = $cart->get_product_cart();
								if ($get_product_cart) {
               			$i = 0;
                  			while ($result = $get_product_cart->fetch_assoc()) {
                  			$i++;
                  			
							?>

							<tr>
								<td><?php echo $result['product_name'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['img'] ?>" alt=""/></td>
								<td><?php echo $result['price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cart_id" value="<?php echo $result['cart_id'] ?>"/>
										<input type="number" name="quantity" min="1" value="<?php echo $result['quantity'] ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>

									<?php
										$total = $result['price']*$result['quantity'];
									 echo $total ?>
									
								</td>
								<td><a href="?cart_id=<?php echo $result['cart_id'] ?>">Xóa</a></td>
							</tr>
							<?php
								$subtotal += $total;
	      						}
	   						}  
							?>

							
							
							
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>
									<?php 
										
										echo $subtotal; 
									?>
								</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%
									(
										<?php 
											$_vat = $subtotal * 0.01;
											echo $_vat; 
										?>
									)
								</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php 
										$vat = $subtotal * 0.01;
										$gtotal = $subtotal - $vat;
										echo $gtotal; 
									?>
								</td>
							</tr>
					   </table>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>


<?php

	include 'inc/footer.php';
?>

