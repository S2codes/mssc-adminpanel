<?php
session_start();
    if(!isset($_SESSION['admin'])){
        if (!$_SESSION['admin']) {
            header('location: login.php');
        }
    }
?>