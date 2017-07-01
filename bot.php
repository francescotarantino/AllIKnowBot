<?php
require('class-http-request.php');

$api = "bot";
$api .="TOKEN"; //Insert here your Telegram Bot's token
global $api;

$content = file_get_contents('php://input');
$update = json_decode($content, true);

if ($update["message"]["chat"]["id"]) $chatID = $update["message"]["chat"]["id"];
if ($update["callback_query"]["message"]["chat"]["id"]) $chatID = $update["callback_query"]["message"]["chat"]["id"];
if ($update["inline_query"]["from"]["id"]) $chatID = $update["inline_query"]["from"]["id"];
$msg = $update["message"]["text"];

if($msg == "/start"){
  $rmf[] = array(array(
  'text' => "Try Inline KeyBoard",
  'callback_data' => "ContentOfCallback_Data"));
  $rm = array('inline_keyboard' => $rmf);
  $rm = json_encode($rm);
  $args = array(
  'chat_id' => $chatID,
  'text' => "Hi! *This bot shows everything that bots know about messages and users.*\n_Just write/forward a message!_",
  'parse_mode' => "Markdown",
  'reply_markup' => $rm);
  $r = new HttpRequest("post", "https://api.telegram.org/$api/sendMessage", $args);
} else {
  $args = array(
  'chat_id' => $chatID,
  'text' => print_r($update, true));
  $r = new HttpRequest("post", "https://api.telegram.org/$api/sendMessage", $args);
}
?>
