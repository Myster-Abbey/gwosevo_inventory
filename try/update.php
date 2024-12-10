<?php
include 'dashboard.php';


if(isset($_POST['Update'])){
    $campaign = $_POST['campaign'];
    $shortcode = $_POST['shortcode'];
    $dbname = $_POST['dbname'];
    $id = $_GET['updateid'];  // Get the ID of the record to update

    // Perform the update query
    $sql = "UPDATE `ussd` SET campaign='$campaign', shortcode='$shortcode', dbname='$dbname' WHERE id='$id'";
    $result = mysqli_query($con, $sql);

    if($result){
        header('Location: dashboard.php');  // Redirect after successful update
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}


