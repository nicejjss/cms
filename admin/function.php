<?php
        function insert_category(){
              
            global $connection;

            if (isset($_POST["add-submit"])) {
                $cattile = $_POST["cat_title"];
                if ($cattile == "" || empty($cattile)) {
                    echo "this field must be filled";
                } else {
                    $cattile = mysqli_real_escape_string($connection, $cattile);
                    $query = "INSERT INTO categories(cat_title) VALUES ('$cattile')";
                    $result = mysqli_query($connection, $query);
                    if (!$result) {
                        die("Error: " . mysqli_error($connection));
                    }
                }
            }

        }

        function DeleteCategory(){
            global $connection;
 //delete category
 if (isset($_GET["delete"])) {
    $delete_cat = $_GET["delete"];
    $query = "DELETE FROM categories WHERE cat_id = $delete_cat";
    $result = mysqli_query($connection, $query);
    header("location: categories.php");
 }
        }
?>