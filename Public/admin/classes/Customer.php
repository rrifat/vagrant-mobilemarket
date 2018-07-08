<?php
/**
 * Created by PhpStorm.
 * User: Rifat Alam
 * Date: 5/20/2018
 * Time: 8:05 PM
 */
$filePath = realpath(dirname(__FILE__));

include_once $filePath.'/../lib/Database.php';
include_once $filePath.'/../helpers/Format.php';

class Customer
{
    private $database;

    /**
     * Pagination constructor.
     */
    public function __construct()
    {
        $this->database = new Database();
    }

    public function get_all_customers()
    {
        $query = "SELECT * FROM customers";

        $result = $this->database->select($query);

        return $result;
    }
}