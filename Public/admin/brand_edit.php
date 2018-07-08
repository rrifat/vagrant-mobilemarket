<?php include 'classes/Brand.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/new_sidebar.php';?>
<?php

if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
    //echo "<script>window.location = 'catlist.phps'</script>";
    header("Location: brand_list.php");
} else {
    $id = $_GET['brandid'];
}

$brand = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brand_name'];

    $brandUpdate = $brand->brand_update($brandName, $id);
}

?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">
                        Update Brand
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if (isset($brandUpdate)) {
                        echo "<div class='alert alert-success alert-dismissable col-lg-6 col-lg-offset-4' role='alert'>".
                            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <p>$brandUpdate</p>"."</div>";
                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-group col-lg-4 col-lg-offset-4">
                            <?php $brand->get_brand_id($id); ?>
                        </div>
                        <div class="form-group col-lg-3">
                            <input type="submit" name="submit" class="btn btn-primary" Value="Update"/>
                        </div>
                    </form>
                </div> <!-- /.col-lg-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
<?php include 'inc/footer.php';?>