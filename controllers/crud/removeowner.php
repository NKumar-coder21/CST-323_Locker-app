<?php
require "../DBConn.con.php";
session_start();
if (isset($_SESSION["sessionID"])) {
    $id = $_GET['id'];
    $AvalableStatus = 0;
    $noUser = 0;

    $sqlquerry = "UPDATE Lockers SET Vacant= ?,User= ? WHERE Label = ?";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sqlquerry)) {
        header("Location: ../../views/login.php?err=sql");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "iis", $AvalableStatus, $noUser, $id);
        mysqli_stmt_execute($stmt);
        header("Location: ../../views/lockers.php");
        exit();
    }
} else {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}
