<?php
include "../assets/includes/init.php";

$sellerId = $_POST["sellerId"];
$requirementId = $_POST["requirementId"];
$description = $_POST["description"];
$price = $_POST["price"];

$insert = "INSERT INTO `Biding`(`RequirementId`, `SellerId`, `Price`, `Description`) VALUES ('$requirementId','$sellerId','$price','$description')";
$result = $connection->query($insert);
$connection = null;

if($result)
    echo "success";
else
    echo "error";
