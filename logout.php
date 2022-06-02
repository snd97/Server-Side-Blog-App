<?php
    session_start();
//if this log out button has been pressed , this code will destroy the session and redirect the user to the login page
    if(session_destroy()) {
        header("Location: login.php");
    }
?>