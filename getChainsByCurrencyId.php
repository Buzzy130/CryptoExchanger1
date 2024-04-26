<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
session_start();
require_once 'vendor/database.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['id'])) {
    $id = $data['id'];


    $pair = mysqli_query($connect, 'SELECT * FROM `currency`');
    $pair = mysqli_fetch_all($pair);

    $matchedRecords = array();
    foreach ($pair as $pairs) {
        if ($id == $pairs[0]) {
            $matchedRecords[] = $pairs[3];
        }
    }

    $network = mysqli_query($connect, 'SELECT * FROM `network`');
    $network = mysqli_fetch_all($network);
    $data_to_send = array();

    foreach ($network as $networks) {
        if ($networks[0] == $id) {
            foreach ($matchedRecords as $matchedRecord) {
                if ($networks[0] == $matchedRecord[0]) {
                    $data_to_send = array(
                        'id' => $networks[0],
                        'name' => $networks[1],
                        'bank_requisites' => $networks[4],
                        'requisites_type' => $networks[5]
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


