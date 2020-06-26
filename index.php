<html>
   <body>

   <form method="post" enctype="multipart/form-data" >
   <label for="top_text">
   <span>Top Text</span>
		<input type="text" value="<?php echo $_POST['top_text']; ?>" name="top_text" id="top_text" required>
	</label>
	<label for="bottom_text">
	<span>Bottom Text</span>
		<input type="text" value="<?php echo $_POST['bottom_text']; ?>" name="bottom_text" id="bottom_text" required>
	</label>

   <div style="display:flex">
   <?php
$imagesDirectory = "image_folder/";

if (is_dir($imagesDirectory)) {
    $opendirectory = opendir($imagesDirectory);

    while (($image = readdir($opendirectory)) !== false) {
        if (($image == '.') || ($image == '..')) {
            continue;
        }

        $imgFileType = pathinfo($image, PATHINFO_EXTENSION);
        if (($imgFileType == 'jpg') || ($imgFileType == 'png')) {
            $imagePath = $imagesDirectory . $image;
            ?>
			<div style="padding: 5px">
				<img src="<?php echo $imagePath; ?>" alt="Girl in a jacket" style="width: 200px; height: 200px;">
				<div class="checkbox">
					<label for="test1">
						<input type="checkbox" value="<?php echo $imagePath; ?>" name="path">
						<input type="hidden" value="<?php echo $imgFileType; ?>" name="type">
					</label>
				</div>
			</div>
			<?php
}
    }

    closedir($opendirectory);

}
?>
</div>
		<button type="submit" name="submit">Convert</button>
	</form>
	<img src="image.php?path=<?php echo $_POST['path']; ?>&type=<?php echo $_POST['type']; ?>&top_text=<?php echo $_POST['top_text']; ?>&bottom_text=<?php echo $_POST['bottom_text']; ?>" width="540px" height="540px"/>
   </body>
</html>
