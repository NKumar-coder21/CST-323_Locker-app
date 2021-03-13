<?php
//  <!--Created by Nathaniel Kumar @ GCU 2021 -->
//logout the user
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
exit();
