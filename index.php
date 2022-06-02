<!--link to the visitor css stylesheet and the link to the Google Font Raleway-->
<link rel="stylesheet" href="css/visitorstyle.css">
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">

<?php
//use include to connect to the database
include('connect.php');
//create a variable $sql to store the selection from the database. use SELECT * to get everything from posts table and make sure to include ORDER BY date DESC to ensure that the posts will show in chronological order starting with the latest posts.
$sql = "SELECT * FROM posts ORDER BY date DESC";
//store the result in variable $result
$result = mysqli_query($conn, $sql);
//turn the result into an associative array and store this in variable $blogposts
$blogposts = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
<!-- title the page The Gunner Diaries -->
<title>The Gunner Diaries</title> 
</head>  
    <body>
        <div id="wrapper">        
        <header>
<!-- create two links, one to the blog homepage and the other to log in -->
        <h2><a href="index.php">Home</a> <a href="login.php" id="loginbutton">Log In</a></h2><br><br><br><br>
        </header>    
        <div id="hero">
            <img src="images/the-gunner-diaries.png" alt="The Gunner Diaries, a blog all about Arsenal" title="The Gunner Diaries, a blog all about Arsenal">
        </div>
        <h1>Latest Posts</h1>
    <div id="allblogsContainers"> 
<!-- create a foreach loop. Each object in the array $blogposts will be referred to as $blogpost-->
<!-- use array_slice to return selected parts of the blogposts array. Define 0 as the post I want to begin with and specify that the length should be 10. This will mean that only 10 posts will show at any time on this page-->
            <?php foreach(array_slice($blogposts, 0, 10) as $blogpost){?>
<!--make a div for each individual blog post to style in css-->
                <div id="blogContainer">
<!--loop through and show the image of the blogpost, the title, author, date and caption. use htmlspecialchars to convert speical characters into HTML entities -->
                    <img src="<?php echo htmlspecialchars($blogpost['image']);?>" width="300">
<!--In order to link the user to the correct blog post page, insert ?id= after blogpost.php in href, followed by the blogpost's id number. Make the text for this link the blogpost's title-->
                    <h3><a href="blogpost.php?id=<?php echo $blogpost['id']?>"><?php echo htmlspecialchars($blogpost['title']); ?></a></h3>
                    <p><?php echo htmlspecialchars($blogpost['author']); ?>
                       || <?php echo htmlspecialchars($blogpost['date']); ?></p> 
                    <p><?php echo htmlspecialchars($blogpost['caption']); ?></p>
                    <p><a href="blogpost.php?id=<?php echo $blogpost['id']?>">Read the full post &#8594;</a></p>
                </div>
            <?php } ?>
        
    </div>

    <footer>
<!--create paragraph for copyright symbol and my name-->
            <p>&copy; 2021 Sinead McGlinchey</p>
<!--Close the footer-->
    </footer>
        </div>
    </body>
</html>

