<?php
session_start();


if (!isset($_SESSION['userlogin'])) {
    echo json_encode("fail! You must log in first");
    exit();
} else {
    $seller = $_SESSION['userlogin']['id'];
    
    include('../connection/connection.php');
    
    $data = $_POST['list'];
    
    $id = [];
    $qty = [];
    $price = [];
    $customer = null; 
    $discount = null; 
    
    // Iterate through the data
    foreach ($data as $d) {
        $id[] = $d['id'];
        $qty[] = $d['qty'];
        $price[] = $d['price'];
        $customer = $d['customer']; 
        $discount = $d['discount'];
    }

    // Get the last invoice number
    $invo = $conn->prepare("SELECT MAX(id) AS invoice FROM sale");
    $invo->execute();
    $result = $invo->fetch(PDO::FETCH_ASSOC);
    $invoice = $result['invoice'] + 1;
    // Insert sale record
    $query = $conn->prepare("INSERT INTO sale(sale_by, customer, invoicenumber, discount) VALUES(:seller, :customer, :invoice, :discount)");
    $query->bindParam(':seller', $seller);
    $query->bindParam(':customer', $customer);
    $query->bindParam(':invoice', $invoice);
    $query->bindParam(':discount', $discount);
    
    if ($query->execute()) {
        $sale_id = $conn->lastInsertId();
        
        // Insert sale details
        $loop = count($id);
        for ($i = 0; $i < $loop; $i++) {
            $q = $conn->prepare("INSERT INTO sale_details(sale_id, pro_id, qty, price, `date`) VALUES(:sale_id, :pro_id, :qty, :price, NOW())");
            $q->bindParam(':sale_id', $sale_id);
            $q->bindParam(':pro_id', $id[$i]);
            $q->bindParam(':qty', $qty[$i]);
            $q->bindParam(':price', $price[$i]);
            $q->execute();
        }

        echo json_encode("success, executed $loop rows");
    } else {
        echo json_encode("Error executing the query");
    }
}
?>
