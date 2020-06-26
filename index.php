<html>
<head>
<title>PHP script to overlay image </title>
<?php
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $tmp = explode('.', $file_name);
    $file_ext = end($tmp);

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "image_folder/" . $file_name);
    } else {
        print_r($errors);
    }
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
   <body style="padding: 20px">
   <form action="" method="POST" enctype="multipart/form-data" >
         <input type="file" name="image" />
		 <button type="submit" class="btn btn-primary">Upload</button>
      </form>

   <form method="post" enctype="multipart/form-data" >
   <div class="row">
   <div class="input-group input-group-sm mb-3 col-6">
   		<div class="input-group-prepend">
			<span class="input-group-text" id="top_text">Top Text</span>
		</div>
		<input type="text" class="form-control" placeholder="Please insert" aria-describedby="top_text" value="<?php if (isset($_POST['top_text'])) {echo $_POST['top_text'];}
{echo '';}?>" name="top_text" id="top_text" required>
	</div>
	<div class="input-group input-group-sm mb-3 col-6">
		<div class="input-group-prepend">
			<span class="input-group-text" id="bottom_text">Bottom Text</span>
		</div>
		<input type="text" class="form-control" placeholder="Please insert" aria-describedby="bottom_text" value="<?php if (isset($_POST['bottom_text'])) {echo $_POST['bottom_text'];}
{echo '';}?>" name="bottom_text" id="bottom_text" required>
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
        if (($imgFileType == 'jpg') || ($imgFileType == 'png') || ($imgFileType == 'jpeg')) {
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
	<?php if (isset($_POST['submit'])) {
    ?>
	<img src="image.php?path=<?php echo $_POST['path']; ?>&type=<?php echo $_POST['type']; ?>&top_text=<?php echo $_POST['top_text']; ?>&bottom_text=<?php echo $_POST['bottom_text']; ?>" width="540px" height="540px"/>
	<?php
}
?>

   </body>
</html>
