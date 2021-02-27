<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Lock N' Go | Sign-up</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="styles/logstyle.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    </head>

    <body style="background-color: #031D44">
        <?php
    if (isset($_GET['error'])) {
        $freshUsername = $_GET['uname'];
        $freshName = $_GET['name'];

        if (($_GET['error']) == "empty") {
            echo '
                <div class="alert alert-danger" role="alert">
                Textfields are empty!
                </div>';
        } else if (($_GET['error']) == "xname") {
            echo '
                <div class="alert alert-danger" role="alert">
                Username does not contain a-z, A-Z, 0-9
                </div>';
        } else if (($_GET['error']) == "pass") {
            echo '
                <div class="alert alert-danger" role="alert">
                Passwords do not match! Please try again.
                </div>';
        } else if (($_GET['error']) == "sqlerror") {
            echo '
                <div class="alert alert-warning" role="alert">
                Database cannot handle inputs at this moment! Try again in a few seconds.
                </div>';
        } else if (($_GET['error']) == "length") {
            echo '
                <div class="alert alert-warning" role="alert">
                The password must be 8 characters long!
                </div>';
        } else if (($_GET['error']) == "taken") {
            echo '
                <div class="alert alert-info" role="alert">
                Username is already taken. Please use another username.
                </div>';
        }
    }
    ?>
        <form class="registerbox" action="../php-action/signup-act.php" method="post">
            <a class="navbar-brand text-white" href="index.php">
                <h1>Lock N' Go</h1>
            </a>
            <input type="text" name="name" placeholder="Name" <?php echo 'value ="' . $freshName . '"' ?>>
            <input type="text" name="email" placeholder="Email" <?php echo 'value ="' . $freshUsername . '"' ?>>
            <input type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Phone# 123-456-7890">
            <input type="submit" name="signup" value="Sign Up">
            <p class="message">Already Have a Locker? <a href="login.php">Open Your Locker</a>
            <p>
        </form>
    </body>

</html>
