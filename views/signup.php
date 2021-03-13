<!--Created by Nathaniel Kumar @ GCU 2021 -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Lock N' Go | Sign-up</title>
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
                    Database cannot handle inputs at this moment! Try again in a few seconds.
                    </div>';
        } else if (($_GET['err']) == "length") {
            echo '
                    <div class="alert alert-danger" role="alert">
                    Combination key must be longer than 5 characters but less than 13.
                    </div>';
        } else if (($_GET['err']) == "registered") {
            echo '
                    <div class="alert alert-danger" role="alert">
                    Found user with that email. Login <a href="login.php">Here</a> Questions? Contact us.
                    </div>';
        }
    }
    ?>
        <form class="container box" action="../controllers/signup.con.php" method="post">
            <a class="navbar-brand text-white" href="../index.php">
                <h1>Lock N' Go</h1>
            </a>
            <div class="row justify-content-center">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="visitor" required>
                        <label for="floatingInput">Full Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" name="mail" required>
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" id="floatingInput"
                            name="phone">
                        <label for="floatingInput">(Optional) Phone # &nbsp; &nbsp; &nbsp;123-456-7890</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingInput" name="passkey" required>
                        <label for="floatingInput">Combination Pin (Letters and Numbers)</label>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
            <div class="form-text text-white mb-4">We'll never share your information with anyone else.</div>
            <input class="btn btn-outline-success btn-lg mb-3" type="submit" name="register_visitor" value="Sign Up">
            <p class="message">Already Have a Locker? <a href="login.php">Open Your Locker</a>
            <p>
        </form>
    </body>

</html>
