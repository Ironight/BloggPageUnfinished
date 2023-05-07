<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<form action="" method="POST">
<fieldset>
    <legend>Sign In:</legend>
    Username:<br>
    <input type="text" name="username">
    <br>
    Password:<br>
    <input type="password" name="passwrd">
    <br><br>
    <input type="submit" name="submit" value="submit">
    <input type="submit" name="redirect" value="Go to Login">
</fieldset>
</form> 
</body>
</html>

<?php
include "config.php";

if (isset($_POST['redirect'])) {
    header('Location: login.php');
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
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result -> num_rows === 0) {
            $sql = "INSERT INTO `users`(`username`, `passwrd`) 
            VALUES ('$username','$passwrd')";
            $result = $conn->query($sql);
            $_SESSION['name'] = $username;

            if ($result == TRUE) 
            {
                echo "New record created successfully.";
                
            }
            else
            {
                echo "Error:". $sql . "<br>". $conn->error;
            }
            header('Location: mainpage.php');
        }
        else{
            die('We are sorry, but the username already exists');
        }
        
    }  
    $conn->close();
}
?>