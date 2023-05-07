<?php
    $host = "127.0.0.1";
    $db = "dsc2";
    $user = "root";
    $pass ="";

    try {
        $db = new PDO("mysql:host =$host;dbname=$db;charset=utf8",$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
        header('Location: error.php');
    }

    include_once("./includes/functions.inc.php");

    // if (!isset($_SESSION)) { session_start(); }
    if(!isset($_SESSION['active'])) {
        session_start();
    }
?>