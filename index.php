<?php

$path = explode('/',$_GET['path']);
$sttm = 'https://www.sikhitothemax.org';

function go ($url) {
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: ' .  $url);
	exit;
}

function goDownload () {
	go('https://khalisfoundation.org/portfolio/sikhitothemax-everywhere/');
}

function goAng ($n) {
	global $sttm;
	is_numeric($n)? go("$sttm/ang?ang=$n&source=G") : go($sttm);
}

function goSearch ($q) {
	global $sttm;
	go("$sttm/search?q=$q");
}

function goShabad ($n, $h) {
	global $sttm;
	if (is_numeric($n)) {
		if (is_numeric($h)) {
			go("$sttm/shabad?id=$n&highlight=$h");
		} else {
			go("$sttm/shabad?id=$n");
		}
	} else {
		go($sttm);
	}
}

switch($path[0]) {
	case 'a':
		goAng($path[1]);
		break;
	case 'd': case 'download':
		goDownload();
		break;
	case 'h':
		go("$sttm/hukamnama");
		break;
	case 'q':
		goSearch($path[1]);
		break;
	case 'r':
		go("$sttm/random");
		break;
	case 's':
		goShabad($path[1], $path[2]);
		break;
	case 'sg':
		go("$sttm/sundar-gutka");
		break;
	default:
		go($sttm.$_SERVER['REQUEST_URI']);
		break;
}

