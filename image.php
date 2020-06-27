<?php
// Stage 1: Replicate the first image style
// Stage 2: Replicate the first image style, with the user able to select different background images.
// Stage 3: Introduce a second image style, with different background images.

$textSpacing = 70;
$top_text = "LANUNCHING SOON!";
$bottom_text = "SUBSCRIBE TO UPDATES";

$our_image;
$height;
$width;
$top;
$top2;
$marginLeft = 40;

if (!isset($_GET['path'])) {
    var_dump('Please select Image');
    exit;
}

$file_name = $_GET['path'];
$type = $_GET['type'];

$top_text = strtoupper($_GET['top_text']);
$bottom_text = strtoupper($_GET['bottom_text']);

// var_dump($file_name);
// var_dump($type);
// exit;

if ($type == 'jpg') {
    header('Content-type: image/jpeg');

    // Load And Create Image From Source
    $GLOBALS['our_image'] = imagecreatefromjpeg("./" . $file_name);
}

if ($type == 'jpeg') {
    header('Content-type: image/jpeg');

    // Load And Create Image From Source
    $GLOBALS['our_image'] = imagecreatefromjpeg("./" . $file_name);
}

if ($type == 'png') {
    header('Content-type: image/png');

    // Load And Create Image From Source
    $GLOBALS['our_image'] = imagecreatefrompng("./" . $file_name);
}
$GLOBALS['height'] = imagesy($GLOBALS['our_image']);
$GLOBALS['width'] = imagesx($GLOBALS['our_image']);

function drawRectangle()
{
    $bgcolor = imagecolorallocatealpha($GLOBALS['our_image'], 0, 0, 0, 60);

    

    imagefilledrectangle($GLOBALS['our_image'], 0, $GLOBALS['height'] / 2, $GLOBALS['width'], $GLOBALS['height'], $bgcolor);
}

function drawTextOnImage()
{
    $white_color = imagecolorallocate($GLOBALS['our_image'], 255, 255, 255);

    // Set Path to Font File
    $top_text_font_path = __DIR__ . '/fonts/D-DINCondensed.otf';
    $bottom_text_font_path = __DIR__ . '/fonts/D-DINCondensed-Bold.otf';

    // Set Text to Be Printed On Image
    $fontSize = 48;
    $angle = 0;
    $left = 125;
    $marginTop = 100;
    $top = $GLOBALS['height'] / 2 + $marginTop;

    $dimensions = imagettfbbox($fontSize, $angle, $top_text_font_path, $GLOBALS['top_text']);
    $textWidth = abs($dimensions[4] - $dimensions[0]);
    $left = imagesx($GLOBALS['our_image']) - $textWidth - $GLOBALS['marginLeft'];

    // Print Text On Image
    imagettftext($GLOBALS['our_image'], $fontSize, $angle, $left, $top, $white_color, $top_text_font_path, $GLOBALS['top_text']);

    $GLOBALS['top2'] = $top + imagefontheight($fontSize) + $GLOBALS['textSpacing'];
    $fontSize2 = 60;

    $dimensions2 = imagettfbbox($fontSize2, $angle, $bottom_text_font_path, $GLOBALS['bottom_text']);
    $textWidth2 = abs($dimensions2[4] - $dimensions2[0]);
    $left2 = imagesx($GLOBALS['our_image']) - $textWidth2 - $GLOBALS['marginLeft'];

    // Print Second Text On Image
    imagettftext($GLOBALS['our_image'], $fontSize2, $angle, $left2, $GLOBALS['top2'], $white_color, $bottom_text_font_path, $GLOBALS['bottom_text']);
}

function drawLogoOnImage()
{
    $origin_logo_image = imagecreatefromjpeg("./logo.jpeg");
    $logo_image = imagecreatetruecolor(imagesx($origin_logo_image) / 2, imagesy($origin_logo_image) / 2);

    imageCopyResampled($logo_image, $origin_logo_image, 0, 0, 0, 0, imagesx($origin_logo_image) / 2, imagesy($origin_logo_image) / 2, imagesx($origin_logo_image), imagesy($origin_logo_image));

    $logo_x = $GLOBALS['width'] - (imagesx($logo_image) + $GLOBALS['marginLeft']);
    $logo_y = $GLOBALS['top2'] + $GLOBALS['textSpacing'];
    imagecopy(
        $GLOBALS['our_image'], $logo_image,
        $logo_x,
        $logo_y,
        0,
        0,
        imagesx($logo_image),
        imagesy($logo_image)
    );
    imagedestroy($logo_image);
    imagedestroy($origin_logo_image);
}

// drawRectangle();
drawTextOnImage();
// drawLogoOnImage();

// Send Image to Browser
imagepng($our_image);

// Clear Memory
imagedestroy($our_image);
