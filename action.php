<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "functions.php";
$url1 = $_POST["website1"];
$url2 = $_POST["website2"];
$comparisonTable = findAndCompare($url1, $url2);
downloadComparisonTable($comparisonTable);

var_dump($comparisonTable);
