<?php
session_start();
require_once 'vendor/database.php';

$id=15;
$pair = mysqli_query($connect, 'SELECT * FROM `currency`');
$pair = mysqli_fetch_all($pair);

$matchedRecords = array();
foreach ($pair as $pairs) {
    if ($id == $pairs[0]) {
        $matchedRecords[] = $pairs[3];
    }
}

echo $matchedRecords
?>