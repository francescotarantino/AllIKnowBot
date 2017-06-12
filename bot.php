<?php
require('class-http-request.php');

$api = "bot";
$api .="TOKEN"; //Insert here your Telegram Bot's token
global $api;

$content = file_get_contents('php://input');
$update = json_decode($content, true);

$chatID = $update["message"]["chat"]["id"];
$msg = $update["message"]["text"];

if($msg == "/start"){
  $args = array(
  'chat_id' => $chatID,
  'text' => "Hi! *This bot shows everything that bots know about messages and users.*\n_Just write/forward a message!_",
  'parse_mode' => "Markdown");
  new HttpRequest("post", "https://api.telegram.org/$api/sendMessage", $args);
} else {
  $args = array(
  'chat_id' => $chatID,
  'text' => print_r($update, true));
  new HttpRequest("post", "https://api.telegram.org/$api/sendMessage", $args);
}
?>
