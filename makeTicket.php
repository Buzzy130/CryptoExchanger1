Принимает: pair_id, value, price
Что делает: На основе полученных данных создаёт записть в таблице тикетов
Отправляет: id тикета
<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
session_start();
require_once 'vendor/database.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['pair_id']) && isset($data['value']) && isset($data['price']) && isset($data['user_requisites'])) {
    $pair_id = $data['pair_id'];
    $value = $data['value'];
    $price = $data['price'];
    $user_requisites = $data['user_requisites'];

    mysqli_query($connect, "INSERT INTO `tickets` (`id`, `user_ip`, `user_id`, `user_requisites`, `pair_id`, `value`, `price`, `ttl`, `repaid`, `open`, `created_at`) VALUES (NULL, NULL, NULL, '$user_requisites', '$pair_id', '$value', '$price', NULL, NULL, NULL, NULL)");
    $new_id = mysqli_insert_id($connect);
    $data_to_send = array();
    $data_to_send = array(
        'id' => $new_id
    );


    echo json_encode($data_to_send);


} else {
    echo json_encode(['error' => 'Missing pair or value or price in the request']);
}
?>