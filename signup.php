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
        <form class="registerbox" action="../php-action/signup-act.php" method="post">
            <a class="navbar-brand text-white" href="index.php">
                <h1>Lock N' Go</h1>
            </a>
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="email" placeholder="Email">
            <input type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Phone# 123-456-7890">
            <input type="submit" name="signup" value="Sign Up">
            <p class="message">Already Have a Locker? <a href="login.php">Open Your Locker</a>
            <p>
        </form>
    </body>

</html>
