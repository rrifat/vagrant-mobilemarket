<?php include 'inc/header.php'; ?>
<?php include 'inc/new_sidebar.php'; ?>
<?php include 'classes/Brand.php'; ?>
<?php
$brand = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brand_name'];

    $brandInsert = $brand->brand_insert($brandName);
}

?>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">
                        Add New Brand
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if (isset($brandInsert)) {
                        echo "<div class='alert alert-success alert-dismissable col-lg-6 col-lg-offset-4' role='alert'>".
                            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <p>$brandInsert</p>"."</div>";
                    }
                    ?>
                    <form action="brand_add.php" method="post">
                        <div class="form-group col-lg-4 col-lg-offset-4">
                            <input type="text" name="brand_name" placeholder="Enter Brand Name..."
                                   class="form-control"/>
                        </div>
                        <div class="form-group col-lg-3">
                            <input type="submit" name="submit" class="btn btn-primary" Value="Save"/>
                        </div>
                    </form>
                </div> <!-- /.col-lg-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
<?php include 'inc/footer.php'; ?>