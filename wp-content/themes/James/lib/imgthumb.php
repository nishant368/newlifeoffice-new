<?php

$src = $_GET['src'];
$w = intval( $_GET['w'] );
$h = intval( $_GET['h'] );

//if( file_exists($src) == false ) exit;

list($width, $height, $type) = getimagesize( $src );

switch( $type ){
	case 2:
		$imgFrom = 'imagecreatefromjpeg';
		$imgFunc = 'imagejpeg';
		$imgType = 'image/jpeg';
		$type   = '.jpg';
	break;
	case 3:
		$imgFrom = 'imagecreatefrompng';
		$imgFunc = 'imagepng';
		$imgType = 'image/png';
		$type   = '.png';
	break;
	case 1:
		$imgFrom = 'imagecreatefromgif';
		$imgFunc = 'imagegif';
		$imgType = 'image/gif';
		$type   = '.gif';
	break;
	default:
		$imgFrom = 'imagecreatefromjpeg';
		$imgFunc = 'imagejpeg';
		$imgType = 'image/jpeg';
		$type   = '.jpg';
}

$name = md5($src).$type;

$thumb = imagecreatetruecolor($w, $h);
$source = $imgFrom($src);

imagecopyresized($thumb, $source, 0, 0, 0, 0, $w, $h, $width, $height);
imagedestroy($source);

header('Content-type: '.$imgType);
$imgFunc($thumb);
imagedestroy($thumb);
