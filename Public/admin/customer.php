<?php include 'inc/header.php'; ?>
<?php include 'inc/new_sidebar.php'; ?>
<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath . '/../classes/Customer.php';

?>

<?php
if (!isset($_GET['cust-id']) || $_GET['cust-id'] == NULL) {
    echo "<script>window.location = 'inbox.php'</script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['cust-id']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>window.location = 'inbox.php'</script>";
}

?>


    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">
                        Customer Details
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="post">
                        <?php
                        $customer = new Customer();
                        $getCustomerId = $customer->get_customer_id($id);
                        if ($getCustomerId) {
                            while ($row = $getCustomerId->fetch_assoc()) { ?>

                                <div class="form-group col-lg-4 col-lg-offset-4">
                                    <label for="cust_name">Name</label>
                                    <input type="text" value="<?php echo $row['customer_name']; ?>"
                                           class="form-control" readonly/>
                                </div>
                                <div class="form-group col-lg-4 col-lg-offset-4">
                                    <label for="cust_address">Address</label>
                                    <input type="text" value="<?php echo $row['customer_address']; ?>"
                                           class="form-control" readonly/>
                                </div>
                                <div class="form-group col-lg-4 col-lg-offset-4">
                                    <label for="cust_city">City</label>
                                    <input type="text" value="<?php echo $row['customer_city']; ?>"
                                           class="form-control" readonly/>
                                </div>
                                <div class="form-group col-lg-4 col-lg-offset-4">
                                    <label for="cust_country">Country</label>
                                    <input type="text" value="<?php echo $row['customer_country']; ?>"
                                           class="form-control" readonly/>
                                </div>
                                <div class="form-group col-lg-4 col-lg-offset-4">
                                    <label for="cust_zip">Zip</label>
                                    <input type="text" value="<?php echo $row['customer_zip']; ?>"
                                           class="form-control" readonly/>
                                </div>
                                <div class="form-group col-lg-4 col-lg-offset-4">
                                    <label for="cust_email">Email</label>
                                    <input type="text" value="<?php echo $row['customer_email']; ?>"
                                           class="form-control" readonly/>
                                </div>
                                <div class="form-group col-lg-4 col-lg-offset-4">
                                    <input type="submit" name="submit" class="btn btn-default" Value="Ok"/>
                                </div>
                            <?php }
                        } ?>
                    </form>
                </div> <!-- /.col-lg-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
<?php include 'inc/footer.php'; ?>