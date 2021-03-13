<?php
//  <!--Created by Nathaniel Kumar @ GCU 2021 -->
// login the admin user
if (isset($_POST['submit'])) {
    require "../DBConn.con.php";

    $adminKeyPassPin = $_POST['PasswordPin'];


    if (empty($adminKeyPassPin)) {
        header("Location: ../../admin-lock/adminlogin.php?err=null");
        exit();
    } else {
        $sql = "SELECT * FROM Visitors WHERE `Name`=? AND `ID`=? AND `Mail`=?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../../admin-lock/adminlogin.php?err=sql");
            exit();
        } else {
            //lock&go admin
            $name = "Management Manager";
            $manageID = 1;
            $email = "management@lock.go.org";
            mysqli_stmt_bind_param($stmt, "sis", $name, $manageID, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passCheck = password_verify($adminKeyPassPin, $row["Lock_key"]);
                if ($passCheck == false) {
                    header("Location: ../../admin-lock/adminlogin.php?err=wrongpass");
                    exit();
                } else if ($passCheck == true) {
                    session_start();
                    $_SESSION["sessionID"] = $row["ID"];
                    $_SESSION["sessionName"] = $row["Name"];
                    header("Location: ../../admin-lock/dashboard.php");
                    exit();
                }
            } else {
                header("Location: ../../index.php");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
} else {
    header("Location: ../../index.php");
    exit();
}
