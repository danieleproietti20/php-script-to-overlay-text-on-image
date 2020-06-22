<?php
// Stage 1: Replicate the first image style
// Stage 2: Replicate the first image style, with the user able to select different background images.
// Stage 3: Introduce a second image style, with different background images.

$textSpacing = 30;
$text = "LANUNCHING SOON!";
$text2 = "SUBSCRIBE TO UPDATES";

$our_image;
$height;
$width;
$top;
$top2;
$marginLeft = 20;

if (isset($_POST['submit'])) {

    $file_name = $_POST['path'];
    $type = $_POST['type'];

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

    function drawRectangle()
    {
        $bgcolor = imagecolorallocatealpha($GLOBALS['our_image'], 0, 0, 0, 60);

        $GLOBALS['height'] = imagesy($GLOBALS['our_image']);
        $GLOBALS['width'] = imagesx($GLOBALS['our_image']);

        imagefilledrectangle($GLOBALS['our_image'], 0, $GLOBALS['height'] / 2, $GLOBALS['width'], $GLOBALS['height'], $bgcolor);
    }

    function drawTextOnImage()
    {
        $white_color = imagecolorallocate($GLOBALS['our_image'], 255, 255, 255);

        // Set Path to Font File
        $font_path = __DIR__ . '/D-DINCondensed-Bold.otf';

        // Set Text to Be Printed On Image
        $fontSize = 24;
        $angle = 0;
        $left = 125;
        $marginTop = 50;
        $top = $GLOBALS['height'] / 2 + $marginTop;

        $dimensions = imagettfbbox($fontSize, $angle, $font_path, $GLOBALS['text']);
        $textWidth = abs($dimensions[4] - $dimensions[0]);
        $left = imagesx($GLOBALS['our_image']) - $textWidth - $GLOBALS['marginLeft'];

        // Print Text On Image
        imagettftext($GLOBALS['our_image'], $fontSize, $angle, $left, $top, $white_color, $font_path, $GLOBALS['text']);

        $GLOBALS['top2'] = $top + imagefontheight(32) + $GLOBALS['textSpacing'];
        $fontSize2 = 32;

        $dimensions2 = imagettfbbox($fontSize2, $angle, $font_path, $GLOBALS['text2']);
        $textWidth2 = abs($dimensions2[4] - $dimensions2[0]);
        $left2 = imagesx($GLOBALS['our_image']) - $textWidth2 - $GLOBALS['marginLeft'];

        // Print Second Text On Image
        imagettftext($GLOBALS['our_image'], $fontSize2, $angle, $left2, $GLOBALS['top2'], $white_color, $font_path, $GLOBALS['text2']);
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

    drawRectangle();
    drawTextOnImage();
    drawLogoOnImage();

    // Send Image to Browser
    imagepng($our_image);

    // Clear Memory
    imagedestroy($our_image);

}
?>
<html>
   <body>

   <form method="post" enctype="multipart/form-data" >
   <?php
$imagesDirectory = "image_folder/";

if (is_dir($imagesDirectory)) {
    $opendirectory = opendir($imagesDirectory);

    while (($image = readdir($opendirectory)) !== false) {
        if (($image == '.') || ($image == '..')) {
            continue;
        }

        $imgFileType = pathinfo($image, PATHINFO_EXTENSION);

        $imagePath = $imagesDirectory . $image;
        ?>
			<div>
				<img src="<?php echo $imagePath; ?>" alt="Girl in a jacket" style="width: 80px; height: 80px;">
				<div class="checkbox">
					<label for="test1">
						<input type="checkbox" value="<?php echo $imagePath; ?>" name="path">
						<input type="hidden" value="<?php echo $imgFileType; ?>" name="type">
					</label>
				</div>
			</div>
			<?php
}

    closedir($opendirectory);

}
?>
		<button type="submit" name="submit">Submit</button>
	</form>

   </body>
</html>
