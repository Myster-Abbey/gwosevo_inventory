<?php

try {
    $HOSTNAME ='localhost';
$USERNAME ='root';
$PASSWORD ='';
$DATABASE ='gwosevo_inventory';


$con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,
$DATABASE);

if(!$con){
    die(mysqli_error($con));
}
} catch (\Throwable $th) {
    file_put_contents('errors.txt', $th->getMessage() . "\n LINE NUMBER: " . $th->getLine());
}