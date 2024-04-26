<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
session_start();
require_once 'vendor/database.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['from_id']) && isset($data['to_id'])) {
    $from_id = $data['from_id'];
    $to_id = $data['to_id'];



    $pair = mysqli_query($connect, 'SELECT * FROM `pair`');
    $pair = mysqli_fetch_all($pair);
    $data_to_send = array();
    foreach ($pair as $pairs) {
        if ($pairs[0] == $from_id){
            if ($pairs[2] == $to_id){
                $data_to_send = array(
                    'id' => $pairs[0],
                    'from_id' =>$pairs[1],
                    'to_id' =>$pairs[2],
                    'value' =>$pairs[3]
                );
            }
        }
    }

    echo json_encode($data_to_send);


} else {
    echo json_encode(['error' => 'Missing ID or to_id in the request']);
}
?>