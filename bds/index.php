<?php
//=============================================================
// File.......: index.php
// Date.......: 2018-06-07
// Author.....: Benny Saxén
// Description: Bot Discovery Service
//=============================================================

//=============================================================
function register_bot($name,$url)
//=============================================================
{
  echo("ok you are now registered\n");
}

//=============================================================
function find_bot($search)
//=============================================================
{
  // Read and search the bot register
  $handle = fopen("bot_register.txt", "r");
  if ($handle) {
      while (($line = fgets($handle)) !== false) {
          // process the line read.
      }

      fclose($handle);
  } else {
      // error opening the file.
  }
}

//=============================================================
// GET and POST

$error = 1;
$answer = "Please rephrase your message";


$register = 0;
$bot_name = "void";
$bot_url = "void";

if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    $error = 0;
}

if(isset($_GET['message'])) {
    $msg = $_GET['message'];
    $error = 0;
}

if ($error == 1)
{
    $answer = 'I cannot process your message';
}

//echo $msg.'br>';


$intention_register = 0;
$intention_search = 0;

// What is the Intentions
if (strpos($msg, 'register') !== false) {
    $intention_register++;
}

if (strpos($msg, 'name is') !== false) {
    $pos = strpos($msg, 'name is');
    $pos = $pos + 8;
    //sscanf($msg[$pos], "%s", $bot_name);
    $temp = substr($msg,$pos);
    $temp = explode(" ",$temp);
    $bot_name = $temp[0];
    $intention_register++;
}
if (strpos($msg, 'url is') !== false) {
    $pos = strpos($msg, 'url is');
    $pos = $pos + 7;
    //sscanf($msg[$pos], "%s", $bot_name);
    $temp = substr($msg,$pos);
    $temp = explode(" ",$temp);
    $bot_url = $temp[0];
    $intention_register++;
}
if (strpos($msg, 'find') !== false) {
    $pos = strpos($msg, 'find');
    $find = $pos;
    echo("find = $pos");
    $intention_find++;
}
if (strpos($msg, 'looking for') !== false) {
    $pos = strpos($msg, 'looking for');
    $looking = $pos;
    echo("looking for = $pos");
    $intention_find++;
}


// Intentions

// my name is test_bot and I want to register.
// I can tell the outdoor temperature in Kil in celcius
$ok = 0;
if ($intention_register == 3)
{
  register_bot($bot_name,$bot_url);
  $ok++;
}

if ($intention_find > 0)
{
  $bot_url = find_bot($search);
  $ok++;
}




//log_to_file($msg,$answer);

// Answer
if($ok == 0)echo("$answer");

 ?>
