<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php

    $product = new product();

    
    if (isset($_GET['product_id']) ) {
        $id = $_GET['product_id'];
        $del_product = $product->del_product($id);
    } 

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên sản phẩm</th>
					<th>Giá</th>
					<th>Hình ảnh</th>
					<th>Mô tả</th>
					<th>Danh mục</th>
					<th>Thương hiệu</th>
					<th>Loại</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					$product = new product();
					$fm = new Format();
                    $show_product = $product->show_product();
                    if ($show_product) {
                    $i = 0;
                        while ($result = $show_product->fetch_assoc()) {
                            $i++;
                ?>

				<tr class="odd gradeX">
					<td><?php echo $i  ?></td>
					<td><?php echo $result['product_name']?></td>
					<td><?php echo $result['product_price']?></td>
					<td><img src="uploads/<?php echo $result['product_img']?>" width="80"></td>
				
					<td><?php echo $fm->textShorten($result['product_desc'],30)?></td>
					<td><?php echo $result['cat_name']?></td>
					<td><?php echo $result['brand_name']?></td>
					<td>
						<?php
							if ($result['product_type'] == '0') {
								echo 'Feathered';
							} else {
								echo 'No-Feathered';
							}
						?>
					</td>
					<td>
						<a href="productedit.php?product_id=<?php echo $result['product_id']?>">Edit</a>||
						<a onclick="return confirm('Bạn có muốn xóa ')" href="?product_id=<?php echo $result['product_id'] ?>">Delete</a>
					</td>
				</tr>

				 <?php
                        }
                    }  
                ?>
                        
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
