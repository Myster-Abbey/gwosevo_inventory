<?php
$login=0;
$invalid=0;


// error_reporting(E_ALL);
// ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    // $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="Select * from `users` where 
    email='$email' limit 1";

    $result=mysqli_query($con,$sql);

    if($result){
        $num=mysqli_num_rows($result);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        if(count($data) > 0){
            // echo "Login successful";
            if (password_verify($password, $data[0]['password'])) {
            $login=1;
            session_start();
            $_SESSION['email']=$email;
            header('location:dashboard.php');
            # code...
            } else {
                $invalid=1;
            }
        }else{
            // echo "Invalid data";
            $invalid=1;
            // $sql = "INSERT INTO `users` (username, email, password) VALUES ('$username', '$email', '$password')";
            // $result=mysqli_query($con,$sql);
        
            // if($result){
            //     // echo "Signup successfully";
            //     $success=1;
            // }else{
            //     die(mysqli_error($con));
            // }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="image.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: column;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            padding: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 100px;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group input:focus {
            border-color: #f1c40f;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #f1c40f;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background: #d4ac0d;
        }

        .toggle-link {
            margin-top: 15px;
            text-align: center;
        }

        .toggle-link a {
            color: #f1c40f;
            text-decoration: none;
        }

        .toggle-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<?php
    if($login){
        echo '<div class="alert alert-success
        alert-dismissible fade show" role="alert">
        <strong>Successfully login</strong>
        <button type="button" class="close"
        data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        <button>
        </div>';
    }

    if($invalid){
        echo '<div class="alert alert-danger
        alert-dismissible fade show" role="alert">
        <strong>Sorry user does not exist</strong>
        <button type="button" class="close"
        data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        <button>
        </div>';
    }
?>
        <div class="container" id="login-form">
                <div class="logo">
                        <img src="image.png" alt="Logo">
                    </div>
                    <h2>Login</h2>
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="login-email">Email</label>
                            <input type="text" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="login-password">Password</label>
                            <input type="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn">Login</button>
                    </form>
                    <div class="toggle-link">
                        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
                    </div>
                </div>

        </div>

</body>
</html>