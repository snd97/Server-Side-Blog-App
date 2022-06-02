
<?php
 //make sure to include the session file to make sure someone is logged in   
    include('session.php');
    include('connect.php');
//let the user equal the session's login user -their email
    $user = $_SESSION['login_user']; 
//let $postID equal the id of the post that can be found in the URL
    $postID = mysqli_real_escape_string($conn, $_REQUEST['id']);
//create a query that deletes the post only where the id is equal to the $postID
    $sql = "DELETE FROM posts WHERE id='$postID'";
//IF THIS IS SUCCESSFUL, redirect the user to the dashboard
    if ($conn->query($sql) === TRUE) {
        header("location: adminDashboard.php");
 //otherwise, if it was unsuccessful, echo out the error   
    } else {
    echo "Error deleting record: " . $conn->error;    
    }


?>