<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-warning">
    <?php
    include "./db_connection.php";  
  // Check if the form is submitted
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve form data
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $selectUserQueary = "SELECT * FROM user WHERE username= '$username' ";
    $checktUserQueary = mysqli_query($connection, $selectUserQueary);

    if (!$checktUserQueary) {
        die("Waa ka xumahay Mashaqayn" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($checktUserQueary)) {
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['password'];
        
        // $db_role = $row['role'];
        // $db_active = $row['active'];
    }
    if ($username === $db_username && $password == $db_password ) {
        session_start();
        $_SESSION['user_id'] = $db_id;
        $_SESSION['username'] = $db_username;
       
        header("Location: index.php");
    }
    // Validate the login credentials (you can replace this with your own validation logic)
   else {
      // Display an error message if the credentials are invalid
      echo "<p style='color: red;'>Invalid username or password. Please try again.</p>";
    }
  }
  ?>

    <form method="POST">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Login</h3>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="username" type="text"
                                                    placeholder="name13" />
                                                <label for="inputEmail">UserName</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="password"
                                                    type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword"
                                                    type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember
                                                    Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-4 mb-0">


                                                <button class="btn btn-primary" type="submit"
                                                    name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous">
        </script>
        <script src="js/scripts.js"></script>
</body>

</html>