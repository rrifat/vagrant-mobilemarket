<?php include 'inc/header.php'; ?>
<?php include 'inc/new_sidebar.php'; ?>
<?php include "classes/Product.php"; ?>
<?php include "classes/Category.php"; ?>
<?php include "classes/Brand.php"; ?>

<?php
$product = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $productInsert = $product->product_insert($_POST, $_FILES);
}

?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center">
                    Add Product
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (isset($productInsert)) {
                    echo "<div class='alert alert-success alert-dismissable col-lg-6 col-lg-offset-4' role='alert'>" .
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <p>$productInsert</p>" . "</div>";
                }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group col-lg-4 col-lg-offset-4">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" placeholder="Enter Product Name..."
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

                                    <option value="<?php echo $row['cat_id']; ?>"> <?php echo $row['cat_name']; ?> </option>

                                <?php }
                            } ?>

                        </select>
                    </div>
                    <div class="form-group col-lg-4 col-lg-offset-4">
                        <label for="product_description">Product Description</label>
                        <textarea rows="8" cols="40" name="product_body" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-lg-4 col-lg-offset-4">
                        <label for="product_price">Product Price</label>
                        <input type="number" name="product_price" class="form-control"/>
                    </div>
                    <div class="form-group col-lg-4 col-lg-offset-4">
                        <label for="total_product">Product Quantity</label>
                        <input type="number" name="total_product" class="form-control"/>
                    </div>
                    <div class="form-group col-lg-4 col-lg-offset-4">
                        <label for="product_image">Image</label>
                        <input type="file" name="product_image" class="form-control"/>
                    </div>
                    <div class="form-group col-lg-4 col-lg-offset-4">
                        <label for="product_type">Product Type</label>
                        <select id="select" class="form-control" name="product_type">
                            <option>Select Type</option>
                            <option value="0">Featured</option>
                            <option value="1">General</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-4 col-lg-offset-4">
                        <input type="submit" name="submit" class="btn btn-primary btn-block" Value="Add"/>
                    </div>

                </form>











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


