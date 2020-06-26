<html>
<head>
<title>PHP script to overlay image </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
   <body >

   <form method="post" enctype="multipart/form-data" >
   <div class="row">
   <div class="input-group input-group-sm mb-3 col-6">
   		<div class="input-group-prepend">
			<span class="input-group-text" id="top_text">Top Text</span>
		</div>
		<input type="text" class="form-control" placeholder="Please insert" aria-describedby="top_text" value="<?php echo $_POST['top_text']; ?>" name="top_text" id="top_text" required>
	</div>
	<div class="input-group input-group-sm mb-3 col-6">
		<div class="input-group-prepend">
			<span class="input-group-text" id="bottom_text">Bottom Text</span>
		</div>
		<input type="text" class="form-control" placeholder="Please insert" aria-describedby="bottom_text" value="<?php echo $_POST['bottom_text']; ?>" name="bottom_text" id="bottom_text" required>
	</div>
	</div>

   <div class="row">
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
			<div class="col-sm-4 col-md-4 col-lg-2" >
				<img src="<?php echo $imagePath; ?>" alt="Girl in a jacket" style="padding: 15px;max-width: 100%; max-height: 100%;">
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
		<button type="submit" class="btn btn-success">Convert</button>
	</form>
	<img src="image.php?path=<?php echo $_POST['path']; ?>&type=<?php echo $_POST['type']; ?>&top_text=<?php echo $_POST['top_text']; ?>&bottom_text=<?php echo $_POST['bottom_text']; ?>" width="540px" height="540px"/>
   </body>
</html>
