<?php
//make connection to the database using the blog database credentials
$servername = 'localhost';
$username = 'blogdatabase';
$password = 'blogdatabasejune2021';
$databaseName = 'blogdatabase';

//create the connection using the credentials declared above
$conn = new mysqli($servername, $username, $password, $databaseName);

//check connection
if($conn->connect_error) {
    //if the connection had an error, it will be described here by the die command will stop the script- you will not go any further
    die("Connection Failed:" . $conn->connect_error);
}

//if connection worked you should see the next section

//echo "Connected Successfully.";


?>