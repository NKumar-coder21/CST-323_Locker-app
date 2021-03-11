<?php
session_start();
if (isset($_SESSION["sessionID"])) {
    if ($_SESSION["sessionID"] == 1) {
        require "../controllers/DBConn.con.php";
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lock & Go | Locker Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-md-center">
                    <a class="navbar-brand" href="#">Lock & Go | Admin Dashboard</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Welcome,
                                <?php echo $_SESSION["sessionName"] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../controllers/logout.con.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section role="main" class="container-fluid">
            <div class="container-fluid">
                <!--Main content-->
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-header" style="background-color:#00354E; color: white">
                            <h3>All Lockers</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-md">
                                <table id="allLockers" class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Label</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Vacant</th>
                                            <th scope="col">User</th>
                                            <th scope="col">User's Email</th>
                                            <th scope="col">User's Phone #</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $join = "SELECT Lockers.Label, LockSize.Size, Availability.Status, Visitors.Name, Visitors.Mail, Visitors.Phone
                                    FROM Lockers
                                    INNER JOIN LockSize ON Lockers.Size = LockSize.ID
                                    INNER JOIN Availability ON Lockers.Vacant = Availability.ID
                                    INNER JOIN Visitors ON Lockers.User = Visitors.ID";
                                            $result = mysqli_query($connection, $join);
                                            if ($result) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($items = mysqli_fetch_assoc($result)) {
                                            ?>
                                        <tr>
                                            <th><?php echo $items['Label'] ?></th>
                                            <td><?php echo $items['Size'] ?></td>
                                            <td><?php echo $items['Status'] ?></td>
                                            <th><?php echo $items['Name'] ?></th>
                                            <td><?php echo $items['Mail'] ?></td>
                                            <td><?php echo $items['Phone'] ?></td>
                                            <?php if ($items['Status'] == "Available") {
                                                                echo '<td><a class="btn fs-5 btn-success" href="#" role="button">Edit</a></td>';
                                                                echo '<td><a class="btn fs-5 btn-danger" href="#" role="button">Delete</a></td>';
                                                            } else {
                                                                echo '<td colspan="2" ><a class="btn fs-5 btn-warning disabled" href="#"
                                                        role="button"><small>User Owns - Cannot Modify</small></a></td>';
                                                            }
                                                            ?>
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
                    </div>
                </div>
            </div>
        </section>
    </body>

</html>
<?php
    } else {
        header("Location: ../views/login.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
