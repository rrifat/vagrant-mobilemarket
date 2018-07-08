<?php include 'inc/header.php'; ?>
<?php include 'inc/new_sidebar.php'; ?>
<?php include "classes/Product.php"; ?>
<?php include "classes/Category.php"; ?>
<?php include "classes/Brand.php"; ?>
<?php
if (!isset($_GET['proid']) && $_GET['proid'] == NULL) {
    //echo "<script>window.location = 'catlist.phps'</script>";
    header("Location: productlist.php");
} else {
    $id = $_GET['proid'];
}

$product = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $productUpdate = $product->product_update($_POST, $_FILES, $id);
}

?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center">
                    Edit Uploaded Product
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (isset($productUpdate)) {
                    echo "<div class='alert alert-success alert-dismissable col-lg-6 col-lg-offset-4' role='alert'>" .
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <p>$productUpdate</p>" . "</div>";
                }
                ?>
                <?php
                $getProductId = $product->get_product_by_id($id);
                if ($getProductId) {
                    while ($value = $getProductId->fetch_assoc()) { ?>


                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group col-lg-4 col-lg-offset-4">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name" value="<?=$value['product_name'];?>"
                                       class="form-control"/>
                            </div>

                            <div class="form-group col-lg-4 col-lg-offset-4">
                                <label for="category">Category</label>
                                <select id="select" class="form-control" name="cat_id">
                                    <option>Select Category</option>

                                    <?php
                                    $category = new Category();
                                    $getAllCat = $category->get_all_cat();
                                    if ($getAllCat) {
                                        while ($row = $getAllCat->fetch_assoc()) { ?>

                                            <option
                                                <?php if ($value['cat_id'] == $row['cat_id']) { ?>

                                                    selected="selected"

                                                <?php } ?> value="<?php echo $row['cat_id']; ?>">

                                                <?php echo $row['cat_name']; ?>

                                            </option>

                                        <?php }
                                    } ?>

                                </select>
                            </div>
<!--                            <div class="form-group col-lg-4 col-lg-offset-4">-->
<!--                                <label for="brand_name">Brand Name</label>-->
<!--                                <select id="select" class="form-control" name="brand_id">-->
<!--                                    <option>Select Brand</option>-->
<!--                                    --><?php
//                                    $brand = new Brand();
//                                    $getAllBrand = $brand->get_all_brand();
//                                    if ($getAllBrand) {
//                                        while ($row = $getAllBrand->fetch_assoc()) { ?>
<!---->
<!--                                            <option-->
<!--                                                --><?php //if ($value['brand_id'] == $row['brand_id']) { ?>
<!---->
<!--                                                    selected="selected"-->
<!---->
<!--                                                --><?php //} ?><!-- value="--><?php //echo $row['brand_id']; ?><!--">-->
<!---->
<!--                                                --><?php //echo $row['brand_name']; ?>
<!---->
<!--                                            </option>-->
<!---->
<!--                                        --><?php //}
//                                    } ?>
<!--                                </select>-->
<!--                            </div>-->

                            <div class="form-group col-lg-4 col-lg-offset-4">
                                <label for="product_description">Product Description</label>
                                <textarea rows="8" cols="40" name="product_body"
                                          class="form-control"><?=$value['product_body']; ?></textarea>
                            </div>
                            <div class="form-group col-lg-4 col-lg-offset-4">
                                <label for="product_price">Product Price</label>
                                <input type="number" name="product_price" class="form-control"
                                       value="<?=$value['product_price']; ?>"/>
                            </div>
                            <div class="form-group col-lg-4 col-lg-offset-4">
                                <label for="product_image">Image</label>
                                <img src="<?="/mobilemarket/resource/images/productsimages/{$value['product_image']}"; ?>" alt="productImage"
                                     height="120px"
                                     width="200px" class="thumbnail">
                                <br>
                                <input type="file" name="product_image" class="form-control"/>
                            </div>
                            <div class="form-group col-lg-4 col-lg-offset-4">
                                <label for="total_product">Product Quantity</label>
                                <input type="number" name="total_product" class="form-control"
                                       value="<?=$value['total_product']; ?>"/>
                            </div>
                            <div class="form-group col-lg-4 col-lg-offset-4">
                                <label for="product_type">Product Type</label>
                                <select id="select" class="form-control" name="product_type">
                                    <option>Select Type</option>
                                    <?php if ($value['product_type'] == 0) { ?>
                                        <option selected="selected" value="0">Featured</option>
                                        <option value="1">General</option>
                                    <?php } else { ?>
                                        <option value="0">Featured</option>
                                        <option selected="selected" value="1">General</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-lg-offset-4">
                                <input type="submit" name="submit" class="btn btn-primary btn-block" Value="Update"/>
                            </div>
                        </form>

                    <?php }
                } ?>
            </div> <!-- /.col-lg-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</div> <!-- /#page-wrapper -->


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
<?php include 'inc/footer.php'; ?>


