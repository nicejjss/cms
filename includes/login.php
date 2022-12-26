<?php 
  include("./db.php");
?>
<?php session_start()?>

<?php 
     if(isset($_POST["submit"])){
      $name = mysqli_real_escape_string($connection,$_POST["name"]);
      $password = mysqli_real_escape_string($connection,$_POST["password"]);

     $query = "Select * from user where name = '$name' and password = '$password'";

     $result = mysqli_query($connection,$query);
     $row = mysqli_fetch_assoc($result);
         if($row){
            $_SESSION["role"] =$row["role"];
            $_SESSION["name"] =$name;
            header("Location: "."../admin/index.php");
         }
         else{
          echo "<script>alert('Sai ten hoac mat khau')</script>";
          header("Location: "."../index.php");
         }

     
     }


?>