<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<form action="" method="POST">
<fieldset>
    <legend>Log In:</legend>
    Username:<br>
    <input type="text" name="username">
    <br>
    Password:<br>
    <input type="password" name="passwrd">
    <br><br>
    <input type="submit" name="submit" value="submit">
    <input type="submit" name="redirect" value="Go to Sign Up">
</fieldset>
</form> 
</body>
</html>

<?php
include "config.php";

if (isset($_POST['redirect'])) {
    header('Location: signup.php');
}

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $passwrd = $_POST['passwrd'];

    if($username == "" || $passwrd == "" )
    {
        die('We are sorry, but there appears to be a problem with the form you submitted.'); 
    }

    else
    {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND passwrd = ?");
        $stmt->bind_param("ss", $username, $passwrd);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result -> num_rows === 1) {
            $_SESSION['name'] = $username;
            header('Location: mainpage.php');
        }
        else{
            die('We are sorry, but the username and/or password is incorrect.');
        }
        
    }  
    $conn->close();
}
?>