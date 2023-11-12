<?php
include "../assets/includes/init.php";

$id = $_POST["id"];
$requirement = $_POST["requirement"];
$description = $_POST["description"];
$price = $_POST["price"];

$update = "UPDATE `Requirement` SET `Requirement` = '$requirement', `Description` = '$description', `Price` = '$price' WHERE `Id` = $id";
$connection->query($update);
$connection = null;
