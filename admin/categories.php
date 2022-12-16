<?php include("./includes/admin_header.php");
?>
<div id="wrapper">


    <!-- Navigation -->
    <?php include("./includes/admin_navigation.php") ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        CATEGORIES
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php

                        insert_category();
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cat_label">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="add-submit" value="Add Category">
                            </div>
                        </form>
                        <?php
                        if (isset($_GET["edit"]))
                            include("./includes/update_category.php")

                        ?>
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Function</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                 $query = "SELECT * FROM categories";
                                 $result = mysqli_query($connection, $query);

                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $catid = $row["cat_id"];
                                    $cattitle = $row["cat_title"]; 
                                    
                                ?>
                                    <tr>
                                        <td><?php echo $catid; ?></td>
                                        <td><?php echo $cattitle; ?></td>
                                        <td width="fit-content">
                                            <a href="./categories.php?delete=<?php echo $catid ?>"> <button name="delete-submit" class="btn btn-danger">DELETE</button></a>
                                            <a href="./categories.php?edit=<?php echo $catid ?>"> <button name="edit-btn" class="btn btn-info">EDIT</button></a>
                                        </td>

                                    </tr>
                                <?php
                                 }
                                 DeleteCategory();
                                // edit category




                                ?>
                                <!-- <tr>
                                    <td>1</td>
                                    <td>JAVA</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>C++</td>
                                </tr> -->
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include("./includes/admin_footer.php") ?>