<?php
include "../assets/includes/init.php";

$select = "SELECT client.Name, client.Mobile, client.Photo, plan.PlanName, plan.PremiumPeriod, plan.PremiumAmount, plan.PlanPeriod, allotedplan.StartDate FROM allotedplan INNER JOIN client ON client.Id = allotedplan.ClientId INNER JOIN plan ON plan.Id = allotedplan.PlanId";
$result = $connection->query($select);
$data = $result->fetchAll(PDO::FETCH_ASSOC);
$connection = null;

header('Content-type: application/json');
echo json_encode($data);
