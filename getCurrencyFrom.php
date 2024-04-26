<?php
header("Access-Control-Allow-Origin: *");
session_start();
require_once 'vendor/database.php';

$table = mysqli_query($connect, 'SELECT * FROM `currency`');
$table = mysqli_fetch_all($table);
$data_to_send = array();

foreach ($table as $tables) {
    if ($tables[5] == 1) {
        $data_to_send = array(
            $tables[0],
            $tables[1],
            $tables[2],
            $tables[3],
            $tables[4]
        );
    }
}

echo json_encode($data_to_send);
?>
