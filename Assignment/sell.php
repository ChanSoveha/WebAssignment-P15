<?php 
$active = "sell";
$title = "Selling";
session_start();
if(!isset($_SESSION['userlogin'])){
    header("location: ./auth/login.php");
}else{
    $username = $_SESSION['userlogin']['user_name'];
}

include('structure/header.php');
?>

<h1>This is sell page</h1>

<?php
    include('structure/footer.php');
?>