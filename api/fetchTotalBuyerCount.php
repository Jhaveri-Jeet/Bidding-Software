<?php
include "../assets/includes/init.php";

$select = "SELECT COUNT(Users.Id) as totalBuyer FROM Users INNER JOIN Roles ON Users.RoleId = Roles.Id WHERE Roles.RoleName = 'Buyer'";
$result = $connection->query($select);
$data = $result->fetchAll(PDO::FETCH_ASSOC);
$connection = null;


header('Content-type: application/json');

echo json_encode($data);
