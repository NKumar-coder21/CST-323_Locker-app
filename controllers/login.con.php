<?php
//   <!--Created by Nathaniel Kumar @ GCU 2021 -->
//login the user
if (isset($_POST['login_submit'])) {
    require "DBConn.con.php";

    $mail = $_POST['mail'];
    $passkey = $_POST['passkey'];

    if (empty($mail) || empty($passkey)) {
        header("Location: ../views/login.php?err=null");
        exit();
    } else {
        $sql = "SELECT * FROM Visitors WHERE `Mail`=?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../views/login.php?err=sql");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passCheck = password_verify($passkey, $row["Lock_key"]);
                if ($passCheck == false) {
                    header("Location: ../views/login.php?err=wrongpass");
                    exit();
                } else if ($passCheck == true) {
                    session_start();
                    $_SESSION["sessionID"] = $row["ID"];
                    $_SESSION["sessionName"] = $row["Name"];
                    header("Location: ../views/lockers.php");
                    exit();
                }
            } else {
                header("Location: ../views/login.php?err=nouser");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
} else {
    header("Location: ../views/login.php");
    exit();
}
