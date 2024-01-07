<?php include("navbar.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Image Upload</title>
	<style>
		.cnt {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			min-height: 100vh;
		}
	</style>
</head>
<body>
	<div class="cnt">
		<?php 
		if (isset($_POST['submit'])) {
			// Include the database connection file
			include 'db-images.php';

			// Get the image file
			$image = $_FILES['my_img']['tmp_name'];
			$imgContent = addslashes(file_get_contents($image));

			// Convert the binary into a string to store in the database
			$binaryData = file_get_contents($image);
			$imgContent = base64_encode($binaryData);

			$description = $_POST['Description'];

			// Insert image content into the database
			$insert = $connection->conn->query("INSERT into images (image_url, description) VALUES ('$imgContent', '$description')");
			if($insert){
				echo "File uploaded successfully.";
			}else{
				echo "File upload failed, please try again.";
			} 
		}
		?>
	
		<form method="post" enctype="multipart/form-data">

			<input type="file" name="my_img">


			<input type="text" name="Description">


			<input type="submit" name="submit" value="Upload">
			
				
		</form>

	</div>

</body>

</html>


