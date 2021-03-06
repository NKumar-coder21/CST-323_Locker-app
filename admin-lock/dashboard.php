<!--Created by Nathaniel Kumar @ GCU 2021 -->
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

        <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js">
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
                    <a class="navbar-brand" href="dashboard.php">Lock & Go | Admin Dashboard</a>
                    <ul class="ms-auto navbar-nav">
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
        <?php if (isset($_GET['success'])) {
                if (($_GET['success']) == "delete") {
                    echo '
            <div class="alert alert-success" role="alert">
                Locker has been deleted!
            </div>';
                } else if (($_GET['success']) == "create") {
                    echo '
            <div class="alert alert-success" role="alert">
                Locker has been created!
            </div>';
                }
            }
            ?>
        <section role="main" class="container-fluid bg-secondary">
            <div class="container mb-5 text-center text-white">
                <form action="../controllers/mangement/newlocker.php" method="post">
                    <h2> Add a New Locker</h2>
                    <div class="form-group text-nowrap d-inline-block" style="margin: 0px 10px;"><label
                            class="d-inline">Locker Label:&nbsp;</label><input class="form-control d-inline"
                            name="labelName" type="text" style="width: 150px;" required></div>
                    <div class="form-group text-nowrap d-inline-block" style="margin: 0px 10px;"><label
                            class="d-inline-block">Size:&nbsp;</label><select class="form-control d-inline"
                            name="selection" style="width: 150px;margin-top: 1px;">
                            <option value="1">Small</option>
                            <option value="2">Medium</option>
                            <option value="3">Large</option>
                            <option value="4">X-Large</option>
                        </select></div>
                    <input class="btn btn-info btn-sm mb-3" type="submit" name="add_locker" value="Create Locker">
                </form>
            </div>
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
                                            <th scope="col">User' s Email</th>
                                            <th scope="col">User's Phone #</th>
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
                                                                echo '<td><a class="btn fs-6 btn-danger" href="../controllers/mangement/deleteLocker.php?locker=' . $items["Label"] . '" role="button">Delete</a></td>';
                                                            } else {
                                                                echo '<td><a class="btn fs-6 btn-secondary disabled" href="#"
                                                        role="button"><small>User Owns - Cannot Delete</small></a></td>';
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
            <br>
            <br>
        </section>
    </body>
    <script>
    $(document).ready(function() {
        $('#allLockers').DataTable({
            "pagingType": "numbers",
            columns: [null, null, null, null, null, null, {
                orderable: false
            }],
            order: [
                [1, 'asc']
            ],
            "columnDefs": [{
                    "targets": [2],
                    "searchable": false
                },
                {
                    "targets": [6],
                    "searchable": false
                }
            ],
            "language": {
                "lengthMenu": "Display _MENU_ records per page",
                "zeroRecords": "No records match your search term",
                "info": "Page _PAGE_ of _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)"
            }
        });
    });
    </script>

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
