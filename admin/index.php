<?php include("./includes/admin_header.php") ?>
<?php

$userquery = "Select Count(*) as number from user";
$commentquery = "Select Count(*) as number from comment";
$postquery = "Select Count(*) as number from posts";
$categoryquery = "Select Count(*) as number from categories";

$postpublish ="SELECT COUNT(*) as number FROM `posts` WHERE post_status='publish'";
$postdraft="SELECT COUNT(*) as number FROM `posts` WHERE post_status='draft'";

$approvecomments="SELECT Count(*) as number FROM `comment` WHERE approve=1";
$disapprovecomments="SELECT Count(*) as number FROM `comment` WHERE approve=0";



//    Extract SQL comand
$userresult = mysqli_query($connection, $userquery);
$commentresult = mysqli_query($connection, $commentquery);
$categoryresult = mysqli_query($connection, $categoryquery);
$postresult = mysqli_query($connection, $postquery);

$publishresult= mysqli_query($connection,$postpublish);
$draftresult= mysqli_query($connection,$postdraft);

$approveresult = mysqli_query($connection,$approvecomments);
$disapproveresult = mysqli_query($connection,$disapprovecomments);



//Number SQL
$usernumber = mysqli_fetch_assoc($userresult)["number"];
$postnumber = mysqli_fetch_assoc($postresult)["number"];
$categorynumber = mysqli_fetch_assoc($categoryresult)["number"];
$commentnumber = mysqli_fetch_assoc($commentresult)["number"];

$publishnumber =mysqli_fetch_assoc($publishresult)["number"];
$draftnumber =mysqli_fetch_assoc($draftresult)["number"];

$approvenumber = mysqli_fetch_assoc($approveresult)["number"];
$disapprovenumber = mysqli_fetch_assoc($disapproveresult)["number"];


unset($userquery);



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
                        Welcome To Admin Pages
                        <small><?php echo $_SESSION["name"] ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <!-- <i class="fa fa-file"></i> Blank Page -->
                        </li>
                    </ol>
                </div>
            </div>

            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $postnumber ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $commentnumber ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $usernumber ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $categorynumber ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Count'],
          ['All Posts', <?php echo $postnumber?>],
          ['Publish Post',<?php echo $publishnumber?>],
          ['Draft Post',<?php echo $draftnumber?>],
          ['All Comments', <?php echo $commentnumber?>],
          ['Publish Comments',<?php echo $approvenumber?>],
          ['Pending Comments',<?php echo $disapprovenumber?>],
          ['Users', <?php echo $usernumber?>],
          ['Categories', <?php echo $categorynumber?>]
        ]);

        var options = {
          chart: {
            title: 'CMS Chart',
            subtitle: 'al the thing in CMS-PHP',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
     <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <?php include("./includes/admin_footer.php") ?>

   <!-- Toast -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Pusher -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    
    <script>

// Enable pusher logging - don't include this in production

var pusher = new Pusher('b740574d913375f27467', {
  cluster: 'ap1'
});

var channel = pusher.subscribe('notification');
channel.bind('new_user', function(notification) {
 var message = notification.message;

toastr.success(`${message} just log up`);

 console.log(message);
});
</script>