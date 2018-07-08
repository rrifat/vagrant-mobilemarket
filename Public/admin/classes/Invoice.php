<?php
/**
 * Created by PhpStorm.
 * User: Rifat Alam
 * Date: 5/20/2018
 * Time: 11:13 AM
 */

$filePath = realpath(dirname(__FILE__));

include_once $filePath.'/../lib/Database.php';
include_once $filePath.'/../helpers/Format.php';

class Invoice
{
    private $database;

    /**
     * Invoice constructor.
     */
    public function __construct()
    {
        $this->database = new Database();
    }

    public function get_invoice_dates()
    {
        $query = "SELECT DISTINCT invoice_dates FROM invoice";

        $result = $this->database->select($query);

        return $result;
    }

    public function get_all()
    {
        $query = "SELECT  * FROM invoice";

        $result = $this->database->select($query);

        return $result;
    }

    public function find_by_date($date)
    {
        $query = "SELECT * FROM invoice WHERE invoice_dates = '$date'";

        $result = $this->database->select($query);

        return $result;
    }

    public function find_products_by_invoice_id($id)
    {
        $query = "SELECT p.product_name, p.product_price, p.product_image, o.invoice_quantity, o.total_price FROM 
                  products p, orders o WHERE 
                  o.invoice_id = '$id' AND 
                  o.product_id = p.product_id";

        $result = $this->database->select($query);

        return $result;
    }

    public function change_shipping_status($invoice_id)
    {
        $query = "UPDATE invoice SET shipping_status = '1' WHERE invoice_id  = '$invoice_id'";
        $result = $this->database->update($query);
        return $result;
    }

    public function find_total_price_by_invoice_id($id)
    {
        $query = "SELECT total_price FROM orders WHERE invoice_id = '$id' LIMIT 1";

        $result = $this->database->select($query);
        $price = 0;
        if ($result) {
            $price = $result->fetch_assoc()['total_price'];
        }

        return $price;
    }
    
}