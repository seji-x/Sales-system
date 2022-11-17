<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php
    $product = new product();
     if (isset($_GET['product_id']) && $_GET['product_id']!=NULL) {
        $id = $_GET['product_id'];
    }else{
        echo "<script> window.on.location = 'productlist.php'  </script>";
    }

     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateProduct = $product->update_product($_POST, $_FILES, $id);
     }

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">
        <?php 
            if (isset($updateProduct)) {
                echo $updateProduct;
            }
        ?>
        <?php  
            $get_product_by_id = $product->getproductbyId($id);
                if ($get_product_by_id) {
                $i = 0;
                    while ($result_product = $get_product_by_id->fetch_assoc()) {
                    $i++;
        ?>               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input value="<?php echo $result_product['product_name']?>" type="text" name="product_name" placeholder="Tên sản phẩm" class="medium" />
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

                                <?php 

                                    if ($result['cat_id'] == $result_product['cat_id']){
                                        echo 'selected';
                                    } 

                                ?>

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
                            <option

                                <?php 
                                    if ($result['brand_id'] == $result_product['brand_id']){
                                        echo 'selected';
                                    } 
                                ?>

                                value="<?php echo $result['brand_id']?>">
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
                        <textarea  name="product_desc" class="tinymce"><?php echo $result_product['product_desc']?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input value="<?php echo $result_product['product_price']?>" type="text" name="product_price" placeholder="Thêm giá tiền" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Thêm ảnh</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_product['product_img']?>" width="120">
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

                            <?php
                            if ($result['product_type'] == '0') {
                            ?>
                                <option value="1">Featured</option>
                                <option selected value="0">Non-Featured</option>
                            <?php  
                                }else{
                            ?>
                                <option selected value="1">Featured</option>
                                <option value="0">Non-Featured</option>
                            <?php  
                                }
                            ?>
                           
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
             <?php
                    }
                }  
            ?>
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


