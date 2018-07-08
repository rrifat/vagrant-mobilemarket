<?php
$filePath = realpath(dirname(__FILE__));
include_once 'lib/Database.php';
include_once 'helpers/Format.php';
?>


<?php

class Category
{
    private $database;
    private $format;

    public function __construct()
    {
        $this->database = new Database();
        $this->format = new Format();
    }

    public function cat_insert($catName)
    {
        $catName = $this->format->validation($catName);
        $catName = mysqli_real_escape_string($this->database->link, $catName);

        if (empty($catName)) {
            $msg = "Category field must not be empty";
            return $msg;
        } else {
            $query = "INSERT INTO categories (cat_name) VALUES ('$catName') ";
            $catInsert = $this->database->insert($query);

            if ($catInsert) {
                $msg = "<span style='color: green; font-size: 18px;'>" . "Category inserted successfully" . "</span>";
                return $msg;
            } else {
                $msg = "Please insert Category Name";
                return $msg;
            }

        }

    }

    public function get_cat_list()
    {
        $query = " SELECT * FROM categories ORDER BY cat_id DESC ";
        $result = $this->database->select($query);
        if (!empty($result)) {
            $i = 0;
        while ($row = $result->fetch_assoc()) {
            $i++;
            $getCatList = <<<DELIMETER
                        <tr class="odd gradeX">
                            <td>{$i}</td>
                            <td>{$row['cat_name']}</td>
                            <td><a class="btn btn-success" href="catedit.php?catid={$row['cat_id']}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</a>&nbsp;&nbsp;<a class="btn btn-danger" href="?delcat={$row['cat_id']}" onclick="return confirm('Are You Sure to delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
</a></td>
                        </tr>
DELIMETER;
            echo $getCatList;
        }
        

        }
        // else
        // {
        //     echo "No Category Exists";
        // }
    }

    public function get_cat_list_for_nav()
    {
        $query = " SELECT * FROM categories ORDER BY cat_id DESC ";
        $result = $this->database->select($query);

        return $result;
    }

    public function get_cat_id($id)
    {
        $query = "SELECT * FROM categories WHERE cat_id = '$id' ";
        $result = $this->database->select($query);
        while ($row = $result->fetch_assoc()) {
            $getCatId = <<<DELIMETER
                
                    <input type="text" name="cat_name" value="{$row['cat_name']}" class="form-control"/>
                 
DELIMETER;
            echo $getCatId;

        }
    }

    public function get_cat_name_by_id($id)
    {
        $query = "SELECT * FROM categories WHERE cat_id = '$id' ";
        $result = $this->database->select($query);
        return $result;
    }

    public function cat_update($catName, $id)
    {
        $catName = $this->format->validation($catName);
        $catName = mysqli_real_escape_string($this->database->link, $catName);
        $id = mysqli_real_escape_string($this->database->link, $id);

        if (empty($catName)) {
            $msg = "Category field must not be empty";
            return $msg;
        } else {
            $query = "UPDATE categories SET ";
            $query .= "cat_name = '$catName' ";
            $query .= "WHERE cat_id = '$id' ";

            $result = $this->database->update($query);

            if ($result) {
                $msg = "<span style='color: green; font-size: 18px;'>" . "Category updated successfully" . "</span>";
                return $msg;
            } else {
                $msg = "Category not updated";
                return $msg;
            }
        }
    }

    public function delete_cat($id)
    {
        $query = "DELETE FROM categories WHERE cat_id = '$id'";
        $result = $this->database->delete($query);

        if ($result) {
            $msg = "<span style='color: green; font-size: 18px;'>" . "Category deleted successfully" . "</span>";
            return $msg;

        }
    }

    // Functions for AddProduct

    public function get_all_cat()
    {
        $query = " SELECT * FROM categories ORDER BY cat_id DESC ";
        $result = $this->database->select($query);

        return $result;
    }

    public function get_total_categories()
    {
        $query = "SELECT COUNT(*) FROM categories";
        $result = $this->database->select($query)->fetch_assoc()["COUNT(*)"];

        return $result;
    }


}