<?php 
$active = "dashboard";
$title = "Dashboard";
session_start();
if(!isset($_SESSION['userlogin'])){
    header("location: ./auth/login.php");
}else{
    $username = $_SESSION['userlogin']['user_name'];
}

include('structure/header.php');
?>
        
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
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
                <div class="container-fluid">
                    <!-- Placeholder: Your content goes here -->
                    <p>Welcome to the dashboard! This is where your content will appear.</p>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        

    <?php
        include('structure/footer.php');
    ?>