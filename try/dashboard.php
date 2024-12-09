<?php
session_start();
if(!isset($_SESSION['email'])){
    header('location:login.php');
}

?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome</h1>
     -->
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <link rel="icon" type="image/png" href="image.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f1c40f;
            padding: 10px 20px;
            color: #fff;
        }

        header .logo {
            display: flex;
            align-items: center;
        }

        header .logo img {
            max-width: 50px;
            margin-right: 10px;
        }

        header nav {
            display: flex;
            gap: 15px;
        }

        header nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .menu-toggle {
            display: none;
            background-color: #f1c40f;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }

        .content {
            display: flex;
            flex: 1;
            padding: 20px;
        }

        .dashboard {
            flex: 1;
            display: none;
        }

        .dashboard.active {
            display: block;
        }

        .dashboard h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .dashboard ul {
            list-style: none;
        }

        .dashboard ul li {
            background: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            header nav {
                display: none;
                flex-direction: column;
                background-color: #f1c40f;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
            }

            header nav.active {
                display: flex;
            }

            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="image.png" alt="Logo">
            <h1>Inventory Dashboard</h1>
        </div>
        <button class="menu-toggle" onclick="toggleMenu()">&#9776;</button>
        <nav>
            <a href="#" onclick="showDashboard('ussd-dashboard')">USSD</a>
            <a href="#" onclick="showDashboard('websites-dashboard')">Websites</a>
            <a href="logout.php">Logout</a>
        </nav>
        <!-- <div class="container"> -->
       
    <!-- </div> -->
    </header>

    <div class="content">
        <div class="dashboard active" id="ussd-dashboard">
            <h2>USSD Dashboard</h2>
            <ul>
                <li>USSD Service 1: Active</li>
                <li>USSD Service 2: Maintenance</li>
                <li>USSD Service 3: Inactive</li>
            </ul>
        </div>

        <div class="dashboard" id="websites-dashboard">
            <h2>Websites Dashboard</h2>
            <ul>
                <li>Website 1: Online</li>
                <li>Website 2: Offline</li>
                <li>Website 3: Maintenance</li>
            </ul>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const nav = document.querySelector('header nav');
            nav.classList.toggle('active');
        }

        function showDashboard(id) {
            const dashboards = document.querySelectorAll('.dashboard');
            dashboards.forEach(dashboard => dashboard.classList.remove('active'));

            document.getElementById(id).classList.add('active');
        }
    </script>
</body>
</html>

