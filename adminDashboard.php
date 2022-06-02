<!-- make a link to the CSS stylesheet, then link the Google Fonts Raleway font which will be used in the css -->
<link rel="stylesheet" href="css/style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">

<?php
//make sure to include the session file to make sure someone is logged in
    include('session.php');
//let the user equal the session's login user -their email
    $user = $_SESSION['login_user'];
?>

<html>
<body>
    <div id="wrapper">
<!-- title the page Admin Dashboard -->
    <title>Admin Dashboard</title>  
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
//echo a welcome message with the user's email    
    echo "<h1>Welcome to the Dashboard, " . $user . "</h1>";
    echo "<h2 class='admin'>The Gunner Diaries: Latest Posts</h2>";
    echo "<div id='allblogsContainers'>"; 
//create an SQL query that selects everything from the posts table and orders the posts by date in descending order
    $sql = "SELECT * FROM posts ORDER BY date DESC";
//store the result in $result
    $result = $conn->query($sql);
//check that a result has been found
    if($result->num_rows > 0) {
//create an associative array of the results, letting $blogpost equal each object
        while($blogpost = $result->fetch_assoc()) {?>            
                <div id="blogContainer">
<!--loop through and show the image of the blogpost, the title, author, date and caption. use htmlspecialchars to convert special characters into HTML entities -->
                    <img src="<?php echo htmlspecialchars($blogpost['image']);?>" width="300">
                    <h3><?php echo htmlspecialchars($blogpost['title']); ?></a></h3>
                    <p>Author: <?php echo htmlspecialchars($blogpost['author']); ?></p>
                    <p>Date: <?php echo htmlspecialchars($blogpost['date']); ?></p>                    
<!--In order to link the admin to the correct blog post page to edit, insert ?id= after updatePost.php in href, followed by the blogpost's id number-->
                    <a href="updatePost.php?id=<?php echo htmlspecialchars($blogpost['id'])?>">Edit or Delete Post &#8594;</a>
                </div>
        <?php }
    }
//if the query doesn't find any result, echo this out
     else {
        echo "No results found, you mustn't have any posts...";
        }
?>
</div> 

<footer>
<!--create paragraph for copyright symbol and my name-->
            <p>&copy; 2021 Sinead McGlinchey</p>
<!--Close the footer-->
        </footer>
</body>
</html>