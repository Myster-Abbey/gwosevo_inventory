<?php
$success=0;
$user=0;


error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    
    $sql="Select * from `users` where 
    username='$username' ";
    $result=mysqli_query($con,$sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
            // echo "User already exist";
            $user=1;
        }else{
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO `users` (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
            $result=mysqli_query($con,$sql);
        
            if($result){
                // echo "Signup successfully";
                $success=1;
            }else{
                die(mysqli_error($con));
            }
        }
    }

    // // Debugging: Print POST data
    // print_r($_POST);

    // // Retrieve form data safely
    // $username = isset($_POST['username']) ? $_POST['username'] : '';
    // $email = isset($_POST['email']) ? $_POST['email'] : '';
    // $password = isset($_POST['password']) ? $_POST['password'] : '';

    // // Check if email already exists
    // $checkEmailQuery = "SELECT * FROM `users` WHERE email='$email'";
    // $checkResult = mysqli_query($con, $checkEmailQuery);

    // if (mysqli_num_rows($checkResult) > 0) {
    //     echo "Error: Email already registered.";
    // } else {
    //     // Insert new user
    //     $sql = "INSERT INTO `users` (username, email, password) VALUES ('$username', '$email', '$password')";
    //     $result = mysqli_query($con, $sql);

    //     if ($result) {
    //         echo "Data inserted successfully";
    //     } else {
    //         die(mysqli_error($con));
    //     }
    // }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
    if($user){
        echo '<div class="alert alert-danger
        alert-dismissible fade show" role="alert">
        <strong>User already exist</strong>
        <button type="button" class="close"
        data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        <button>
        </div>';
    }

    if($success){
        echo '<div class="alert alert-success
        alert-dismissible fade show" role="alert">
        <strong>Successfully signup</strong>
        <button type="button" class="close"
        data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        <button>
        </div>';
    }
?>

    <div class="container" id="signup-form">
        <div class="logo">
            <img src="image.png" alt="Logo">
        </div>
        <h2>Sign Up</h2>
        <form action="signup.php" method="post">
            <div class="form-group">
                <label for="signup-name">Username</label>
                <input type="text" name="username" placeholder="Enter your Username" required>
            </div>
            <div class="form-group">
                <label for="signup-email">Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="signup-password">Password</label>
                <input type="password" name="password" placeholder="Create a password" required>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <div class="toggle-link">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>