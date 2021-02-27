<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title> Lock N' Go | Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../styles/logstyle.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    </head>

    <body onload='setFocusToTextBox()' style="background-color: #031D44">
        <form class="adminbox" action="#" method="post">
            <a class="navbar-brand text-white" href="../index.php">
                <h1>Configure Lockers</h1>
            </a>
            <input id="pin" type="password" name="Password" placeholder="- - - -">
            <input type="submit" name="submit" value="Go">
        </form>
    </body>
    <script>
    function setFocusToTextBox() {
        document.getElementById("pin").focus();
    }
    </script>

</html>
