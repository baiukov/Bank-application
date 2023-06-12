<?php
session_start();
isset($_SESSION['user']) ? header('Location: ./pages/accounts.php') : header('Location: ./pages/main.php');
exit();
?>