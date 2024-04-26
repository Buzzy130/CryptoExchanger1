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

foreach ($pair as $pairs) {
    if ($id == $pairs[0]) {
        $matchedRecords = $pairs[3];
    }
}

$Bank = mysqli_query($connect, 'SELECT * FROM `Bank`');
$Bank = mysqli_fetch_all($Bank);
$data_to_send = array();

foreach ($Bank as $Banks) {
    if ($Banks[0] == $matchedRecords) {
        $data_to_send[] = array(
            'id' => $Banks[0],
            'name' => $Banks[1],
            'bank_requisites' => $Banks[4],
            'requisites_type' => $Banks[5]
        );

    }

}
echo json_encode($data_to_send);



} else {
    echo json_encode(['error' => 'Missing ID in the request']);
}

?>