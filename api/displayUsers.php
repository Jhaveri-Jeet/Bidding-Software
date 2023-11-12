<?php

include "../assets/includes/init.php";

$roleId = $_POST['roleId'];

$query = "SELECT Id,Username FROM Users WHERE RoleId = ?";
$params = [$roleId];
$statement = $connection->prepare($query);
$result = $statement->execute($params);
$fetch = $statement->fetchAll(PDO::FETCH_ASSOC);

if(!$fetch)
    http_response_code(400);

header("Content-Type: application/json");
echo json_encode($fetch);

?>