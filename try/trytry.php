

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- HTML: Head Section -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <link rel="icon" type="image/png" href="image.png">
    <style>
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
        .popup {
            display: block;
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
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Close button */
        .popup .ussdclose-btn {
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

        .popup .ussdclose-btn:hover {
            background-color: darkred;
        }

        /* Form input styling */
        .popup .ussdform-group {
            margin-bottom: 15px;
        }

        .popup .ussdform-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        .popup .ussdform-group input[type="text"],
        .popup .ussdform-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .popup .ussdform-group input[type="submit"] {
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .popup .ussdform-group input[type="submit"]:hover {
            background-color: darkblue;
        }

        /* --- Update popup END--- */
    </style>
</head>
<body>
<!-- <button id="ussdaddButton">Update</button> -->
    <!-- ----------------------------END Update popup form ---------------------------------- -->

<!-- Pop-Up Overlay -->
<div class="popup-overlay" id="popupOverlay"></div>
<div class="popup" id="popup">
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

    <!-- ----------------------------END Update ussd popup form ---------------------------------- -->

        <!-- ----------------------------  Update ussd popup Script ---------------------------------- -->
    <script>
        
        // Get elements
        // const ussdaddButton = document.getElementById('ussdaddButton');
        const popup = document.getElementById('popup');
        const popupOverlay = document.getElementById('popupOverlay');
        const closePopup = document.getElementById('closePopup');

        // // Open popup
        // ussdaddButton.addEventListener('click', () => {
        //     popup.style.display = 'block';
        //     popupOverlay.style.display = 'block';
        // });

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
       <!-- ----------------------------  End Update ussd popup Script ---------------------------------- -->
</body>
</html>
