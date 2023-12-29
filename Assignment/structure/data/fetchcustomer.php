<?php
    include('../connection/connection.php');

        $cus = $conn->prepare("SELECT * FROM customers");
    if ($cus->execute()) {
        $customer = $cus->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($customer);
    }
?>