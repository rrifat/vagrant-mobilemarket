<?php
/**
 * Created by PhpStorm.
 * User: Rifat Alam
 * Date: 5/20/2018
 * Time: 10:38 AM
 */
include_once "classes/Invoice.php";
?>
<?php
$invoice = new Invoice();
$dates = $invoice->get_invoice_dates();

if (isset($_GET['invoice_dates'])) {
    $invoice_date = $_GET['invoice_dates'];
    $invoices = $invoice->find_by_date($invoice_date);
}
if (isset($_GET['invoice-id'])) {
    $invoice_id = $_REQUEST['invoice-id'];
    $invoice->change_shipping_status($invoice_id);
    $invoices = $invoice->find_by_date($invoice_date);
}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/new_sidebar.php'; ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="" method="GET">
                        <div class="form-group">
                            <h3>Select Date</h3>
                            <br>
                            <select name="invoice_dates" class="form-control">
                                <option>Select</option>
                                <?php if (isset($dates)): ?>
                                    <?php while ($row = $dates->fetch_assoc()): ?>
                                        <option value="<?=$row['invoice_dates']?>"
                                            <?php if (isset($_GET['invoice_dates'])):?>
                                                <?php if ($_GET['invoice_dates'] == $row['invoice_dates']):?>
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
            <div class="row">
                <div class="panel-body col-md-8 col-md-offset-3">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Invoice Id</th>
                                <th>Invoice Paid?</th>
                                <th>Order Time</th>
                                <th>Shipping Status</th>
                                <th>See Products</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($invoices)): ?>
                                    <?php while($row = $invoices->fetch_assoc()): ?>
                                        <tr>
                                            <td><?=$row['invoice_id']?></td>
                                            <td>Yes</td>
                                            <td><?=date("g:i:s a", strtotime($row['invoice_time']))?></td>
                                            <td>
                                                <?php if ($row['shipping_status'] == 1):?>
                                                    <a class="btn btn-success del">Product Delivered</a>
                                                <?php endif; ?>
                                                <?php if ($row['shipping_status'] == 0):?>
                                                    <a href="?invoice-id=<?=$row['invoice_id']?>&invoice_dates=<?=$invoice_date?>" class="btn btn-primary">Confirm</a>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <a href="product_details.php?id=<?=$row['invoice_id']?>">
                                                    <i class="fa fa-eye fa-2x"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-responsive -->

                </div>
            </div>
        </div> <!-- /.container-fluid -->
    </div><!-- /#page-wrapper -->
<script type="text/javascript"></script>
<?php include 'inc/footer.php'; ?>