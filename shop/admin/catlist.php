<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php

	$cat = new category();

	
    if (isset($_GET['del_id']) ) {
        $id = $_GET['del_id'];
        $del_cate = $cat->del_category($id);
    } 

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh mục sản phẩm</h2>
                <div class="block">   
                <?php 
                    if (isset($del_cate)) {
                        echo $del_cate;
                    }
                ?>     
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên danh mục</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php  
							$show_cat = $cat->show_category();
							if ($show_cat) {
								$i = 0;
								while ($result = $show_cat->fetch_assoc()) {
									$i++;

						?>
						<tr class="odd gradeX">
							<td><?php echo $i  ?></td>
							<td><?php echo $result['cat_name']  ?></td>
							<td><a href="catedit.php?cat_id=<?php echo $result['cat_id'] ?>">Sửa</a> || 
								<a onclick="return confirm('Bạn có muốn xóa ')" href="?del_id=<?php echo $result['cat_id'] ?>">Xóa</a>
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

