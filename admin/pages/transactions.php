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
                    <h1 class="mt-4"> Transactions</h1>
                    <div class="container">
                        <div class="row justify-content-start ">
                            <div class="col-lg-10">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        All Transactions
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>Trans Id</th>
                                                    <th>Trans Date</th>
                                                    <th>Cashier Name</th>
                                                    <th>Deposit</th>
                                                    <th>Withdraw</th>
                                                    <th>Commission</th>
                                                </tr>

                                            </thead>

                                            <tbody>
                                                <?php
                                                    // Check connection
                                                    include "../db_connection.php";
// Fetch data from the "users" table
$query = "SELECT cashier.user_id, cashier.name, money.* FROM `money` JOIN cashier on money.user_id = cashier.user_id; ";
$result = $connection->query($query);
$totalCommission =0;
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Calculate the commission
        $commission = ($row["deposit"] * 0.05) + ($row["withdraw"] * 0.02);
        $totalCommission += $commission;
                echo "<tr>";
                echo "<td>" . $row["trans_id"] . "</td>";
                echo "<td>" . $row["trans_date"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["deposit"] . "</td>";
                echo "<td>" . $row["withdraw"] . "</td>";
                echo "<td>" . "$". $commission . "</td>";
                echo "</tr>";
               
            }
        } else {
            echo "<tr><td colspan='1'>No results found.</td></tr>";
        }
        echo "<tr>";
        echo "<td colspan='2'>Total</td>";
        echo "<td>" . "$".  $totalCommission .
         "</td>";
        
        echo "</tr>";
        ?>


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

<?php
// include "../db_connection.php";
// // Check the connection
// if ($connection->connect_error) {
//     die("Connection failed: " . $connection->connect_error);
// }

// // Prepare and execute the SQL query
// $sql = "SELECT * FROM money";
// $result = $connection->query($sql);

// // Check if there are any rows returned
// if ($result->num_rows > 0) {
//     // Output table headers
//     echo "<table>";
//     echo "<tr><th>ID</th><th>Cashier</th><th>Deposit</th><th>Withdraw</th><th>Commission</th></tr>";

//     // Output data of each row
//     while ($row = $result->fetch_assoc()) {
//         // Calculate the commission
//         $commission = ($row["deposit"] * 0.05) + ($row["withdraw"] * 0.02);

//         // Output table row
//         echo "<tr>";
//         echo "<td>" . $row["id"] . "</td>";
//         echo "<td>" . $row["cashier"] . "</td>";
//         echo "<td>" . $row["deposit"] . "</td>";
//         echo "<td>" . $row["withdraw"] . "</td>";
//         echo "<td>" . $commission . "</td>";
//         echo "</tr>";
//     }

//     echo "</table>";
// } else {
//     echo "No transactions found.";
// }

// // Close the database connection
// $connection->close();
?>