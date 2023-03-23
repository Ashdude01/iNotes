<?php
session_start();
if(!isset($_SESSION['user'])){header("Location: /");}
$id = $_GET['id'];
include 'config.php';
$sql = "UPDATE notes SET isdone ='0' WHERE id = $id AND username = '{$_SESSION['user']}'";
$isdone = mysqli_query($conn, $sql);
header("Location: dashboard.php");
?>