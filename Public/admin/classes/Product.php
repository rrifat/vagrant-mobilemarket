<?php
$filePath = realpath(dirname(__FILE__));

include_once $filePath.'/../lib/Database.php';
include_once $filePath.'/../helpers/Format.php';
?>

<?php

class Product
{
    private $database;
    private $format;

    public function __construct()
    {
        $this->database = new Database();
        $this->format = new Format();
    }

    public function product_insert($data, $file)
    {
//        $productName = $this->format->validation($data['product_name']);
//        $catId = $this->format->validation($data['cat_id']);
//        $productBody = $this->format->validation($data['product_body']);
//        $productPrice = $this->format->validation($data['product_price']);
//        $totalProduct = $this->format->validation($data['total_product']);
//        $productType = $this->format->validation($data['product_type']);

        $productName = mysqli_real_escape_string($this->database->link, $data['product_name']);
        $catId = mysqli_real_escape_string($this->database->link, $data['cat_id']);
        $productBody = mysqli_real_escape_string($this->database->link, $data['product_body']);
        $productPrice = mysqli_real_escape_string($this->database->link, $data['product_price']);
        $totalProduct = mysqli_real_escape_string($this->database->link, $data['total_product']);
        $productType = mysqli_real_escape_string($this->database->link, $data['product_type']);

        $filePermission = array('jpg', 'jpeg', 'png', 'gif');
        $fileName = $file['product_image']['name'];
        $fileSize = $file['product_image']['size'];
        $fileTemp = $file['product_image']['tmp_name'];

        $div = explode(".", $fileName);
        $fileExt = strtolower(end($div));
        $uniqueImage = substr(md5(time()), 0, 10) . '.' . $fileExt;
        $uploadImage = "{$_SERVER['DOCUMENT_ROOT']}./mobilemarket/resource/images/productsimages/" . $uniqueImage;

        if ($productName == "" || $catId == "" || $productBody == "" || $productPrice == "" || $totalProduct == "" || $productType == "" || $fileName == "") {
            $msg = "<span style='color: red; font-size: 18px;'>" . "Product field must not be empty" . "</span>";
            return $msg;
        } else {
            if (!empty($fileName)) {
                if ($fileSize > 1058567) {
                    echo "File Size should be less than 1 MB";
                } else if (in_array($fileExt, $filePermission) === false) {
                    echo "<span class = 'error'> You can upload only-- " . implode(',', $filePermission) . "</span>";
                } else {
                    move_uploaded_file($fileTemp, $uploadImage);
                    $query = "INSERT INTO products 
                      (product_name, cat_id, product_body, product_price, total_product, product_image, product_type) 
                      VALUES 
                      ('$productName', '$catId', '$productBody', '$productPrice','$totalProduct', '$uniqueImage', '$productType')";
                    $result = $this->database->insert($query);
                    if ($result) {
                        $msg = "<span style='color: green; font-size: 18px;'>" . "Product inserted successfully" . "</span>";
                        return $msg;
                    } else {
                        $msg = "<span style='color: red; font-size: 18px;'>" . "Product not inserted" . "</span>";
                        return $msg;
                    }
                }
            }
        }

    }

