<?php 
session_start();
if(!isset($_SESSION['email'])){
    header('location:login.php');
}
?>
<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $Campaign=$_POST['campaign'];
    $Shortcode=$_POST['shortcode'];
    $Dbname=$_POST['dbname'];

    $sql="insert into `ussd`(campaign,shortcode,dbname)
    values('$Campaign','$Shortcode','$Dbname')";
    $result=mysqli_query($con,$sql);
    if($result){
        // echo "Data inserted successfully";
        header('location:dashboard.php');
    }else{
        die(mysqli_error($con));
    }


}
?>

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
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            background-color: #f3f4f6;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
        }

        .sidebar .logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .sidebar .logo img {
            max-width: 80px;
            margin-bottom: 10px;
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .sidebar .logout {
            margin-top: auto;
            background-color: #e74c3c;
            color: #fff;
            text-decoration: none;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .sidebar .logout:hover {
            background-color: #c0392b;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: #ecf0f1;
        }

        .header {
            background-color: #3498db;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #fff;
            font-size: 24px;
        }

        .dashboard {
            display: none;
        }

        .dashboard.active {
            display: block;
        }

        .dashboard h2 {
            margin-bottom: 20px;
            color: #34495e;
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
        /* Basic styles for the popup */
                /* Style for the button */
        button#addButton {
            background-color: blue;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }


        button#addButton:hover {
            background-color: darkblue;
        }

        button#Delete-btn{
            background-color: red;
            color: white;
            border: none;
            padding: 5px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button#Delete-btn:hover {
            background-color: darkred;
        }

        button#Update-btn:hover {
            background-color: greenyellow;
        }

        /* Basic styles for the popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: #f9f9f9;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            padding: 20px;
            border-radius: 12px;
            z-index: 1000;
            font-family: Arial, sans-serif;
        }

        /* Overlay styling */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Close button */
        .popup .close-btn {
            background: red;
            color: white;
            border: none;
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            float: right;
            transition: background-color 0.3s ease;
        }

        .popup .close-btn:hover {
            background-color: darkred;
        }

        /* Form input styling */
        .popup .form-group {
            margin-bottom: 15px;
        }

        .popup .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        .popup .form-group input[type="text"],
        .popup .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .popup .form-group input[type="submit"] {
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .popup .form-group input[type="submit"]:hover {
            background-color: darkblue;
        }

        /* Basic styles for the update popup */
                /* Style for the update button */
                button#ussdaddButton {
            background-color: green;
            color: white;
            border: none;
            padding: 5px 20px;
            font-size: 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }


        button#ussdaddButton:hover {
            background-color: greenyellow;
        }

        button#ussdDelete-btn{
            background-color: red;
            color: white;
            border: none;
            padding: 5px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button#ussdDelete-btn:hover {
            background-color: darkred;
        }

        button#ussdUpdate-btn{
            background-color: green;
            color: white;
            border: none;
            padding: 5px 20px;
            font-size: 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button#ussdUpdate-btn:hover {
            background-color: greenyellow;
        }

        /* Basic styles for the popup */
        .ussdpopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: #f9f9f9;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            padding: 20px;
            border-radius: 12px;
            z-index: 1000;
            font-family: Arial, sans-serif;
        }

        /* Overlay styling */
        .ussdpopup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Close button */
        .ussdpopup .ussdclose-btn {
            background: red;
            color: white;
            border: none;
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            float: right;
            transition: background-color 0.3s ease;
        }

        .ussdpopup .ussdclose-btn:hover {
            background-color: darkred;
        }

        /* Form input styling */
        .ussdpopup .ussdform-group {
            margin-bottom: 15px;
        }

        .ussdpopup .ussdform-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        .ussdpopup .ussdform-group input[type="text"],
        .ussdpopup .ussdform-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .ussdpopup .ussdform-group input[type="submit"] {
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .ussdpopup .ussdform-group input[type="submit"]:hover {
            background-color: darkblue;
        }

        /* --- Update popup END--- */

        /* USSD table style */
                
        h2{
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
            padding: 30px 0;
        }

        /* Table Styles */

        .table-wrapper{
            margin: 10px 70px 70px;
            box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
        }

        .fl-table {
            border-radius: 5px;
            font-size: 12px;
            font-weight: normal;
            border: none;
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            white-space: nowrap;
            background-color: white;
        }

        .fl-table td, .fl-table th {
            text-align: center;
            padding: 8px;
        }

        .fl-table td {
            border-right: 1px solid #f8f8f8;
            font-size: 12px;
        }

        .fl-table thead th {
            color: #ffffff;
            background: #4FC3A1;
        }


        .fl-table thead th:nth-child(odd) {
            color: #ffffff;
            background: #324960;
        }

        .fl-table tr:nth-child(even) {
            background: #F8F8F8;
        }

        /* Responsive */

        @media (max-width: 767px) {
            .fl-table {
                display: block;
                width: 100%;
            }
            .table-wrapper:before{
                content: "Scroll horizontally >";
                display: block;
                text-align: right;
                font-size: 11px;
                color: white;
                padding: 0 0 10px;
            }
            .fl-table thead, .fl-table tbody, .fl-table thead th {
                display: block;
            }
            .fl-table thead th:last-child{
                border-bottom: none;
            }
            .fl-table thead {
                float: left;
            }
            .fl-table tbody {
                width: auto;
                position: relative;
                overflow-x: auto;
            }
            .fl-table td, .fl-table th {
                padding: 20px .625em .625em .625em;
                height: 60px;
                vertical-align: middle;
                box-sizing: border-box;
                overflow-x: hidden;
                overflow-y: auto;
                width: 120px;
                font-size: 13px;
                text-overflow: ellipsis;
            }
            .fl-table thead th {
                text-align: left;
                border-bottom: 1px solid #f7f7f9;
            }
            .fl-table tbody tr {
                display: table-cell;
            }
            .fl-table tbody tr:nth-child(odd) {
                background: none;
            }
            .fl-table tr:nth-child(even) {
                background: transparent;
            }
            .fl-table tr td:nth-child(odd) {
                background: #F8F8F8;
                border-right: 1px solid #E6E4E4;
            }
            .fl-table tr td:nth-child(even) {
                border-right: 1px solid #E6E4E4;
            }
            .fl-table tbody td {
                display: block;
                text-align: center;
            }
        }
        /* USSD table style end */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
            }

            .header {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="image.png" alt="Logo">
            <h1>Inventory</h1>
        </div>
        <nav>
            <a href="#" onclick="showDashboard('ussd-dashboard')">USSD</a>
            <a href="#" onclick="showDashboard('websites-dashboard')">Web Applications</a>
            <a href="#" onclick="showDashboard('mobile-apps-dashboard')">Mobile Apps</a>
        </nav>
        <a class="logout" href="logout.php">Logout</a>
    </div>

    <div class="content">
        <div class="header">
            <h1>Inventory Dashboard</h1>
        </div>

        <div class="dashboard active" id="ussd-dashboard">
       


    <button id="addButton">Add</button>

    <!-- Pop-Up Overlay -->
    <div class="popup-overlay" id="popupOverlay"></div>

            <!-------------------------- Add USSD Pop-Up Form ---------------------- ---- -->
    <div class="popup" id="popup">
        <button class="close-btn" id="closePopup">X</button>
        <form method="post">
            <div class="form-group">
                <label>Campaign</label>
                <input type="text" class="form-control" placeholder="Campaign" name="campaign">
            </div>
            <div class="form-group">
                <label>Shortcode</label>
                <input type="text" class="form-control" placeholder="Shortcode" name="shortcode">
            </div>
            <div class="form-group">
                <label>Database name</label>
                <input type="text" class="form-control" placeholder="DB Name" name="dbname">
            </div>
            <div class="form-group">
                <input type="submit" class="form-control" name="submit">
            </div>
        </form>
    </div>
            <!-------------------------- End Add-USSD Pop-Up Form ---------------------- ---- -->

            <!-- ----------------------------END Update ussd popup form ---------------------------------- -->
<!-- Pop-Up Overlay -->
<div class="ussdpopup-overlay" id="ussdpopupOverlay"></div>
<div class="ussdpopup" id="ussdpopup">
        <button class="ussdclose-btn" id="closePopup">X</button>
        <form method="post">
            <div class="ussdform-group">
                <label>Campaign</label>
                <input type="text" class="ussdform-control" placeholder="Campaign" name="campaign">
            </div>
            <div class="ussdform-group">
                <label>Shortcode</label>
                <input type="text" class="ussdform-control" placeholder="Shortcode" name="shortcode">
            </div>
            <div class="ussdform-group">
                <label>Database name</label>
                <input type="text" class="ussdform-control" placeholder="DB Name" name="dbname">
            </div>
            <div class="ussdform-group">
                <input type="submit" class="ussdform-control" name="submit">
            </div>
        </form>
    </div>
            <!-- ----------------------------END Update popup form ---------------------------------- -->
            
            <!-- ----------------------------  Update ussd popup Script ---------------------------------- -->
    <script>
        
        // Get elements
        const ussdaddButton = document.getElementById('ussdaddButton');
        const ussdpopup = document.getElementById('ussdpopup');
        const ussdpopupOverlay = document.getElementById('ussdpopupOverlay');
        const ussdclosePopup = document.getElementById('ussdclosePopup');

        // Open popup
        ussdaddButton.addEventListener('click', () => {
            ussdpopup.style.display = 'block';
            ussdpopupOverlay.style.display = 'block';
        });

        // Close popup
        ussdclosePopup.addEventListener('click', () => {
            ussdpopup.style.display = 'none';
            ussdpopupOverlay.style.display = 'none';
        });

        // Close popup when clicking on overlay
        ussdpopupOverlay.addEventListener('click', () => {
            ussdpopup.style.display = 'none';
            ussdpopupOverlay.style.display = 'none';
        });
    </script>
       <!-- ----------------------------  End Update ussd popup Script ---------------------------------- -->
   
            <!-- --------------------------------- script add USSD content ------------------------------- -->
    <script>
        // Get elements
        const addButton = document.getElementById('addButton');
        const popup = document.getElementById('popup');
        const popupOverlay = document.getElementById('popupOverlay');
        const closePopup = document.getElementById('closePopup');

        // Open popup
        addButton.addEventListener('click', () => {
            popup.style.display = 'block';
            popupOverlay.style.display = 'block';
        });

        // Close popup
        closePopup.addEventListener('click', () => {
            popup.style.display = 'none';
            popupOverlay.style.display = 'none';
        });

        // Close popup when clicking on overlay
        popupOverlay.addEventListener('click', () => {
            popup.style.display = 'none';
            popupOverlay.style.display = 'none';
        });
    </script>
        <!--------------------------------- end-script add USSD content ---------------------------- -->

         <!-------------------------------- USSD table display ------------------------------  -->

            <h2>Responsive Table</h2>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Campaign</th>
                    <th>Shortcode</th>
                    <th>Database name</th>
                    <th>Operations</th>
                    
                </tr>
                </thead>
                 <tbody>
                <?php 
                    $sql="Select * from `ussd`";
                    $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $id=$row['id'];
                            $campaign=$row['campaign'];
                            $shortcode=$row['shortcode'];
                            $dbname=$row['dbname'];

                            echo '<tr>
                            <td>'.$id.'</td>
                            <td>'.$campaign.'</td>
                            <td>'.$shortcode.'</td>
                            <td>'.$dbname.'</td>
                            <td>
                            
                                <button id="ussdaddButton"><a href="update.php?updateid='.$id.'">Update</a></button>
                                <button id="Delete-btn"><a href="delete.php?deleteid='.$id.'">Delete</a></button>

                            </td>
                            </tr>';

                        }
                        
                    }
                ?>
            

                <tbody> 
            </table>
        </div>
                <!-- --------------------------------------------- USSD UPDATE SCRIPT ----------------------------------- -->
                    

    <!-- --------------------------------End of USSD dashboard----------------------------------------------- -->
       

        <div class="dashboard" id="websites-dashboard">
            <h2>Web Applications Dashboard</h2>
            <ul>
                <li>Web App 1: Online</li>
                <li>Web App 2: Offline</li>
                <li>Web App 3: Maintenance</li>
            </ul>
        </div>

        <div class="dashboard" id="mobile-apps-dashboard">
            <h2>Mobile Apps Dashboard</h2>
            <ul>
                <li>Mobile App 1: Available</li>
                <li>Mobile App 2: Maintenance</li>
                <li>Mobile App 3: Under Development</li>
            </ul>
        </div>
    </div>

    <script>
        function showDashboard(id) {
            const dashboards = document.querySelectorAll('.dashboard');
            dashboards.forEach(dashboard => dashboard.classList.remove('active'));

            document.getElementById(id).classList.add('active');
        }
    </script>
</body>
</html>
