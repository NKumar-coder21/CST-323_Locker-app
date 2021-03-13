<!--Created by Nathaniel Kumar @ GCU 2021 -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title> Lock N' Go | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../styles/logstyle.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    </head>

    <body style="background-color: #031D44">
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
    } else if (isset($_GET['success'])) {
        if (($_GET['success']) == "login") {
            echo '
                <div class="alert alert-success" role="alert">
                Your account has been successfuly created! Login to get started!
                </div>';
        }
    }
    ?>
        <form class="container box" action="../controllers/login.con.php" method="post">
            <a class="navbar-brand text-white" href="../index.php">
                <h1>Lock N' Go</h1>
            </a>
            <div class="row justify-content-center">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" name="mail" required>
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingInput" name="passkey" required>
                        <label for="floatingInput">Combination Pin</label>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
            <input class="btn btn-outline-success btn-lg mb-3" type="submit" name="login_submit" value="Open Locker">
            <p class="message">Don't Have a Locker Yet? <a href="signup.php">Create an Account</a>
            <p>
        </form>
        </div>
    </body>

</html>