    public function get_all_product()
    {
        $query = "SELECT p.*, c.cat_name FROM products as p, categories as c WHERE p.cat_id = c.cat_id";
//        $query = "SELECT p.*, b.brand_name, c.cat_name
//                  FROM product as p, category as c, brands as b
//                  WHERE p.cat_id = c.cat_id AND p.brand_id = b.brand_id";


        /*
        $query = "SELECT product.*, brands.brand_name, category.cat_name 
                  FROM product
                  INNER JOIN category
                  ON product.cat_id = category.cat_id
                  INNER JOIN brands
                  ON product.brand_id = brands.brand_id
                  ORDER BY product.product_id DESC ";
        */

        $result = $this->database->select($query);
        $i = 0;
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
            $i++;

            if ($row['product_type'] == 0) {
                $feature = "Featured";
            } else {
                $feature = "General";
            }

            $productList = <<<DELIMETER
            <tr class="odd gradeX">
                    <td>{$i}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['cat_name']}</td>
                    <td>{$this->format->text_shorten($row['product_body'], 50)} </td>
                    <td>৳ {$row['product_price']}</td>
                    <td>{$row['total_product']}</td>
                    <td><img src="/mobilemarket/resource/images/productsimages/{$row['product_image']}" alt="productImage" height="40px" width="60px"></td>
                    <td>{$feature}</td>
                    <td><a class="btn btn-success btn-sm" href="productedit.php?proid={$row['product_id']}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</a><a class="btn btn-danger btn-sm" href="?delpro={$row['product_id']}" onclick="return confirm('Are You Sure to delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
</a></td> </tr>
DELIMETER;
            echo $productList;

        }
        }
        
    }

    public function product_update($data, $file, $id)
    {
        $productName = $this->format->validation($data['product_name']);
        $catId = $this->format->validation($data['cat_id']);
//        $brandId = $this->format->validation($data['brand_id']);
        $productBody = $this->format->validation($data['product_body']);
        $productPrice = $this->format->validation($data['product_price']);
        $productType = $this->format->validation($data['product_type']);

        $totalProduct = mysqli_real_escape_string($this->database->link, $data['total_product']);
        $productName = mysqli_real_escape_string($this->database->link, $data['product_name']);
        $catId = mysqli_real_escape_string($this->database->link, $data['cat_id']);
//        $brandId = mysqli_real_escape_string($this->database->link, $data['brand_id']);
        $productBody = mysqli_real_escape_string($this->database->link, $data['product_body']);
        $productPrice = mysqli_real_escape_string($this->database->link, $data['product_price']);
        $productType = mysqli_real_escape_string($this->database->link, $data['product_type']);

        $filePermission = array('jpg', 'jpeg', 'png', 'gif');
        $fileName = $file['product_image']['name'];
        $fileSize = $file['product_image']['size'];
        $fileTemp = $file['product_image']['tmp_name'];

        $div = explode(".", $fileName);
        $fileExt = strtolower(end($div));
        $uniqueImage = substr(md5(time()), 0, 10) . '.' . $fileExt;
        $uploadImage = $_SERVER['DOCUMENT_ROOT']."/mobilemarket/resource/images/productsimages/" . $uniqueImage;

        if ($productName == "" || $catId == "" || $productBody == "" || $productPrice == "" || $productType == "") {
            $msg = "<span style='color: red; font-size: 18px;'>" . "Product field must not be empty" . "</span>";
            return $msg;
        } else {
            if (!empty($fileName)) {

                if ($fileSize > 1058567) {
                    echo "File Size should be less than 1 MB";
                } else if (in_array($fileExt, $filePermission) === false) {
                    echo "<span class = 'error'> You can upload only-- " . implode(',', $filePermission) . "</span>";
                } else {
                    move_uploaded_file($fileTemp, $uploadImage);
                    $query = "UPDATE products
                               SET
                               product_name = '$productName',
                               cat_id = '$catId',
                               product_body = '$productBody',
                               product_price = '$productPrice',
                               product_image = '$uniqueImage',
                               product_type = '$productType',
                               total_product= '$totalProduct'
                               WHERE product_id  = '$id'";

                    $result = $this->database->update($query);
                    if ($result) {
                        $msg = "<span style='color: green; font-size: 18px;'>" . "Product updated successfully" . "</span>";
                        return $msg;
                    } else {
                        $msg = "<span style='color: red; font-size: 18px;'>" . "Product not updated" . "</span>";
                        return $msg;
                    }
                }
            } else {
                $query = "UPDATE products 
                               SET
                               product_name = '$productName',
                               cat_id = '$catId',
                               product_body = '$productBody',
                               product_price = '$productPrice',
                               product_type = '$productType',
                               total_product= '$totalProduct'
                               WHERE product_id  = '$id'";

                $result = $this->database->update($query);
                if ($result) {
                    $msg = "<span style='color: green; font-size: 18px;'>" . "Product updated successfully" . "</span>";
                    return $msg;
                } else {
                    $msg = "<span style='color: red; font-size: 18px;'>" . "Product not updated" . "</span>";
                    return $msg;
                }
            }
        }
    }

    public function get_product_by_id($id)
    {
        $query = "SELECT * FROM products WHERE product_id = '$id'";
        $result = $this->database->select($query);
        return $result;
    }

    public function delete_product($id)
    {
        $query = "SELECT * FROM products WHERE product_id = '$id'";
        $result = $this->database->select($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {

                $imgLink = $row['product_image'];
                unlink($imgLink);
            }
        }

        $delQuery = "DELETE FROM products WHERE product_id = '$id'";
        $delData = $this->database->delete($delQuery);
        if ($delData) {
            $msg = "<span style='color: green; font-size: 18px;'>" . "Product deleted successfully" . "</span>";
            return $msg;
        } else {
            $msg = "<span style='color: green; font-size: 18px;'>" . "Product not deleted" . "</span>";
            return $msg;
        }
    }

    public function get_featured_product()
    {
        $query = "SELECT * FROM products WHERE product_type = '0' ORDER BY product_id DESC LIMIT 4";
        $result = $this->database->select($query);
        return $result;
    }

    public function get_new_product()
    {
        $query = "SELECT * FROM products ORDER BY product_id DESC LIMIT 8";
        $result = $this->database->select($query);
        return $result;
    }

    public function get_single_product($id)
    {
        $query = "SELECT p.*, b.brand_name, c.cat_name 
                  FROM products as p, categories as c, brands as b
                  WHERE p.brand_id = b.brand_id AND p.cat_id = c.cat_id AND p.product_id = '$id'";
        $result = $this->database->select($query);
        return $result;
    }

    public function oneplus_lates_product()
    {
        $query = "SELECT * FROM products WHERE brand_id = '8' ORDER BY product_id DESC LIMIT 1";
        $result = $this->database->select($query);
        return $result;
    }

    public function xiaomi_lates_product()
    {
        $query = "SELECT * FROM products WHERE brand_id = '9' ORDER BY product_id DESC LIMIT 1";
        $result = $this->database->select($query);
        return $result;
    }

    public function google_lates_product()
    {
        $query = "SELECT * FROM products WHERE brand_id = '10' ORDER BY product_id DESC LIMIT 1";
        $result = $this->database->select($query);
        return $result;
    }

    public function apple_lates_product()
    {
        $query = "SELECT * FROM products WHERE brand_id = '11' ORDER BY product_id DESC LIMIT 1";
        $result = $this->database->select($query);
        return $result;
    }

    public function get_product_by_cat($id)
    {
        $catId = mysqli_real_escape_string($this->database->link, $id);
        $query = "SELECT * FROM products WHERE cat_id = '$catId'";
        $result = $this->database->select($query);
        return $result;
    }

    public function insert_kmpare_data($custId, $productId)
    {
        $custId = mysqli_real_escape_string($this->database->link, $custId);
        $productId = mysqli_real_escape_string($this->database->link, $productId);
        $sessionId = session_id();

        $checkquery = "SELECT * FROM compare WHERE product_id = '$productId' AND cust_id = '$custId'";
        $insertCheckRow = $this->database->select($checkquery);
        if ($insertCheckRow) {
            $msg = "<span style='color: red; font-size: 18px;'>" . "Already Added" . "</span>";
            return $msg;
        }

        $query = "SELECT * FROM product WHERE product_id = '$productId'";
        $row = $this->database->select($query)->fetch_assoc();
        if ($row) {
            $productId = $row['product_id'];
            $productName = $row['product_name'];
            $productPrice = $row['product_price'];
            $productImg = $row['product_image'];

            $query = "INSERT INTO compare 
                            SET 
                            cust_id = '$custId',
                            product_id = '$productId',
                            product_name = '$productName',
                            product_price = '$productPrice',
                            product_image = '$productImg',
                            session_id = '$sessionId'";

            $insertRow = $this->database->insert($query);
            if ($insertRow) {
                $msg = "<span style='color: green; font-size: 18px;'>" . "Added to compare" . "</span>";
                return $msg;
            }
        }

    }

    public function get_kmpare_proudct($custId)
    {
        $query = "SELECT * FROM compare WHERE cust_id = '$custId'";
        $result = $this->database->select($query);
        return $result;
    }

    public function del_data_from_kmpare()
    {
        $sessioId = session_id();
        $query = "DELETE FROM compare WHERE session_id = '$sessioId'";
        $result = $this->database->delete($query);
        return $result;
    }

    public function check_kmpare_table()
    {
        $sessionId = session_id();
        $query = "SELECT * FROM compare WHERE session_id = '$sessionId'";
        $result = $this->database->select($query);
        return $result;
    }

    public function get_total_products()
    {
        $query = "SELECT COUNT(*) FROM products";
        $result = $this->database->select($query)->fetch_assoc()["COUNT(*)"];

        return $result;
    }
}