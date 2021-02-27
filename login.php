<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title> Lock N' Go | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="styles/logstyle.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    </head>

    <body style="background-color: #031D44">
        <form class="box" action="../php-action/login-act.php" method="post">
            <a class="navbar-brand text-white" href="index.php">
                <h1>Lock N' Go</h1>
            </a>
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="pin" placeholder="Combination Pin">
            <input type="submit" name="submit" value="Open Locker">
            <p class="message">Don't Have a Locker Yet? <a href="signup.php">Create an Account</a>
            <p>
        </form>
    </body>

</html>
