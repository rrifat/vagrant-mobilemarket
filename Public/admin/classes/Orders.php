<?php
/**
 * Created by PhpStorm.
 * User: Rifat Alam
 * Date: 5/19/2018
 * Time: 2:20 PM
 */
$filePath = realpath(dirname(__FILE__));

include_once $filePath.'/../lib/Database.php';
include_once $filePath.'/../helpers/Format.php';


class Orders
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function todays_orders_info()
    {
        $today = date("Y-m-d");
//        $today = "2018-05-17";
//        var_dump(gettype($today)); exit;

        $query = "SELECT o.*, i.invoice_dates FROM orders o, invoice i WHERE o.invoice_id = i.invoice_id AND i.invoice_dates = '$today' ";

        $result = $this->database->select($query);
        $total_orders = 0;
        $sum = 0;

        if ($result) {
            $total_orders = $result->num_rows;
        }

        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $sum += $row["total_price"];
            }
        }

        $orders_info = [ 'total_orders' => $total_orders, 'sum' => $sum];

        return $orders_info;
    }

    public function last_week_orders_info()
    {
        $today = date("Y-m-d");
        $week_interavl = date("Y-m-d", strtotime('-7 day', strtotime($today)));

        $query = "SELECT o.*, i.invoice_dates FROM orders o, invoice i WHERE o.invoice_id = i.invoice_id AND i.invoice_dates BETWEEN '$week_interavl' AND '$today'";

        $result = $this->database->select($query);
        $total_orders = 0;
        $sum = 0;

        if ($result) {
            $total_orders = $result->num_rows;
        }

        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $sum += $row["total_price"];
            }
        }

        $orders_info = [ 'total_orders' => $total_orders, 'sum' => $sum];

        return $orders_info;
    }

    public function last_month_orders_info()
    {
        $today = date("Y-m-d");
        $month_interavl = date("Y-m-d", strtotime('-1 month', strtotime($today)));

        $query = "SELECT o.*, i.invoice_dates FROM orders o, invoice i WHERE o.invoice_id = i.invoice_id AND i.invoice_dates BETWEEN '$month_interavl' AND '$today'";

        $result = $this->database->select($query);
        $total_orders = 0;
        $sum = 0;

        if ($result) {
            $total_orders = $result->num_rows;
        }

        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $sum += $row["total_price"];
            }
        }

        $orders_info = [ 'total_orders' => $total_orders, 'sum' => $sum];

        return $orders_info;
    }

    public function get_customers_by_year()
    {
        $customers = [];

        $query = "SELECT COUNT(customer_id) as count FROM customers GROUP BY YEAR(created_at) ORDER BY created_at";

        $result = $this->database->select($query);

        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $customers[] = $row["count"];
            }
        }

        return $customers;
    }

    public function get_total_by_year()
    {
        $sales = [];
        $query = "SELECT SUM(o.total_price) as total_price,YEAR(invoice_dates) FROM orders o, invoice i WHERE o.invoice_id = i.invoice_id GROUP BY YEAR(i.invoice_dates) ORDER BY i.invoice_dates";

        $result = $this->database->select($query);

        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $sales[] = $row["total_price"];
            }
        }

        return $sales;
    }


}