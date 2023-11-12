<?php
include "../assets/includes/init.php";

session_destroy();
header("Location: ../pages/login.php");
