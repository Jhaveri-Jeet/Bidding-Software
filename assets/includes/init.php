<?php

define("BASE_DIR", $_SERVER['DOCUMENT_ROOT'] . "/Bidding");
define("BASE_URL", "/Bidding");

date_default_timezone_set('Asia/Kolkata');

$connection = new PDO("mysql:host=localhost;port=3306;dbname=BidingSoftwareDb", "root", "");

function pathOf($path)
{
    return BASE_DIR . "/" . $path;
}

function urlOf($path)
{
    return BASE_URL . '/' . $path;
}

session_start();
