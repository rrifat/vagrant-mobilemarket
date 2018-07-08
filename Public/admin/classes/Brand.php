<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath.'/../lib/Database.php';
include_once $filePath.'/../helpers/Format.php';

?>

<?php

class Brand
{
    private $database;
    private $format;

    public function __construct()
    {
        $this->database = new Database();
        $this->format = new Format();
    }
    public function brand_insert($brandName)
    {
        $brandName = $this->format->validation($brandName);
        $brandName = mysqli_real_escape_string($this->database->link, $brandName);

        if (empty($brandName)) {
            $msg = "Brand field must not be empty";
            return $msg;
        } else {
            $query = "INSERT INTO brands (brand_name) VALUES ('$brandName') ";
            $result = $this->database->insert($query);

            if ($result) {
                $msg = "<span style='color: green; font-size: 18px;'>" . "Brand inserted successfully" . "</span>";
                return $msg;
            } else {
                $msg = "Please insert Brand Name";
                return $msg;
            }

        }

    }
    public function get_brand_list()
    {
        $query = " SELECT * FROM brands ORDER BY brand_id DESC ";
        $result = $this->database->select($query);
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $i++;
            $getBrandList = <<<DELIMETER
                        <tr class="odd gradeX">
							<td>{$i}</td>
							<td>{$row['brand_name']}</td>
    						<td><a class="btn btn-success" href="brand_edit.php?brandid={$row['brand_id']}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</a>&nbsp;&nbsp;<a class="btn btn-danger" href="?delbrand={$row['brand_id']}" onclick="return confirm('Are You Sure to delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
</a></td>
                        </tr>
DELIMETER;
            echo $getBrandList;

        }
    }
    public function get_brand_id($id)
    {
        $query = "SELECT * FROM brands WHERE brand_id = '$id' ";
        $result = $this->database->select($query);
        while ($row = $result->fetch_assoc()) {
            $getCatId = <<<DELIMETER
                <td>
                    <input type="text" name="brand_name" value="{$row['brand_name']}"  class="medium" />
                 </td>
DELIMETER;
            echo $getCatId;

        }
    }

    public function brand_update($brandName, $id)
    {
        $brandName = $this->format->validation($brandName);
        $brandName = mysqli_real_escape_string($this->database->link, $brandName);
        $id = mysqli_real_escape_string($this->database->link, $id);

        if (empty($brandName)) {
            $msg = "Brand field must not be empty";
            return $msg;
        } else {
            $query = "UPDATE brands SET ";
            $query .= "brand_name = '$brandName' ";
            $query .= "WHERE brand_id = '$id' ";

            $result = $this->database->update($query);

            if ($result) {
                $msg = "<span style='color: green; font-size: 18px;'>" . "Category updated successfully" . "</span>";
                return $msg;
            } else {
                $msg = "Brand not updated";
                return $msg;
            }
        }
    }

    public function delete_brand($id)
    {
        $query = "DELETE FROM brands WHERE brand_id = '$id'";
        $result = $this->database->delete($query);

        if ($result) {
            $msg = "<span style='color: green; font-size: 18px;'>" . "Brand deleted successfully" . "</span>";
            return $msg;

        }
    }

    // Functins for AddProduct

    public function get_all_brand()
    {
        $query = " SELECT * FROM brands ORDER BY brand_id DESC ";
        $result = $this->database->select($query);
        return $result;

    }

}