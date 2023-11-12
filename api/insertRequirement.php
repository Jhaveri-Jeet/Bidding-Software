<?php
include "../assets/includes/init.php";

$buyerId = $_POST["buyerId"];
$description = $_POST["description"];
$price = $_POST["price"];
$requirement = $_POST["requirement"];

$insert = "INSERT INTO `requirement`(`BuyerId`, `Price`, `Requirement`, `Description`) VALUES ('$buyerId','$price','$requirement','$description')";
$result = $connection->query($insert);
$connection = null;

if($result)
    echo "success";
else
    echo "error";
