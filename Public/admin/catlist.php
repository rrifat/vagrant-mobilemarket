<?php include 'inc/header.php'; ?>
<?php include 'inc/new_sidebar.php'; ?>
<?php include "classes/Category.php"; ?>
<?php

$category = new Category();
if (isset($_GET['delcat'])) {
    $id = $_GET['delcat'];

    $deleteCat = $category->delete_cat($id);
}


?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center">
                    Category List
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-2">
                <?php
                if (isset($deleteCat)) {
                    echo "<div class='alert alert-success alert-dismissable col-lg-6 col-lg-offset-3' role='alert'>".
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <p>$deleteCat</p>"."</div>";
                }
                ?>
            <table class="table table-striped" id="">
                <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $category->get_cat_list(); ?>
                </tbody>
            </table>
            </div> <!-- /.col-lg-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</div> <!-- /#page-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>

<?php include 'inc/footer.php'; ?>

