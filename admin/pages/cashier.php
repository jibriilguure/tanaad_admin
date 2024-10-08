<?php  include  "config.php" ?>
<!DOCTYPE html>
<html lang="en">

<?php  include  "header.php" ?>

<body class="sb-nav-fixed">
    <?php  include "./nav.php"  ?>
    <div id="layoutSidenav">
        <?php include "./sidbar.php" ?>
        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Cashier</h1>
                    <?php

// Create a connection
include "../db_connection.php";

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $username = $_POST['name'];
    $password = $_POST['phone'];
    $address  = $_POST['address'];
    $epos  = $_POST['epos'];

    // Create the registration query
    $query = "INSERT INTO cashier (name, phone, address, epos) VALUES ('$username', '$password', '$address', $epos)";

    // Execute the query
    if ($connection->query($query) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }

    


}


// Check if delete action is triggered
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['user_id'])) {
    // Get the id of the row to be deleted
    $deleteId = $_GET['user_id'];

    // Display a Bootstrap alert with a confirmation message
    echo '<div class="row justify-content-center ">
    <div class="col-lg-8">';
    echo "<div class='container-fluid px-4'>";
    echo '<div class="alert alert-warning" role="alert">';
    echo "<center>";
    echo '<h1> Ma Hubtaa In aad Delete-garysid? </h1>';
    echo "</br>";
    echo '<a href="delete.php?action=delete&user_id=' . $deleteId . '" class="btn btn-danger mx-2">Delete</a>';
    echo '<a href="cashier.php" class="btn btn-secondary">Cancel</a>';
    echo "</center>";
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
    // Stop execution to prevent further code execution
    exit;
}

?>


                    <div class="container">
                        <div class="row justify-content-start ">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-10 rounded-lg ">

                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">
                                            <h2>Register</h2>
                                        </h3>
                                    </div>
                                    <div class="card-body ">

                                        <form method="POST" action="">
                                            <div class="form-group mt-3">
                                                <label for="Name">Magaca </label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="Phone">Phone</label>
                                                <input type="text" class="form-control" name="phone" required>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="Phone">EPOS PLACE CODE</label>
                                                <input type="text" class="form-control" name="epos" required>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="Phone">Address</label>
                                                <input type="text" class="form-control" name="address" required>
                                            </div>
                                            <button type="submit" name="submit"
                                                class="btn btn-primary mt-5 p10">Register</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        DataTable Example
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                    <th>Epos Place Code</th>
                                                    <th>Created</th>
                                                    <th>Delete</th>
                                                    <!-- <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th> -->
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php

                                                    // Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch data from the "users" table
$query = "SELECT * FROM cashier";
$result = $connection->query($query);
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["epos"] . "</td>";
                echo "<td>" . $row["created"] . "</td>";
                
                echo '<td><a href="?action=delete&user_id=' . $row['user_id'] . '">Delete</a></td';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No results found.</td></tr>";
        }
        ?>
                                                <!-- <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                    <td>2011/04/25</td>
                                                    <td>$320,800</td>
                                                </tr> -->

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
    <?php  include  "script.php" ?>
</body>

</html>