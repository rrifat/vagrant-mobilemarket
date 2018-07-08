<?php
$filePath = realpath(dirname(__FILE__));
include_once 'classes/Category.php';

?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/new_sidebar.php'; ?>
<?php

if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script>window.location = 'catlist.php'</script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']);
}

$category = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['cat_name'];

    $catUpdate = $category->cat_update($catName, $id);
}

?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">
                        Update Category
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if (isset($catUpdate)) {
                        echo "<div class='alert alert-success alert-dismissable col-lg-6 col-lg-offset-4' role='alert'>".
                            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <p>$catUpdate</p>"."</div>";
                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-group col-lg-4 col-lg-offset-4">
                            <?php $category->get_cat_id($id); ?>
                        </div>
                        <div class="form-group col-lg-3">
                            <input type="submit" name="submit" class="btn btn-primary" Value="Update"/>
                        </div>
                    </form>
                </div> <!-- /.col-lg-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
<?php include 'inc/footer.php'; ?>