


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="sweetalert2.all.min.js"></script>
    <style>
        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .registration-container {
            background-color: rgba(255, 255, 255, 0.5); ;
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 8px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        .form-group input[type="submit"] {
            background-color: purple;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: crimson;
        }
        .form-links {
            margin-top: 10px;
        }
        .form-links a {
            margin-right: 10px;
            text-decoration: none;
            color: ;
        }
    </style>
</head>
<body>
<div class="registration-container">
    <h2><b>LOGIN</h2></b>
    <?php
    $email = $password = "";
    $emailErr = $passwordErr = "";

    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(empty($_POST["email"])){
            $emailErr = "Email is Required";
        } else {
            $email = $_POST["email"];
        }

        if(empty($_POST["password"])){
            $passwordErr = "Password is Required";
        } else {
            $password = $_POST["password"];
        }

        if($email && $password){
            include("connect.php");
            $check_email = mysqli_query($connect, "SELECT * FROM login_tbl WHERE email = '$email'");
            $check_email_row = mysqli_num_rows($check_email);
            if($check_email_row > 0){
                while($row = mysqli_fetch_assoc($check_email)){
                    $db_password = $row["password"];
                    $db_account_type = $row["account_type"];
                    if($db_password === $password){
                        if($db_account_type == "1"){
                            // Admin login
                            echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Login Successful!',
                                        text: 'Redirecting to Admin Dashboard...'
                                    }).then((result) => {
                                        window.location.href = 'admin/index.php';
                                    });
                                  </script>";
                        } else {
                            // User login
                            echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Login Successful!',
                                        text: 'Redirecting to User Dashboard...'
                                    }).then((result) => {
                                        window.location.href = 'user/dashboard.php';
                                    });
                                  </script>";
                        }
                    } else {
                        $passwordErr = "Password is incorrect";
                    }
                }
            } else {
                $emailErr = "Email is not Registered";
            }
        }
    }
?>
    <form method="POST" action="<?php htmlspecialchars("PHP_SELF");?>">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>
            <span class="error" style='color: red;'><?php echo $emailErr; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $password; ?>"><br>
            <span class="error" style='color: red;'><?php echo $passwordErr; ?></span>
        </div> 
        <div class="form-group">
            <input type="submit" value="Login " class="btn btn-primary">
        </div>
    </form>
    <div class="form-links">
        <a href="register.php" class="btn btn-link">No account yet? Register</a>
    </div>
</div>
<script src="bootstrap.bundle.min.js"></script>
</body>
</html>