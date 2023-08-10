<?php
session_start(); 


date_default_timezone_set('Africa/Nairobi');

if (!isset($_SESSION['username'])) {

    $_SESSION['msg'] = "sooo dhawoow";
    echo '
                            <script>
                            window.location.href = "./login.php";
                            </script>
                            ';
    exit();
}