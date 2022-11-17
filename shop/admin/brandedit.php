<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>

<?php
    if (isset($_GET['brand_id']) && $_GET['brand_id']!=NULL) {
        $id = $_GET['brand_id'];
    } else{
        echo "<script> window.on.location = 'brandlist.php'  </script>";
    }
    $brand = new brand();
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $brand_name = $_POST['brand_name'];
        $update_brand = $brand->update_brand($brand_name, $id);
     }
 
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thương hiệu</h2>
               <div class="block copyblock"> 
                <?php 
                    if (isset($update_brand)) {
                        echo $update_brand;
                    }
                ?>
                <?php  
                     $get_brand_name = $brand->getbrandbyId($id);
                    if ($get_brand_name) {
                        $i = 0;
                        while ($result = $get_brand_name->fetch_assoc()) {
                            $i++;
                ?>
                 <form action="" method="post">
                    <table class="form">	

                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['brand_name']  ?>" name="brand_name" placeholder="Sửa thương hiệu" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Lưu" />
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
<?php include 'inc/footer.php';?>