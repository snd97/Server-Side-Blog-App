<!-- make a link to the CSS stylesheet -->
<link rel="stylesheet" href="css/style.css">

<?php
//include the connection file
    include("connect.php");
//start a new session
    session_start();
//create a variable to store the user feedback. First it is the initial instructions given to the user before logging in     
    $user_feedback = "<br><br>Please enter your credentials above...";
//check to see if the submit/login button was pressed, and in turn, if a POST method request sent
    if($_SERVER["REQUEST_METHOD"] == "POST") {
//if a POST request was detected, store the email that was entered into a variable called $email and the same for $password
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
//make a query that selects the id from the blog users table only where the email and password matches the ones entered in the login form
        $sql = "SELECT id FROM blogusers WHERE email='$email' AND password='$password'";
//store the result in a variable
        $result = $conn->query($sql);
//let $count equal the result
       $count = mysqli_num_rows($result);        
//if the result is true/ is 1, then it has successfully found a user with the email and password entered in the form
        if($count == 1) {
//let the login user of this session equal the user's email
            $_SESSION['login_user'] = $email;
//Redirect the user to the admin Dashboard using header
            header("location: adminDashboard.php");
//if the details do not match, let the user know that the wrong credentials were input.
        } else {
            $user_feedback =  "Invalid Credentials. Please try again.";
        }

    }

?>
<html>
<!-- open the head and set the login background image as the body -->
    <head>
<style>
body {
  background-image: url('images/login-background.png');
}
</style>
<!-- set the title of the page to Log In -->
<title>Log In</title>
</head>
<body>
<!-- create a form for logging in, set method to POST -->
<div id="login">
    <form action="" method="POST">
<!-- ensure the name for the email is email and password is password as this is used when checking the credentials -->
        <label>Email: </label><input type="text" name="email" id="email"><br><br>
<!-- set the type to password so that the user's password is hidden from view -->
        <label>Password: </label><input type="password" name="password" id="password"><br><br>
        <input type="submit" value="Login"/><br>
<!-- echo out the user feedback after the form -->
        <div><?php echo $user_feedback;?></div>
    </form>
</div>
</body>
</html>