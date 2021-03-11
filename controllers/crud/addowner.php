<?php
require "../DBConn.con.php";
session_start();
if (isset($_SESSION["sessionID"])) {
    $userID = $_SESSION["sessionID"];
    $id = $_GET['id'];
    $notAvalableStatus = 1;

    $sqlquerry = "UPDATE Lockers SET Vacant= ?,User= ? WHERE Label = ?";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sqlquerry)) {
        header("Location: ../../views/login.php?err=sql");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "iis", $notAvalableStatus, $userID, $id);
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
