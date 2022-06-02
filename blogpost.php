<!--link to the visitor css stylesheet and the link to the Google Font Raleway-->
<link rel="stylesheet" href="css/visitorstyle.css">
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">

<?php
//use include to connect to the database
include('connect.php');
//let $postID equal the id that can ge retrieved from the URL
$postID = mysqli_real_escape_string($conn, $_GET['id']);
//create a query that selects everything from the database ONLY where the id is equal to the $postID
$sql = "SELECT * FROM posts WHERE id= '{$postID}'";
//store the result in $result
$result = $conn->query($sql);
//create an associative array where each item can be reffered to as $blogpost if the result comes back successfully
if($result->num_rows > 0) {
    while($blogpost = $result->fetch_assoc()){

?>

<!DOCTYPE html>
<html>
<head>
<!-- title the page the title of the blog post and use htmlspecialchars to convert special characters into HTML entities -->
<title><?php echo htmlspecialchars($blogpost['title']);?></title> 
</head>  
    <body>
        <div id="wrapper">
        <header>
<!-- create two links, one to the blog homepage and the other to log in -->
        <h2><a href="index.php">Home</a> <a href="login.php" id="loginbutton">Log In</a></h2><br><br><br><br>
        </header> 
        <div id="blogpostContainer">  
        <div id="posthero">
<!--echo out the post's image, title, author, date and main text-->
            <img src="<?php echo htmlspecialchars($blogpost['image']);?>">
        </div>
        <h3><?php echo htmlspecialchars($blogpost['title']);?></h3>
        <h4>By: <?php echo htmlspecialchars($blogpost['author']);?></h3>
        <h4><?php echo htmlspecialchars($blogpost['date']);?></h4>
        <p id='maintext'><?php echo htmlspecialchars($blogpost['maintext']);?></p>
        </div>
    <?php } 
    } 
    ?>

        <footer>
<!--create paragraph for copyright symbol and my name-->
            <p>&copy; 2021 Sinead McGlinchey</p>
<!--Close the footer-->
        </footer>
        </div>
    </body>
</html>