<?php
ob_start();
session_start();
require "DB_conn.php";
if(isset($_SESSION['username']) && isset($_SESSION['isadmin']) && $_SESSION['isadmin']){
    if(isset($_POST['user'])){
        $sql = "update users set isadmin = true where username ='".$_POST['user']."'";
    $query_run = mysqli_query($con,$sql);
    if($query_run){
        header("Location: ./admin.php");
    }
    }
}
else{
    header("Location: ./index.php");
}

?>