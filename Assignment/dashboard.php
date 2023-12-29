<?php 
$active = "dashboard";
$title = "Dashboard";
session_start();
if(!isset($_SESSION['userlogin'])){
    header("location: ./auth/login.php");
    exit();
}else{
    $username = $_SESSION['userlogin']['user_name'];
    
}

include('structure/header.php');
    $staff = $conn->prepare("SELECT COUNT(*) AS staff FROM employee");
    if ($staff->execute()) {
        $employee = $staff->fetch(PDO::FETCH_ASSOC);
    }
    $s = $conn->prepare("SELECT COUNT(*) AS sale FROM sale");
    if ($s->execute()) {
        $sale = $s->fetch(PDO::FETCH_ASSOC);
    }
    $p = $conn->prepare("SELECT COUNT(*) AS purchase FROM purchase");
    if ($p->execute()) {
        $purchase = $p->fetch(PDO::FETCH_ASSOC);
    }

    

?>
        
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-3">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-sm-3">
                            <div class="border rounded-pill p-1 text-center">
                                <h5>Number of staff : <?php echo $employee['staff']; ?></h5>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="border rounded-pill p-1 text-center">
                                <h5>Total Sale : <?php echo $sale['sale']; ?></h5>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="border rounded-pill p-1 text-center">
                                <h5>Total Purchase : <?php echo $purchase['purchase']; ?></h5>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid mt-3">
                    <!-- Placeholder: Your content goes here -->
                    <h3>Sale Today:</h3>
                    <div class="mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice No</th>
                                    <th>Seller</th>
                                    <th>Customer</th>
                                    <th class="text-center">Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>s123</td>
                                    <td>li</td>
                                    <td>Normal</td>
                                    <td>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>kkk</td>
                                                    <td>77</td>
                                                    <td>77</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">Total</td>
                                                    <td colspan="2" class="text-center">80</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Purchase Today :</h3>
                    <div class="mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice No</th>
                                    <th>Seller</th>
                                    <th>Customer</th>
                                    <th class="text-center">Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>s123</td>
                                    <td>li</td>
                                    <td>Normal</td>
                                    <td>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>kkk</td>
                                                    <td>77</td>
                                                    <td>77</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">Total</td>
                                                    <td colspan="2" class="text-center">80</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        

    <?php
        include('structure/footer.php');
    ?>