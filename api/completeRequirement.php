<?php
include "../assets/includes/init.php";

$id = $_GET['id'];

$update = "UPDATE `requirement` SET `Status` = 'Fulfilled' WHERE `Id` = $id";
$connection->query($update);
$connection = null;

header("location: ../pages/biding.php");
