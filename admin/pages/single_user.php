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
                    <h1 class="mt-4">Single User</h1>
                    <div class="container">
                        <div class="row justify-content-center ">

                            <div class="col-xl-3 col-md-6">
                                <label for="Name">Date From </label>
                                <input class="form-control" type="date" name="" id="">
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <label for="Name">Date From </label>
                                <input class="form-control" type="date" name="" id="">
                            </div>

                            <div class="col-xl-3 col-md-6">
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
                        </div>


                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php  include  "script.php" ?>
</body>

</html>