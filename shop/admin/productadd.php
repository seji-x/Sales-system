<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php
    $product = new product();
     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

       
        $insertProduct = $product->insert_product($_POST, $_FILES);
     }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">               
         <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="product_name" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="cat_id">
                            <option>------Chọn danh mục------</option>
                        <?php  
                            $cat = new category();
                            $show_cat = $cat->show_category();
                            if ($show_cat) {
                                $i = 0;
                                while ($result = $show_cat->fetch_assoc()) {
                                    $i++;

                        ?>
                            <option 
                                value="<?php echo $result['cat_id']?>">
                                <?php echo $result['cat_name']  ?>                                 
                            </option>

                        <?php
                                }
                            }  
                        ?>
                            
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>

                        <select id="select" name="brand_id">
                           <option>------Chọn thương hiệu------</option>
                        <?php  
                            
                            $brand1 = new brand();
                            $showlist = $brand1->show_brand();
                            if ($showlist) {
                                $i=0;
                                while ($result = $showlist->fetch_assoc()) {
                                   $i++; 
                        ?>
                            <option value="<?php echo $result['brand_id']?>">

                             <?php echo $result['brand_name']  ?>
                                 
                             </option>

                         <?php
                                }
                            }  
                        ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="product_desc" class="tinymce"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" name="product_price" placeholder="Thêm giá tiền" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Thêm ảnh</label>
                    </td>
                    <td>
                        <input name="product_img" type="file" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="product_type">
                            <option>Select Type</option>
                            <option value="1">Featured</option>
                            <option value="0">Non-Featured</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


