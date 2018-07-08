<?php
/**
 * Created by PhpStorm.
 * User: Rifat Alam
 * Date: 5/20/2018
 * Time: 8:02 PM
 */
include_once "classes/Customer.php";
$customer = new Customer();

$customers = $customer->get_all_customers();

?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/new_sidebar.php'; ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row col-md-9 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center">System's Customers</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Product Email</th>
                                <th>Product Mobile</th>
                                <th>Ordered Address</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($customers)): $i = 0?>
                                    <?php while ($row = $customers->fetch_assoc()): $i++?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><?=$row['customer_name']?></td>
                                        <td><?=$row['customer_email']?></td>
                                        <td><?=$row['customer_number']?></td>
                                        <td><?=$row['customer_address']?></td>
                                    </tr>
                                    <?php endwhile;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-responsive -->
                </div> <!-- .panel-body -->
            </div>
        </div> <!-- .row -->
    </div>
</div>
