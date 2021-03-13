<?php
//  <!--Created by Nathaniel Kumar @ GCU 2021 -->
// create a new locker into the database
if (isset($_POST['add_locker'])) {
    require "../DBConn.con.php";

    $label = $_POST['labelName'];
    $choice = $_POST['selection'];
    $zero = 0;

    $sql = "INSERT INTO `Lockers`(`Label`, `Size`, `Vacant`,`User`) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../views/login.php?err=sql");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ssii", $label, $choice, $zero, $zero);
        mysqli_stmt_execute($stmt);
        header("Location: ../../admin-lock/dashboard.php?success=create");
        exit();
    }
} else {
    header("Location: ../../admin-lock/adminlogin.php");
    exit();
}
