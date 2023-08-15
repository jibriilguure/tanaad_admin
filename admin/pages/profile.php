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
                    <center>
                        <h1 class="mt-4">Profile</h1>
                    </center>
                    <?php



// Retrieve user information from session
$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];
$name = $_SESSION['name'];

// Create a connection
include "../db_connection.php";
// Check the database connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Process the password change form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Retrieve the hashed password from the database
    $query = "SELECT password FROM user WHERE user_id = $userId";
    $result = $connection->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the current password
        if (password_verify($currentPassword, $hashedPassword)) {
            // Check if the new password and confirm password match
            if ($newPassword === $confirmPassword) {
                // Encrypt the new password
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the password in the database
                $updateQuery = "UPDATE user SET password = '$hashedNewPassword' WHERE user_id = $userId";
                $connection->query($updateQuery);

                // Redirect to the profile page (optional)
               
                echo '<script>window.location.href = "../logout.php";</script>';
                exit;
            } else {
                $error = "New password and confirm password do not match.";
            }
        } else {
            $error = "Current password is incorrect.";
        }
    } else {
        $error = "User not found.";
    }

    $result->free_result();
}
?>
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h2>User Profile</h2>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Name:</strong> <?php echo $name; ?></p>
                                        <p><strong>Username:</strong> <?php echo $username; ?></p>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h2>Change Password</h2>
                                    </div>
                                    <div class="card-body">
                                        <?php if (isset($error)) { ?>
                                        <div class="alert alert-danger"><?php echo $error; ?></div>
                                        <?php } ?>
                                        <form method="POST"
                                            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                            <div class="form-group">
                                                <label for="current_password">Current Password:</label>
                                                <input type="password" class="form-control" name="current_password"
                                                    id="current_password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password">New Password:</label>
                                                <input type="password" class="form-control" name="new_password"
                                                    id="new_password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password:</label>
                                                <input type="password" class="form-control" name="confirm_password"
                                                    id="confirm_password" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Change Password</button>
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