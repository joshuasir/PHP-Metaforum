<?php
    require 'databaseHandler.php';
    session_start();
    LogOut($_SESSION['name']);
    session_destroy();
    header('location:login.php');
?>