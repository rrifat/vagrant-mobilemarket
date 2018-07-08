<?php
//include "classes/Cart.php";
include 'inc/header.php';
include 'inc/new_sidebar.php';
?>

<?php
$cart = new Cart();
$format = new Format();
?>

<?php
if (isset($_GET['shift-id'])) {
    $shiftId = $_GET['shift-id'];
    $date = $_GET['time'];
    $price = $_GET['price'];

    $shifted = $cart->product_shifted($shiftId, $date, $price);
}

if (isset($_GET['del-shift-id'])) {
    $shiftId = $_GET['del-shift-id'];
    $date = $_GET['time'];
    $price = $_GET['price'];

    $delShifted = $cart->del_product_shifted($shiftId, $date, $price);
}
?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">
                        Orders
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-2">
                    <table class="table table-striped" id="example">
                        <?php
                        if (isset($delShifted)) {
                            echo "<div class='alert alert-success alert-dismissable col-lg-6 col-lg-offset-4' role='alert'>".
                                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <p>$delShifted</p>"."</div>";
                        }
                        ?>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Order Time</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Cust Id</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $getOrder = $cart->get_ordered_product_admin();
                        if ($getOrder) {
                            while ($row = $getOrder->fetch_assoc()) { ?>


                                <tr class="odd gradeX">
                                    <td><?php echo $row['product_id']; ?></td>
                                    <td><?php echo $format->format_date($row['order_date']); ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['product_qty']; ?></td>
                                    <td>৳ <?php echo $row['product_price']; ?></td>
                                    <td><?php echo $row['cust_id']; ?></td>
                                    <td><a href="customer.php?cust-id=<?php echo $row['cust_id']; ?>" class="btn btn-default"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a></td>

                                    <?php if ($row['order_status'] == '0') { ?>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="?shift-id=<?php echo $row['cust_id']; ?>&price=<?php echo $row['product_price']; ?>&time=<?php echo $row['order_date']; ?>">Shifted</a>
                                        </td>
                                    <?php } else if ($row['order_status'] == '1') { ?>
                                        <td><?php echo "<span class='label label-warning'>Pending</span>";?></td>
                                    <?php } else { ?>
                                        <td>
                                            <a class="btn btn-danger btn-sm" href="?del-shift-id=<?php echo $row['cust_id']; ?>&price=<?php echo $row['product_price']; ?>&time=<?php echo $row['order_date']; ?>">Remove </a>
                                        </td>
                                    <?php } ?>

                                </tr>

                            <?php }
                        } ?>

                        </tbody>
                    </table>
                </div> <!-- /.col-lg-10 .col-lg-offset-2 -->
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