<!--Created by Nathaniel Kumar @ GCU 2021 -->
<?php
session_start();
//check if the user is logged in, if not go back to login screen
if (isset($_SESSION["sessionID"])) {
    require "../controllers/DBConn.con.php"; ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Lock N' Go | Lockers</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>

    </head>


    <body class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-dark navbar-expand" style="background-color: #031D44;">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarText">
                    <a class="navbar-brand" href="lockers.php">
                        <h1>Lock N' Go Lockers</h1>
                    </a>
                    <ul class="nav navbar-nav">
                        <li class="nav-item" style="text-align: center;"><a class="nav-link"
                                href="../controllers/logout.con.php">Log Out</a></li>
                    </ul>
                </div>

            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="text-center bg-secondary text-white" style="padding-top: 75px; height: 100vh;">
                        <h2 class="display-6">Welcome, <?php echo $_SESSION["sessionName"] ?>!</h2>
                        <hr style="border: 5px solid white;">
                        <h5 class="display-6">Your Lockers</h5>
                        <table class="table fs-5 table-secondary table-striped table-borderless" id="yourLockers">
                            <thead>
                                <tr>
                                    <th scope="col">Locker #</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $_SESSION["sessionID"];
                                $select = "SELECT Lockers.Label FROM Lockers WHERE Lockers.User = $id";
                                $result = mysqli_query($connection, $select);
                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($items = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <th><?php echo $items['Label'] ?></th>
                                    <td><a class="btn btn-danger btn-sm fs-5"
                                            href="../controllers/crud/removeowner.php?id=<?php echo $items['Label'] ?>"
                                            role="button">Remove
                                            Ownership</a>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-7 mt-5 text-center">
                    <h1 class="display-4"> Lockers </h1>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <h3>Small Sized Lockers</h3>
                                </button>
                            </h3>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <table class="table fs-5 table-sm table-hover table-borderless" id="smallLockers">
                                        <thead>
                                            <tr>
                                                <th scope="col">Locker #</th>
                                                <th scope="col">Availability</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $join = "SELECT Lockers.Label, Availability.Status, Availability.ID
                                    FROM Lockers
                                    INNER JOIN  Availability
                                    ON Lockers.Vacant = Availability.ID
                                    WHERE Lockers.Size = 1";
                                            $result = mysqli_query($connection, $join);
                                            if ($result) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($items = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <th><?php echo $items['Label'] ?></th>
                                                <td><?php echo $items['Status'] ?></td>
                                                <?php if ($items['ID'] == 0) {
                                                            echo '<td><a class="btn fs-5 btn-success" href="../controllers/crud/addowner.php?id=' . $items["Label"] . '"
                                                role="button">Claim Locker</a></td>';
                                                        } else {
                                                            echo '<td><a class="btn fs-5 btn-warning disabled" href="#"
                                                        role="button">Unavaliable</a></td>';
                                                        }
                                                    }
                                                }
                                            }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    <h3>Medium Sized Lockers</h3>
                                </button>
                            </h3>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <table class="table fs-5 table-sm table-hover table-borderless" id="mediumLockers">
                                        <thead>
                                            <tr>
                                                <th scope="col">Locker #</th>
                                                <th scope="col">Availability</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $join = "SELECT Lockers.Label, Availability.Status, Availability.ID
                                    FROM Lockers
                                    INNER JOIN  Availability
                                    ON Lockers.Vacant = Availability.ID
                                    WHERE Lockers.Size = 2";
                                            $result = mysqli_query($connection, $join);
                                            if ($result) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($items = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <th><?php echo $items['Label'] ?></th>
                                                <td><?php echo $items['Status'] ?></td>
                                                <?php if ($items['ID'] == 0) {
                                                            echo '<td><a class="btn fs-5 btn-success" href="../controllers/crud/addowner.php?id=' . $items["Label"] . '"
                                                role="button">Claim Locker</a></td>';
                                                        } else {
                                                            echo '<td><a class="btn fs-5 btn-warning disabled" href="#" role="button">Unavaliable</a></td>';
                                                        }
                                                    }
                                                }
                                            }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    <h3>Large Sized Lockers</h3>
                                </button>
                            </h3>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <table class="table fs-5 table-sm table-hover table-borderless" id="largeLockers">
                                        <thead>
                                            <tr>
                                                <th scope="col">Locker #</th>
                                                <th scope="col">Availability</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $join = "SELECT Lockers.Label, Availability.Status, Availability.ID
                                    FROM Lockers
                                    INNER JOIN  Availability
                                    ON Lockers.Vacant = Availability.ID
                                    WHERE Lockers.Size = 3";
                                            $result = mysqli_query($connection, $join);
                                            if ($result) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($items = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <th><?php echo $items['Label'] ?></th>
                                                <td><?php echo $items['Status'] ?></td>
                                                <?php if ($items['ID'] == 0) {
                                                            echo '<td><a class="btn fs-5 btn-success" href="../controllers/crud/addowner.php?id=' . $items["Label"] . '"
                                                role="button">Claim Locker</a></td>';
                                                        } else {
                                                            echo '<td><a class="btn fs-5 btn-warning disabled" href="#" role="button">Unavaliable</a></td>';
                                                        }
                                                    }
                                                }
                                            }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="flush-headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFour" aria-expanded="false"
                                    aria-controls="flush-collapseFour">
                                    <h3>X-Large Sized Lockers</h3>
                                </button>
                            </h3>
                            <div id="flush-collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <table class="table fs-5 table-sm table-hover table-borderless" id="x-largeLockers">
                                        <thead>
                                            <tr>
                                                <th scope="col">Locker #</th>
                                                <th scope="col">Availability</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $join = "SELECT Lockers.Label, Availability.Status, Availability.ID
                                    FROM Lockers
                                    INNER JOIN  Availability
                                    ON Lockers.Vacant = Availability.ID
                                    WHERE Lockers.Size = 4";
                                            $result = mysqli_query($connection, $join);
                                            if ($result) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($items = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <th><?php echo $items['Label'] ?></th>
                                                <td><?php echo $items['Status'] ?></td>
                                                <?php if ($items['ID'] == 0) {
                                                            echo '<td><a class="btn fs-5 btn-success" href="../controllers/crud/addowner.php?id=' . $items["Label"] . '"
                                                role="button">Claim Locker</a></td>';
                                                        } else {
                                                            echo '<td><a class="btn fs-5 btn-warning disabled" href="#" role="button">Unavaliable</a></td>';
                                                        }
                                                    }
                                                }
                                            }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer class="container mt-auto">
        <div class="row">
            <div class="col-md-12">
                <footer class="footer-basic text-center">
                    <p class="copyright" style=" font-size: 12px; color: #aaa;">ULock Software &amp; Components LLC
                        © 2021<br>
                    </p>
                </footer>
            </div>
        </div>
    </footer>

</html>
<?php
} else {
    header("Location: ../views/login.php");
    exit();
}
?>
