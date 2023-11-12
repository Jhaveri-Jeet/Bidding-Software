<?php
include "../assets/includes/init.php";

$password = $_POST['password'];
$select = "SELECT password FROM users WHERE password = '$password'";
$result = $connection->query($select);
$data = $result->fetch();
if ($data > 0)
    echo "success";
else
    echo "error";
$connection = null;
