<?php
	// Stage 1: Replicate the first image style
	// Stage 2: Replicate the first image style, with the user able to select different background images.
	// Stage 3: Introduce a second image style, with different background images.
	if (isset($_POST['submit'])) {


		$file_name = $_POST['image'];
			// $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));


		header('Content-type: image/png');

		// Load And Create Image From Source
		$our_image = imagecreatefrompng("./images/".$file_name);
		
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
		$text ="LANUNCHING SOON!";
		
		$fontSize=24;
		$angle=0;
		$left=125;
		$marginLeft = 20;
		$marginTop = 50;
		$top = $height/2 + $marginTop;
		$textSpacing = 30;
		
		
		
		$dimensions = imagettfbbox($fontSize, $angle, $font_path, $text);
		$textWidth = abs($dimensions[4] - $dimensions[0]);
		$left = imagesx($our_image) - $textWidth - $marginLeft;
		
		// Print Text On Image
		imagettftext($our_image, $fontSize, $angle, $left, $top, $white_color, $font_path, $text);


		$text2 = "SUBSCRIBE TO UPDATES";
		$top2 = $top + imagefontheight(32) + $textSpacing;
		$fontSize2 = 32;

		$dimensions2 = imagettfbbox($fontSize2, $angle, $font_path, $text2);
		$textWidth2 = abs($dimensions2[4] - $dimensions2[0]);
		$left2 = imagesx($our_image) - $textWidth2 - $marginLeft;



		// Print Second Text On Image
		imagettftext($our_image, $fontSize2, $angle, $left2, $top2, $white_color, $font_path, $text2);


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

	}
?>
<html>
   <body>
      
   <form method="post" enctype="multipart/form-data" >
    <div>
			<img src="test.png" alt="Girl in a jacket" id="test1">
			<div class="checkbox">

				<label for="test1">
					<input type="checkbox" value="test.png" name="image">
				</label>

				
			</div>
		</div>
		<div>
			<img src="test.png" alt="Girl in a jacket" id="test2">

			<div class="checkbox">

				<label for="test2">
					<input type="checkbox" value="test.png" name="image">
				</label>

			</div>
		</div>
		<button type="submit" name="submit">Submit</button>
	</form>
      
   </body>
</html>