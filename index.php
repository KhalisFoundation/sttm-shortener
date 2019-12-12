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

function goDownloadBetaMac () {
	go('https://s3-us-west-2.amazonaws.com/sttm-releases/mac-x64/SikhiToTheMax+Beta-5.0.0-beta.0.dmg');
}

function goDownloadBetaWin () {
	go('https://s3-us-west-2.amazonaws.com/sttm-releases/win-x64/SikhiToTheMaxSetup-5.0.0-beta.5.exe');
}

function goFeedback () {
	go('https://form.jotform.com/80266126732151');
}

function goAngG ($n) {
	global $sttm;
	is_numeric($n)? go("$sttm/ang?ang=$n&source=G") : go($sttm);
}

function goAngD ($n) {
	global $sttm;
	is_numeric($n)? go("$sttm/ang?ang=$n&source=D") : go($sttm);
}

function goAngV ($n) {
	global $sttm;
	is_numeric($n)? go("$sttm/ang?ang=$n&source=V") : go($sttm);
}

function goAngGS ($n) {
	global $sttm;
	is_numeric($n)? go("$sttm/ang?ang=$n&source=S") : go($sttm);
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
	case 'g':
		goAngG($path[1]);
		break;
	case 'd':
		goAngD($path[1]);
		break;
	case 'b':
	case 'v':
		goAngV($path[1]);
		break;
	case 'gs':
		goAngGS($path[1]);
		break;
	case 'dl': case 'download':
		goDownload();
		break;
	case 'beta-mac':
		goDownloadBetaMac();
		break;
	case 'beta-win':
		goDownloadBetaWin();
		break;
	case 'feedback':
		goFeedback();
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
	case 'sunder-gutka':
		go("$sttm/sundar-gutka");
		break;
	case 'i':
		go("$sttm/index");
		break;
	default:
		go($sttm.$_SERVER['REQUEST_URI']);
		break;
}
