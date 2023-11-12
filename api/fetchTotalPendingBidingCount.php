<?php
include "../assets/includes/init.php";

$select = "SELECT COUNT(Id) as pendingBiding FROM requirement WHERE Status = 'NotFulfilled'";
$result = $connection->query($select);
$data = $result->fetchAll(PDO::FETCH_ASSOC);
$connection = null;


header('Content-type: application/json');

echo json_encode($data);
