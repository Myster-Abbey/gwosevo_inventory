<?php 
include 'dashboard.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from `ussd` where id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
        // echo "Deleted successful";
        // echo '<script>window.location.reload();</script>';
        // exit;
        // header("Location: " . $_SERVER['PHP_SELF']);
    }else{
        die(mysqli_error($con));
    

    }
}
