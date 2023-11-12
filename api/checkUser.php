<?php
include "../assets/includes/init.php";

$userId = $_POST['userId'];
$password = $_POST['password'];

$select = "SELECT Users.Id, Users.Username, Users.RoleId, Roles.RoleName FROM Users INNER JOIN Roles ON Users.RoleId = Roles.Id WHERE Users.Id = '$userId' AND Users.Password = '$password'";
$result = $connection->query($select);
$data = $result->fetch(PDO::FETCH_ASSOC);

if ($data > 0) {
    echo "success";
    $_SESSION['status'] = 'loggedIn';
    $_SESSION['userId'] = $data["Id"];
    $_SESSION['username'] = $data["Username"];
    $_SESSION['roleId'] = $data["RoleId"];
    $_SESSION['roleName'] = $data["RoleName"];
} else
    echo "error";
$connection = null;
