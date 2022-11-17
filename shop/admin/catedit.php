<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>

<?php
    if (isset($_GET['cat_id']) && $_GET['cat_id']!=NULL) {
        $id = $_GET['cat_id'];
    } else{
        echo "<script> window.on.location = 'catlist.php'  </script>";
    }
    $cat = new category();
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $cat_name = $_POST['cat_name'];
        $update_cate = $cat->update_category($cat_name, $id);
     }
 
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
               <div class="block copyblock"> 
                <?php 
                    if (isset($update_cate)) {
                        echo $update_cate;
                    }
                ?>
                <?php  
                     $get_cate_name = $cat->getcatbyId($id);
                    if ($get_cate_name) {
                        $i = 0;
                        while ($result = $get_cate_name->fetch_assoc()) {
                            $i++;
                ?>
                 <form action="" method="post">
                    <table class="form">	

                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['cat_name']  ?>" name="cat_name" placeholder="Sửa danh mục" class="medium" />
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