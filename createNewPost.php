<link rel="stylesheet" href="css/style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
<?php

include('session.php');
include('connect.php');

  // Initialize message variables for successful or unsuccessful image upload and post creation. At first it shows an empty string.
$msg = "";
$imgmsg ="";


// if upload button is clicked and a POST method is detected
if (isset($_POST['upload'])) {
// Get image name that the user has selected from their device
  $image = $_FILES['image']['name'];
// create a variable $target which equals the location of the image - in this case it needs to be in the uploads folder
  $target = "uploads/".basename($image); 
//get the values that were entered into the form and store them in appropriate variables
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $author = mysqli_real_escape_string($conn, $_POST['author']);
  $caption = mysqli_real_escape_string($conn, $_POST['caption']);
  $maintext = mysqli_real_escape_string($conn, $_POST['maintext']);
  $date = date("Y-m-d H:i:s");
  
//create a query that inserts the values stored in the variables into the appropriate columns in the database  	
  $sql = "INSERT INTO posts (title, author, caption, maintext, date, image) VALUES ('$title', '$author', '$caption', '$maintext','$date', '$target')";
  
//move the image into the uploads folder using the $target variable, and if this is successful, let the user know with the $imgmsg    
 	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$imgmsg = "Image uploaded successfully. <br>";   
//else, if it's unsuccessful, let them know the image was not uploaded     
  	}else{
  		$imgmsg = "Failed to upload image.";
  	}
// execute query. if successful, show positive user feedback. If not successful, show error.
    if (mysqli_query($conn, $sql)) { 
        $msg = 'Post Created Successfully';        
    } else {
        $msg = "Error: " . $sql . "<br>" . mysqli_error($conn);        
    }

}

?>


<!DOCTYPE html>
<html>
<head>
<!-- title the page Update Post -->
<title>Create A Post</title>
<!-- make a nav bar which will have four elements: link to the dashboard, create post page, blog homepage and the log out button --> 
</head>
<body>
    <div id="wrapper">
    <nav>
        <ul>        
            <li><a href='adminDashboard.php' id='dashboard'>Dashboard</a></li>
            <li><a href='createNewPost.php'>Create Post &#43;</a></li>
            <li><a href='index.php' id='home'>Blog Home</a></li>            
            <li><a href="logout.php">Log Out &#187;</a></li>
        </ul>
    </nav>
    <br>
    <div id="createPost">
    <h2>Create new blog post:</h2>
<!-- echo out the user feedback in a paragraph tag -->
    <p id="message"><?php echo $msg?></p>
<!-- create a form for the user to enter in a new blog post. the action will be the current page for the previous php code to be executed-->
<!-- ensure the enctype is multipart/form-data as it contains a input type =file -->
  <form method="POST" action="createNewPost.php" enctype="multipart/form-data">
<!--echo out the user feedback about the image upload after Select an Image-->
  <label>Select an Image: <?php echo $imgmsg ?></label><br><br>  
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image">
  	</div><br>
  	<div>
      <label>Title:</label><br>
      <input type="text" name="title"><br><br>
      <label>Author:</label><br>
      <input type="text" name="author"><br><br>
      <label>Caption:</label> <br>
      <textarea id="caption" name="caption" rows="1" cols="30"></textarea><br><br>
      <label>Main Text:</label><br>
      <textarea id="mainBody" name="maintext" rows="10" cols="70"></textarea><br><br>
  	</div>
  	<div>
<!-- create the button to submit the form data, and ensure the name=upload to match the php code above -->
  		<button type="submit" class= "button" name="upload">PUBLISH POST</button>
  	</div>
  </form>
</div>
<footer>
<!--create paragraph for copyright symbol and my name-->
            <p>&copy; 2021 Sinead McGlinchey</p>
<!--Close the footer-->
        </footer>
</body>
</html>


