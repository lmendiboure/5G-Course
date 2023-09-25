<?php
session_start();

if(isset($_SESSION['user_info']))
    unset($_SESSION['user_info']);

header('Location: index.php');

?>