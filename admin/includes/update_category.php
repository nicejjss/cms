<form action="" method="POST">
                            <div class="form-group">
                                <label for="cat_label">UpdateCategory</label>

                                <?php

                                if (isset($_GET["edit"])) {
                                    $edit = $_GET["edit"];
                                    $query = "SELECT `cat_id`, `cat_title` FROM `categories` WHERE cat_id = $edit ";
                                    $result = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $cid = $row["cat_id"];
                                        $cname = $row["cat_title"];

                                ?>
                                        <input name="edit-name" value="<?php echo $cname ?>" type="text" class="form-control" name="cat_title">
                                    <?php }
                                } else { ?>
                                    <input name="edit-name" type="text" class="form-control" name="cat_title">
                                <?php } 
                                
                                
                                if (isset($_POST["edit-submit"])) {
                                    $name = $_POST["edit-name"];


                                    $query = "UPDATE categories SET cat_title= ? WHERE cat_id= ?";

                                    $stmt = mysqli_prepare($connection,$query);

                                    mysqli_stmt_bind_param($stmt,'si',$name,$edit);

                                    mysqli_stmt_execute($stmt);
                                    
                                    $result = mysqli_stmt_get_result($stmt);

                                    mysqli_stmt_close($stmt);
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit-submit" value="Update Category">
                            </div>
                        </form>