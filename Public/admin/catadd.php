<?php include 'classes/Category.php'; ?>
<?php
$category = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['cat_name'];

    $catInsert = $category->cat_insert($catName);
}

?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/new_sidebar.php'; ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">
                        Add New Category
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if (isset($catInsert)) {
                        echo "<div class='alert alert-success alert-dismissable col-lg-6 col-lg-offset-4' role='alert'>".
                            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <p>$catInsert</p>"."</div>";
                    }
                    ?>
                    <form action="catadd.php" method="post">

                        <div class="form-group col-lg-4 col-lg-offset-4">
                            <input type="text" name="cat_name" placeholder="Enter Category Name..."
                                   class="form-control"/>
                        </div>
                        <div class="form-group col-lg-3">
                            <input type="submit" name="submit" class="btn btn-primary" Value="Save"/>
                        </div>


                    </form>
                </div> <!-- /.col-lg-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div><!-- /#page-wrapper -->
<?php include 'inc/footer.php'; ?>