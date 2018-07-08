
<?php
/**
 * Created by PhpStorm.
 * User: Rifat Alam
 * Date: 5/20/2018
 * Time: 1:03 PM
 */
include_once "classes/Invoice.php";
$invoice = new Invoice();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $invoice_id = $_REQUEST['id'];
    $products = $invoice->find_products_by_invoice_id($invoice_id);
    $total = $invoice->find_total_price_by_invoice_id($invoice_id);
}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/new_sidebar.php'; ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <h3>Select Date</h3>
                        <br>
                        <select name="invoice_dates" class="form-control">
                            <?php if (isset($dates)): ?>
                                <?php while ($row = $dates->fetch_assoc()): ?>
                                    <option value="<?=$row['invoice_dates']?>"
                                        <?php if ($_SERVER['REQUEST_METHOD'] == "POST"):?>
                                            <?php if ($_REQUEST['invoice_dates'] == $row['invoice_dates']):?>
                                                selected
                                            <?php endif;?>
                                        <?php endif;?>
                                    >
                                        <?=date("d F Y", strtotime($row['invoice_dates']))?>
                                    </option>
                                <?php endwhile;?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-default" value="Show All Invoice">
                </form>
            </div>
        </div>
        <br><br>
        <div class="row col-md-9 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center">Products by Invoice Id <?=$invoice_id?></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Product Price</th>
                                <th>Ordered Quantity</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($products)): $i = 0; $sum = 0;?>
                                <?php while ($row = $products->fetch_assoc()): $i++?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><?=$row['product_name']?></td>
                                        <td><img src="<?="/mobilemarket/resource/images/productsimages/".$row['product_image']?>" alt="product_image" height="40px" width="60px"></td>
                                        <td><?=$row['product_price']?></td>
                                        <td><?=$row['invoice_quantity']?></td>
                                        <td><?=$row['total_price']?></td>
                                        <?php $sum += $row['total_price']?>
                                    </tr>
                                <?php endwhile;?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th rowspan="4"><h3>Total</h3></th>
                                <td><h3><?=$sum?></h3></td>
                            </tr>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-responsive -->
                </div> <!-- .panel-body -->
                <a href="invoices.php" class="btn btn-default btn-lg pull-right">Back To Invoices</a>
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</div> <!-- #page-wrapper -->
