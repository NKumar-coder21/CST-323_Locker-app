<!--Created by Nathaniel Kumar @ GCU 2021 -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title> Lock N' Go | Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../styles/logstyle.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    </head>

    <body onload='setFocusToTextBox()' style="background-color: #031D44">
        <?php
    if (isset($_GET['err'])) {
        if (($_GET['err']) == "null") {
            echo '
                <div class="alert alert-danger" role="alert">
                Textfields are empty!
                </div>';
        } else if (($_GET['err']) == "sql") {
            echo '
                <div class="alert alert-warning" role="alert">
                Database is currently shut down. Please come back in a few moments.
                </div>';
        } else if (($_GET['err']) == "wrongpass") {
            echo '
                <div class="alert alert-danger" role="alert">
                Wrong password was entered!
                </div>';
        } else if (($_GET['err']) == "nouser") {
            echo '
                <div class="alert alert-danger" role="alert">
                No username exist! Create a new user? <a href="signup.php">Sign Up</a>
                </div>';
        }
    }
    ?>
        <form class="container box" action="../controllers/mangement/managelockers.php" method="post">
            <a class="navbar-brand text-white" href="../index.php">
                <h1>Lock N' Go</h1>
                <h6><i>Admin Locker Management</i></h6>
            </a>
            <div class="row justify-content-center">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingInput" type="password" name="PasswordPin">
                        <label for="floatingInput">PIN</label>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
            <input class="btn btn-outline-success btn-lg mb-3" type="submit" name="submit" value="Go">
        </form>
    </body>
    <script>
    function setFocusToTextBox() {
        document.getElementsByName("PasswordPin").focus();
    }
    </script>

</html>
