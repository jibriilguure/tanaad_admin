<?php include "base_url.php" ?>
<?php
session_start();


session_destroy();

header("Location:  $baseURL login.php");