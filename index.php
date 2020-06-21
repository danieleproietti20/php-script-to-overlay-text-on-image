<?php
	// Stage 1: Replicate the first image style
	// Stage 2: Replicate the first image style, with the user able to select different background images.
	// Stage 3: Introduce a second image style, with different background images.

	header('Content-type: image/png');
	
	// Load And Create Image From Source
	$our_image = imagecreatefrompng('./test.png');
	
	// $red = imagecolorallocate($our_image, 255, 0, 0);
	// imagefilledrectangle($our_image, 4, 4, 50, 25, $red);
	
	
	// $color = imagecolorallocatealpha($our_image, 255, 255, 255, 127);
	// imagefill($our_image, 0, 0, $color);
	
	// // Allocate A Color For The Text Enter RGB Value
	
	$white = imagecolorallocatealpha($our_image, 0, 0, 0, 60);
	
	$height = imagesy($our_image);
	$width = imagesx($our_image);
	
	imagefilledrectangle($our_image, 0, $height/2, $width, $height, $white);
	
	
	
	$white_color = imagecolorallocate($our_image, 255, 255, 255);
	
	// Set Path to Font File
	$font_path = __DIR__.'/D-DINCondensed-Bold.otf';
	
	// Set Text to Be Printed On Image
	$text ="Welcome To Talkerscode";
	
	
	$fontSize=32;
	$angle=0;
	$left=125;
	$marginLeft = 20;
	$marginTop = 50;
	$top = $height/2 + $marginTop;
	$textSpacing = 50;
	
	
	
	$dimensions = imagettfbbox($fontSize, $angle, $font_path, $text);
	$textWidth = abs($dimensions[4] - $dimensions[0]);
	$left = imagesx($our_image) - $textWidth - $marginLeft;
	
	// Print Text On Image
	imagettftext($our_image, $fontSize, $angle, $left, $top, $white_color, $font_path, $text);
	// Send Image to Browser
	imagepng($our_image);
	
	// Clear Memory
	imagedestroy($our_image);
	

	// function generateRect() {
	//     $white = imagecolorallocatealpha($our_image, 255, 255, 255, 60);
	//     $height = imagesy($our_image);
	//     $width = imagesx($our_image);
	
	//     imagefilledrectangle($our_image, 0, $height/2, $width, $height, $white);
	// }
?>
Something is wrong with the XAMPP installation :-(
