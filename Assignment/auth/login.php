<?php 
session_start();
if(isset($_POST['user'])){
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    if($pass == "123"){
        $_SESSION['userlogin'] = $user;
        header("location:../dashboard.php ");
    }else{
        echo "<script>alert('Password is incoreect!')</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../stylesheets/style.css">
    <link rel="stylesheet" href="../stylesheets/tailwind.css">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head></a>

<body id="login-index">
    <div class="w-full">
        <div id="notification" data-notice="{&quot;info&quot;:[{&quot;message&quot;:&quot;Logout Success&quot;}]}">
        </div>
        <section class="mt-10">
            <div class="flex justify-center items-center">
                <div class="w-48 h-48 flex justify-center items-center">
                    <img class="w-full object-cover" src="../logo/logo.png" alt="logo">
                </div>
            </div>
        </section>
        <div class="w-9/12 mx-auto mt-10 rounded border shadow-lg lg:w-4/12 p-8 bg-white">
            <h1 class="flex justify-center text-2xl text-bold">Login to System</h1>

            <form action="" method="POST">
                <div class="mt-4">
                    <input class="hidden" name="_method" value="POST">
                    <input type="hidden" name="_csrf" value="">
                    <label>USERNAME</label>
                    <input
                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                        type="text" name="user" placeholder="Your Username" required>
                </div>
                <div class="mt-4">
                    <label>Password</label>
                    <div class="relative">
                        <input id="passwordField"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            type="password" name="pass" placeholder="Your Password" required>
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                            onclick="togglePasswordVisibility()"> 
                            <!-- show icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 12s-4-6.5-10-6.5S2 12 2 12s4 6.5 10 6.5 10-6.5 10-6.5z" />
                                <path d="M9.9 14.6c-.9.6-2 .9-3.1.4" />
                                <path d="M15.1 14.6c.9.6 2 .9 3.1.4" />
                                <path stroke-linecap="round" d="M12 17.3V10" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg w-full hover:bg-blue-900 bg-dark"
                        type="submit">Login</button>
                </div>
                <div class="mt-4 flex justify-center items-center">
                    <a class="text-sm text-blue-600 ml-3 hover:underline" href="forgot_password.php">Forgot password ?

                    </a>
                </div>
            </form>
            <script>
            function togglePasswordVisibility() {
                const passwordField = document.getElementById('passwordField');
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                } else {
                    passwordField.type = 'password';
                }
            }
            </script>
            
                <!-- test commit push -->
        </div>
    </div>
</body>

</html>