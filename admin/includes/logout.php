<?php
session_start();
  $_SESSION["name"]=null;
  $_SESSION["role"] =null;
  
   header("Location: "."/cms/index.php");
?>