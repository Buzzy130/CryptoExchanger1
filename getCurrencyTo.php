<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

session_start();
require_once 'vendor/database.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['id'])) {
    $id = $data['id'];


    $pair = mysqli_query($connect, 'SELECT * FROM `pair`');
    $pair = mysqli_fetch_all($pair);

    $matchedRecords = array();

    foreach ($pair as $pairs) {
        if ($id == $pairs[1]) {
            $matchedRecords[] = $pairs[2];
        }
    }



#поиск по таблице валют
    $table = mysqli_query($connect, 'SELECT * FROM `currency`');
    $table = mysqli_fetch_all($table);
    $data_to_send = array();
    foreach ($table as $tables) {
        foreach ($matchedRecords as $matchedRecord) {
            if ($tables[0] == $matchedRecord[0]) {
                if ($tables[5] == 1) {
                    $data_to_send[] = array(
                        'id' => $tables[0],
                        'name' => $tables[1],
                        'type' => $tables[2]
                    );
                }
            }
        }
    }

    echo json_encode($data_to_send);



} else {
    echo json_encode(['error' => 'Missing ID in the request']);
}



?>