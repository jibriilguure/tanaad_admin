<?php
// Create a connection
include "../db_connection.php";
if (isset($_POST['add_user'])) {



    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
   


    $insertQueary = "INSERT INTO user(username, password, name) VALUES 
                                    ('$username','$password_hash','$name')";

    $insertResulty = mysqli_query($connection, $insertQueary);
    if (!$insertResulty) {
        echo "<h1>EROOR</h1>";
        echo mysqli_error($connection);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">

        <input type="text" name="name" id="">
        <input type="text" name="username" id="">
        <input type="text" name="password" id="">
        <button type="submit" name="add_user">Reg</button>
        <button type="submit"></button>
    </form>
</body>

</html>