<?php include("./includes/admin_header.php");
?>
<div id="wrapper">


    <!-- Navigation -->
    <?php include("./includes/admin_navigation.php") ?>


    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        COMMENTS
                        <!-- <small>Author</small> -->
                    </h1>

                  <?php 
                        if(isset($_GET["source"])){
                            $source=$_GET["source"];
                        }
                        else{
                            $source ="";
                        }
                        switch($source){
                            // case "add comment": include("./includes/add_user.php");break;
                            case "100":echo "NICE 100";break;
                            case "200":echo "NICE 200";break;
                            case "edit user": include("./includes/edit_user.php");break;
                            default: include("./includes/view_all_users.php");break;
                        }
                  ?>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include("./includes/admin_footer.php") ?>