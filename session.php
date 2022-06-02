<?php
//include the database connection file
    include('connect.php');
//begin a session/resume existing session
    session_start();
//let $email_check equal the session's login user - in this case it refers to the user's email which was declared in login.php
    $email_check = $_SESSION['login_user'];    
//check if the current session is set with the email matching the logged in users' email
    $sql = mysqli_query($conn, "SELECT email FROM users WHERE email='$email_check'");

//if the session is not set, kick the person out and redirect them back to the login page   
    if(!isset($_SESSION['login_user'])) {
        header("location:login.php");
        die();
    }

?>