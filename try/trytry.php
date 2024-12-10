<?php 
session_start();
if(!isset($_SESSION['email'])){
    header('location:login.php');
}

include 'connect.php';
if(isset($_POST['submit'])){
    $Campaign=$_POST['campaign'];
    $Shortcode=$_POST['shortcode'];
    $Dbname=$_POST['dbname'];

    $sql="insert into `ussd`(campaign,shortcode,dbname)
    values('$Campaign','$Shortcode','$Dbname')";
    $result=mysqli_query($con,$sql);
    if($result){
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
         /* Button styles */
        button {
            background-color: green;
            color: white;
            border: none;
            padding: 5px 20px;
            font-size: 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: greenyellow;
        }

        /* Popup styles */
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
        }

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

        /* Table styles */
        h2 {
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
            padding: 30px 0;
        }

        .table-wrapper {
            margin: 10px 70px 70px;
            box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
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

        .fl-table tr:nth-child(even) {
            background: #F8F8F8;
        }

        /* Responsive styles */
        @media (max-width: 767px) {
            .fl-table {
                display: block;
                width: 100%;
            }

            .table-wrapper:before {
                content: "Scroll horizontally >";
                display: block;
                text-align: right;
                font-size: 11px;
                color: white;
                padding: 0 0 10px;
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
            <a href="#">USSD</a>
            <a href="#">Web Applications</a>
            <a href="#">Mobile Apps</a>
        </nav>
        <a class="logout" href="logout.php">Logout</a>
    </div>

    <div class="content">
        <div class="header">
            <h1>Inventory Dashboard</h1>
        </div>

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
                                    <button class="update-btn" onclick="openUpdatePopup('.$id.')">Update</button>
                                    <button class="delete-btn"><a href="delete.php?deleteid='.$id.'">Delete</a></button>
                                </td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody> 
            </table>
        </div>

        <!-- Popup overlay and form -->
        <div class="popup-overlay" id="popupOverlay"></div>
        <div class="popup" id="updatePopup">
            <button class="close-btn" id="closePopup">X</button>
            <form method="post">
                <div class="form-group">
                    <label>Campaign</label>
                    <input type="text" name="campaign" placeholder="Campaign">
                </div>
                <div class="form-group">
                    <label>Shortcode</label>
                    <input type="text" name="shortcode" placeholder="Shortcode">
                </div>
                <div class="form-group">
                    <label>Database Name</label>
                    <input type="text" name="dbname" placeholder="DB Name">
                </div>
                <div class="form-group">
                    <input type="submit" name="Update" value="Update">
                </div>
            </form>
        </div>
    </div>

    <script>
        // Get elements
        const popupOverlay = document.getElementById('popupOverlay');
        const updatePopup = document.getElementById('updatePopup');
        const closePopup = document.getElementById('closePopup');

        // Open the update popup
        function openUpdatePopup(id) {
            // Open update popup logic (you can pass the `id` to pre-fill the form if needed)
            updatePopup.style.display = 'block';
            popupOverlay.style.display = 'block';
        }

        // Close the popup
        closePopup.addEventListener('click', () => {
            updatePopup.style.display = 'none';
            popupOverlay.style.display = 'none';
        });

        // Close the popup when clicking on overlay
        popupOverlay.addEventListener('click', () => {
            updatePopup.style.display = 'none';
            popupOverlay.style.display = 'none';
        });
    </script>
</body>
</html>
