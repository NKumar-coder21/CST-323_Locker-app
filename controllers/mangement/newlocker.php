<?php
if (isset($_POST['add_locker'])) {
    require "DBConn.con.php";

    $label = $_POST['labelName'];
    $choice = $_POST['selection'];
    $vacant = 0;

    $sql = "INSERT INTO `Lockers`(`Label`, `Size`, `Vacant`) VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../views/login.php?err=sql");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $label, $choice, $vacant);
        mysqli_stmt_execute($stmt);
        header("Location: ../../admin-lock/dashboard.php?success=create");
        exit();
    }
} else {
    header("Location: ../../admin-lock/adminlogin.php");
    exit();
}
