<?php
        function insert_category(){
              
            global $connection;

            if (isset($_POST["add-submit"])) {
                $cattile = $_POST["cat_title"];
                if ($cattile == "" || empty($cattile)) {
                    echo "this field must be filled";
                } else {
                    $cattile = mysqli_real_escape_string($connection, $cattile);
                    $query = "INSERT INTO categories(cat_title) VALUES (?)";
                   
                    $stmt =mysqli_prepare($connection,$query);

                    mysqli_stmt_bind_param($stmt,'s', $cattile);

                    mysqli_stmt_execute($stmt);



                   
                    if (!$stmt) {
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