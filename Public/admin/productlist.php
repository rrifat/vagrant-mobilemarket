<?php include 'inc/header.php'; ?>
<?php include 'inc/new_sidebar.php'; ?>
<?php include "classes/Product.php"; ?>

<?php

$product = new Product();
if (isset($_GET['delpro'])) {
    $id = $_GET['delpro'];

    $deleteProduct = $product->delete_product($id);
}

?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center">
                    Product List
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-2">
                <?php
                if (isset($deleteProduct)) {
                    echo "<div class='alert alert-success alert-dismissable col-lg-6 col-lg-offset-4' role='alert'>".
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <p>$deleteProduct</p>"."</div>";
                }
                ?>
                <table class="table table-striped" id="example">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Category</th>
<!--                        <th>Brand</th>-->
                        <th>Description</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $product->get_all_product();
                    ?>

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
