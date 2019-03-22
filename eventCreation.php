<?php session_start();
include 'php_queries.php';
createEvent($_SESSION['username'], $_POST['expirationDate'], $_POST['publicity'], $_POST['name'],
            $_POST['location'], $_POST['description']);
echo '<script language="javascript"> window.location.href = "index.php";</script>';
?>
