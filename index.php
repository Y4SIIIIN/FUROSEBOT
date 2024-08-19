<?php
require 'config.php';
$token = '...'; //Insert your bot token here
//Telegram IP range
$telegram = false;
$telegram_ip_ranges = [
    ['lower' => '149.154.160.0', 'upper' => '149.154.175.255'],
    ['lower' => '91.108.4.0', 'upper' => '91.108.7.255']
];
$ip_dec = (float) sprintf("%u", ip2long(getIP()));
foreach($telegram_ip_ranges as $telegram_ip_range) {
    if(!$telegram) {
        $lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
        $upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
        if($ip_dec >= $lower_dec and $ip_dec <= $upper_dec) {
            $telegram = true;
        }
    }
}
if(!$telegram) {
    echo json_encode(array('status' => false), 128).PHP_EOL;
    die;
}

//Using PHP Object
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
// Extract Chat ID, message ID
$chat_id = $message->chat->id;
$message_id = $message->message_id;

$response = "GitHub:\nhttps://github.com/Y4SIIIIN";
/*
$update = json_decode(file_get_contents("php://input"), TRUE);
$message = $update['message']['text'];
$chat_id = $update['message']['chat']['id'];
$response = "GitHub:\nhttps://github.com/Y4SIIIIN/FUROSEBOT";
*/

sendMessage($chat_id, $response);
?>
