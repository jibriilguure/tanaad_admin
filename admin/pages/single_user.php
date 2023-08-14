<?php  include  "config.php" ?>
<!DOCTYPE html>
<html lang="en">
<!--  -->
<?php  include  "header.php" ?>

<body class="sb-nav-fixed">
    <?php  include "./nav.php"  ?>
    <div id="layoutSidenav">
        <?php include "./sidbar.php" ?>
        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Single User</h1>

                    <div class="container">
                        <form method="POST" action="">
                            <div class="row justify-content-center ">

                                <div class="col-xl-3 col-md-6">
                                    <label for="Name">Date From </label>
                                    <input class="form-control" type="date" name="datef" id="">
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <label for="Name">Date To </label>
                                    <input class="form-control" type="date" name="datet" id="">
                                </div>

                                <div class="col-xl-3 col-md-6">
                                    <label for="Name">Cashier </label>
                                    <select class="form-control" name="cashier_id" id="">
                                        <?php
                                                                                        include "../db_connection.php";
    
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
                                <div class="col-xl-3 col-md-6">
                                    <button type="submit" name="submit" class="btn btn-primary mt-4 ">
                                        Raadi</button>

                                    <!-- <a class="btn btn-primary mt-4"
                                        href="pdf_report.php?datef=<?php echo urlencode($_POST['datef']); ?>&datet=<?php echo urlencode($_POST['datet']); ?>&cashier_id=<?php echo urlencode($_POST['cashier_id']); ?>">
                                        PDF
                                    </a> -->

                                </div>
                            </div>
                        </form>
                        <div class="row justify-content-center mt-3">
                            <div class="col-xl-12 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        All Transactions
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <?php if (isset($_POST['submit']) && $result->num_rows > 0) { ?>
                                            <a class="btn btn-primary"
                                                href="pdf_report.php?datef=<?php echo urlencode($_POST['datef']); ?>&datet=<?php echo urlencode($_POST['datet']); ?>&cashier_id=<?php echo urlencode($_POST['cashier_id']); ?>">
                                                Generate PDF
                                            </a>
                                            <?php } elseif (isset($_POST['submit']) && $result->num_rows == 0) { ?>
                                            <p>No results found.</p>
                                            <?php } ?>
                                        </div>
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
                                    // Create a connection
include "../db_connection.php";



// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the form data

    $totalCommission=0;
  
    $dateFrom = date('Y-m-d', strtotime($_POST['datef']));
    $dateTo = date('Y-m-d', strtotime($_POST['datet']));
    $cashierId = $_POST['cashier_id'];

 
    

  // Fetch data from the "users" table
$query = "SELECT cashier.user_id, cashier.name, money.* FROM `money` JOIN cashier on money.user_id = cashier.user_id WHERE
trans_date BETWEEN '$dateFrom' AND '$dateTo' AND cashier.user_id = $cashierId;";
$result = $connection->query($query);

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
                echo "<td>" . "$". $row["deposit"] . "</td>";
                echo "<td>" . "$". $row["withdraw"] . "</td>";
                echo "<td>" . "$". $commission . "</td>";
                echo "</tr>";
               
            }
        } else {
            echo "<tr><td colspan='2'> <h1> No results found </h1>.</td></tr>";
        }
        echo "<tr>";
        echo "<td colspan='2'>Total</td>";
        echo "<td>" . "$".  $totalCommission .
         "</td>";
        
        echo "</tr>";

    }
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