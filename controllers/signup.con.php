<?php
//  <!--Created by Nathaniel Kumar @ GCU 2021 -->
//takes the user's info to create a user to the database
if (isset($_POST['register_visitor'])) {
    require "DBConn.con.php";

    $visitorName = $_POST["visitor"];
    $mail = $_POST["mail"];
    $phone = $_POST["phone"];
    $password = $_POST["passkey"];

    if (empty($visitorName) || empty($mail) || empty($password)) {
        header("Location: ../views/signup.php?err=null");
        exit();
    } else if (strlen($password) <= 6 && strlen($password) >= 12) {
        header("Location: ../views/signup.php?err=length");
        exit();
    } else {
        $sql = "SELECT * FROM Visitors WHERE `Mail`=?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../views/signup.php?err=sql");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result > 0) {
                header("Location: ../views/signup.php?err=registered");
                exit();
            } else {
                if (empty($phone)) {
                    $phone = null;
                }
                $sql2 = "INSERT INTO `Visitors`(`Name`, `Mail`, `Phone`, `Lock_key`) VALUES (?,?,?,?)";
                $stmt2 = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                    header("Location: ../views/signup.php?err=sql");
                    exit();
                } else {
                    $hashPass = password_hash($password, PASSWORD_BCRYPT);

                    mysqli_stmt_bind_param($stmt2, "ssss", $visitorName, $mail, $phone, $hashPass);
                    mysqli_stmt_execute($stmt2);
                    header("Location: ../views/login.php?success=login");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);
    mysqli_close($connection);
} else {
    header("Location: ../views/signup.php");
    exit();
}
