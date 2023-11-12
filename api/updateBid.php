<?php
include "../assets/includes/init.php";

$bidId = $_POST["bidId"];
$description = $_POST["description"];
$price = $_POST["price"];

$update = "UPDATE `Biding` SET `Description` = '$description', `Price` = '$price' WHERE `Id` = $bidId";
$connection->query($update);
$connection = null;
