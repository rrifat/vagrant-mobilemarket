<?php include_once 'inc/header.php' ?>
<?php include_once 'classes/Orders.php'?>
<?php include_once 'classes/Product.php'?>
<?php include_once 'classes/Category.php'?>
<?php
$orders = new Orders();
$product = new Product();
$category = new Category();

$get_customers_by_year = $orders->get_customers_by_year();
$total_sales_by_year = $orders->get_total_by_year();

$todays_orders_info = $orders->todays_orders_info();
$last_week_orders_info = $orders->last_week_orders_info();
$last_month_orders_info = $orders->last_month_orders_info();

$total_products = $product->get_total_products();
$total_categories = $category->get_total_categories();
?>
<div id="wrapper">
    <?php include_once 'inc/new_sidebar.php' ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=$todays_orders_info['total_orders']?></div>
                            <br>
                            <div><strong style="font-size: x-large">Today's Total Orders</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-usd fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=number_format($todays_orders_info['sum'], 2)?></div>
                            <br>
                            <div><strong style="font-size: x-large">Today's Total Sales</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=$last_week_orders_info['total_orders']?></div>
                            <br>
                            <div><strong style="font-size: x-large">Last Week's Orders</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-usd fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=number_format($last_week_orders_info['sum'], 2)?></div>
                            <br>
                            <div><strong style="font-size: x-large">Last Week's Sales</strong></div>
                        </div>
                    </div>
                </div>
<!--                <a href="#">-->
<!--                    <div class="panel-footer">-->
<!--                        <span class="pull-left">View Details</span>-->
<!--                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>-->
<!--                        <div class="clearfix"></div>-->
<!--                    </div>-->
<!--                </a>-->
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=$last_month_orders_info['total_orders']?></div>
                            <br>
                            <div><strong style="font-size: x-large">Last Month's Orders</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-usd fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=number_format($last_month_orders_info['sum'], 2)?></div>
                            <br>
                            <div><strong style="font-size: x-large">Last Month's Sales</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=$total_products?></div>
                            <br>
                            <div><strong style="font-size: x-large">Total Products</strong></div>
                        </div>
                    </div>
                </div>
<!--                <a href="#">-->
<!--                    <div class="panel-footer">-->
<!--                        <span class="pull-left">View Details</span>-->
<!--                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>-->
<!--                        <div class="clearfix"></div>-->
<!--                    </div>-->
<!--                </a>-->
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=$total_categories?></div>
                            <br>
                            <div><strong style="font-size: x-large">Total Categories</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.row -->
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div id="container_customers" style="width:100%; height:400px;"></div>
        </div>
        <div class="col-md-6">
            <div id="container_sales" style="width:100%; height:400px;"></div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
</div>
<script type="text/javascript">
    let customers = new Array(<?=implode(',', $get_customers_by_year);?>);
    let sales = new Array(<?=implode(',', $total_sales_by_year);?>);

    $(function () {
        chart_for_customers();
        chart_for_sales();
    });

    function chart_for_customers() {
        Highcharts.chart('container_customers', {

            title: {
                text: 'Customer Growth, 2017-2020'
            },
            xAxis: {
                title: {
                    text: 'Years'
                }
            },
            yAxis: {
                title: {
                    text: 'Number of Customers'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 2017
                }
            },

            series: [{
                name: 'Customers',
                data: customers
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    }

    function chart_for_sales() {
        Highcharts.chart('container_sales', {

            title: {
                text: 'Sales Growth, 2017-2020'
            },
            xAxis: {
                title: {
                    text: 'Years'
                }
            },
            yAxis: {
                title: {
                    text: 'Amount of Sales'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 2017
                }
            },

            series: [{
                name: 'Sales',
                data: sales
                // data: [24916, 24064, 29742, 29851]
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    }
</script>

<?php include 'inc/footer.php'; ?>
