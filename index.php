<?php
if (!isset($_COOKIE['nsj_userid']) && php_sapi_name() !== 'cli') {
    if (file_exists('index-static.html')) {
        $static = @file_get_contents('index-static.html'); // Suppress potential warnings/errors
        if ($static === false) {
            die("Error reading the file.");
        }
        
        if (strpos($static, "gradient_sheet") !== false) {
            die($static);
        }
    } else {
        die("File does not exist.");
    }
}

$page_info = array(
	'page'=> 'home',
	'page_nohome'=> 1,
);
require("system/config.php");

if($chat_install != 1){
	include('builder/encoded/installer.php');
	die();
}

// loading head tag element
include('control/head_load.php');

// loading page content
$data['user_roomid'] = getRoomId();
if($data['user_roomid'] > 0){
	include('control/chat.php');
}
else {
	include('control/lobby.php');
}

// close page body
include('control/body_end.php');
?>