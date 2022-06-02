<!-- make a link to the CSS stylesheet, then link the Google Fonts Raleway font which will be used in the css -->
<link rel="stylesheet" href="css/style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
<?php
 //make sure to include the session file to make sure someone is logged in   
    include('session.php');
    include('connect.php');
//let the user equal the session's login user -their email
    $user = $_SESSION['login_user'];
// Initialize message variables for successful or unsuccessful image upload and post creation. At first it shows an empty string.
    $imgmsg = "";
    $msg = "";
// if upload button is clicked and a POST method is detected
    if (isset($_POST['upload'])) {
// Get image name that the user has selected from their device
    $image = $_FILES['image']['name'];
// create a variable $target which equals the location of the image - in this case it needs to be in the uploads folder
    $target = "uploads/".basename($image);
//let $postID equal the id of the post that can be found in the URL
//use mysqli_real_escape_string() to remove any special characters that may interfere with the query operations.
    $postID = mysqli_real_escape_string($conn, $_REQUEST['id']);
//get the values that were entered into the form and store them in appropriate variables
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $caption = mysqli_real_escape_string($conn, $_POST['caption']);
    $maintext = mysqli_real_escape_string($conn, $_POST['maintext']);
    $date = date("Y-m-d H:i:s");
//make a query that Updates the columns in the blog post with the values stored in the previous variables
    $sql = "UPDATE posts SET title='$title', author='$author', caption='$caption', maintext='$maintext', date='$date', image='$target' WHERE id='$postID'";

//move the image into the uploads folder using the $target variable, and if this is successful, let the user know with the $imgmsg    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $imgmsg = "Image uploaded successfully";
//else, if it's unsuccessful, let them know the image was not uploaded
      }else{
        $imgmsg = "Failed to upload image";
      } 
    
 //execute the query and if it successful let the user know using $msg   
    if (mysqli_query($conn, $sql)) {    
        $msg = 'Updated Post successfully';
//else,  if it has not worked, tell the user the erro with $msg      
    } else {
        $msg = "Error: " . $sql . "<br>" . mysqli_error($conn);      
    }
}
?>

<html>
<body>
    <div id="wrapper">
<!-- title the page Update Post -->
    <title>Update Post</title> 
<!-- make a nav bar which will have four elements: link to the dashboard, create post page, blog homepage and the log out button --> 
    <nav>
        <ul>        
            <li><a href='adminDashboard.php' id='dashboard'>Dashboard</a></li>
            <li><a href='createNewPost.php'>Create Post &#43;</a></li>
            <li><a href='index.php' id='home'>Blog Home</a></li>            
            <li><a href="logout.php">Log Out &#187;</a></li>
        </ul>
    </nav>
    <br>
<?php
//let the postID equal the id form the url 
$postID = mysqli_real_escape_string($conn, $_GET['id']);
//make a query that selects everything from the posts table only where the id matches the onle in $postID
    $sql = "SELECT * FROM posts WHERE id= '{$postID}'";
//store the result in $result
    $result = $conn->query($sql);
//check that a result has been found
    if($result->num_rows > 0) {   
//create an associative array of the results, letting $row equal each object
        while($row = $result->fetch_assoc()) {  
//echo out the edit post form     
            echo  "<div id=editForm>"; 
//echo out a link back to dashboard
            echo "<h2><a href='adminDashboard.php'>&#171; Back to Dashboard</a></h2><br>";
//echo out the user feedback $msg
            echo "<p id='message'>$msg</p>";
//echo out the edit post form. the forms action will link the user to the current page with the post's id 
//ensure the enctype is multipart/form-data as it contains a input type =file
            echo "<form action='updatePost.php?id=$postID' method='POST' enctype='multipart/form-data'>";
            echo "<label>Edit Image: $imgmsg </label><br><input type='hidden' name='size' value='1000000'><br>";
            echo "<div><input type='file' name='image'></div>";
//use the $row variable to get individual elements from the array and display the conten inside the inout fields
            echo "Current image is: " . $row['image'] . "<br><br>";
            echo "<label>Title:</label><br><input type='text' name='title' value=" . "'" . $row['title'] . "'" . "><br><br>";
            echo "<label>Author:</label><br><input type='text'  name='author' value=" . "'" . $row['author'] . "'" . "><br><br>";  
            echo "<label>Caption:</label><br><textarea  name='caption' rows='1' cols='30'>" . $row['caption'] . "</textarea><br><br>";
            echo "<label>Main Text:</label><br><textarea name='maintext' rows='30' cols='30'>" . $row['maintext'] . "</textarea><br><br>";      
     
            echo "<input type='submit' value='Update Post' name='upload'>";       
            echo "</form>"; 
//make a second form for the delete functionality. set the action to delete.php and the post id      
            echo "<form action='delete.php?id=$postID' method='POST'>";
            echo "<input type='submit' id='delete' value='Delete Post' name='submit'>";             
            echo "</form>";
            echo "</div>";
                   
         }
          
//if no results are found echo this out to screen
   } else {
        echo "No results found, you mustn't have any posts...";
        }

    //}

?>
        <footer>
<!--create paragraph for copyright symbol and my name-->
            <p>&copy; 2021 Sinead McGlinchey</p>
<!--Close the footer-->
        </footer>
</body>
</html>