<?php 
session_start();
if(!isset($_SESSION['userlogin'])){
    header("location: ./assignment/auth/login.php");
}else{
    header("location: ./assignment/dashboard.php");
}
?>