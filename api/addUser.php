<?php
include "../assets/includes/init.php";

$roleId = $_POST["roleId"];
$name = $_POST["name"];
$password = $_POST["password"];
$number = $_POST["number"];
$email = $_POST["email"];
$address = $_POST["address"];
$business = $_POST["business"];

$insert = "INSERT INTO `Users`(`RoleId`,`Username`, `Password`, `Email`, `Business`, `Address`, `Number`) VALUES ('$roleId','$name','$password','$email','$business', '$address', '$number')";
$connection->query($insert);
$connection = null;
