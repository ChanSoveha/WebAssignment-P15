<?php
    include('../connection/connection.php');
        
    $pro = $conn->prepare("SELECT * FROM products");
    if ($pro->execute()) {
        $products = $pro->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($products);
    }
?>