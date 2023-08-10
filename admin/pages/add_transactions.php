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
                    <h1 class="mt-4">Add Transactions</h1>
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

    $date = date('Y-m-d', strtotime($_POST['trans_date']));
  
    $cashier = $_POST['cashier'];
    $deposit = $_POST['deposit'];
    $withdraw = $_POST['withdraw'];

    // Create the registration query
    $query = "INSERT INTO money (user_id, deposit, withdraw, trans_date) VALUES ($cashier,$deposit, $withdraw, '$date')";

    // Execute the query
    if ($connection->query($query) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }

    


}

                    ?>
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-10 rounded-lg ">

                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">
                                            <h2>Add Transaction</h2>
                                        </h3>
                                    </div>
                                    <div class="card-body ">

                                        <form method="POST" action="">
                                            <div class="form-group mt-3">
                                                <label for="Name">Cashier </label>
                                                <select class="form-control" name="cashier" id="">
                                                    <?php
                                                                                        
                                                                                        // Check connection
                                                                                        include "../db_connection.php";
                                    // if ($connection->connect_error) {
                                    //     die("Connection failed: " . $connection->connect_error);
                                    // }

                                    // Fetch data from the "users" table
                                    $query = "SELECT * FROM `cashier`";
                                    $result = $connection->query($query);
                                            if ($result->num_rows > 0) {
                                                // Output data of each row
                                                while ($row = $result->fetch_assoc()) {
                                                    // Calculate the commission
                                    $userId = $row['user_id'];
                                    $name = $row['name'];
                                                    echo "<option value='$userId'>$name</option>";
                                                ;
                                                }
                                            } else {
                                                echo "<tr><td colspan='2'>No results found.</td></tr>";
                                            }
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="Deposit">Date</label>
                                                <input type="date" class="form-control" name="trans_date" required>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="Deposit">Deposit</label>
                                                <input type="number" class="form-control" name="deposit" required>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="Deposit">Withdraw</label>
                                                <input type="number" class="form-control" name="withdraw" required>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary mt-5 p10">Add
                                                Transaction</button>
                                        </form>
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