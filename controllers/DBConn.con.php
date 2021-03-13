<?php
//  <!--Created by Nathaniel Kumar @ GCU 2021 -->
//connect to the database
$servername = "127.0.0.1";
$DBuser = "azure";
$DBpass = "6#vWHD_$";
$DBname = "localdb";
$success = mysqli_connect(
    $servername,
    $DBuser,
    $DBpass,
    $DBname
);
if (!$success) {
    die("Connection to DB failed: " . mysqli_connect_error());
} else {
    $connection = $success;
}
