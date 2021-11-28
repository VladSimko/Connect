
<?php

$warring = "";

    if(isset($_POST["submit"]))
    {
        
        $connection = mysqli_connect("localhost","root","","connectapp");
        $username = $_POST["username"];
        $username = trim($username); //odstranenie medzier za menom
        $password = $_POST["password"];
        $repeadPassword = $_POST["repeatPassword"];

        $username = mysqli_real_escape_string($connection,$username); //kvoli specialnym znakom osetrujem
        $password = mysqli_real_escape_string($connection,$password);
        $repeadPassword = mysqli_real_escape_string($connection,$repeadPassword);
        
         

        if($username && $password && $repeadPassword)
        {
            
            if($password == $repeadPassword)
            {
                $selectUser = "SELECT username FROM users WHERE username LIKE '$username' ";
                $result = mysqli_query($connection,$selectUser);
                $row= mysqli_fetch_row($result);
                if(strlen($password)<8)
                {
                    $warring = "<div style='color:red;'>The minumum password size must be 8 characters!<br></div>";
                }
                if(!empty($row))
                {   
                    $warring = "<div style='color:red;'>Username exists!<br></div>";
                }
                
                if(strlen($password)>=8 && empty($row))
                {
                //hashovanie hesla
                // $hashFormat = "$2y$10$";
                // $salt = "N4M5Lk0uN6Va1s9dNJ20Ld";
                // $hashFormat_salt = $hashFormat.$salt;
                // $password = crypt($password,$hashFormat_salt);
                
                
                    $addUser = "INSERT INTO users(username,password) VALUES('$username','$password')";
                    $result = mysqli_query($connection,$addUser);
                    $warring = "<div style='color:green;'>registration is successful<br></div>";
                }
                
                
            } else
            {
                $warring = "<div style='color:red;'>passwords are not same!<br></div>";
            }
        }else
        {
            $warring = "<div style='color:red;'>something is empty!<br></div>";
        }

        
    }

?>



<!DOCTYPE html>
<html lang="en">
    <?php include "head.php" ?>
<head>
    <title>Connect-register</title>
</head>

<body class="bodyLogin">
    
        <form class="bg_Color" action="register.php" method="post">
        <h1>Connect</h1>
            <h3>Registration</h3>
            <input type="text" placeholder="Name" name="username">
            <input type="password" placeholder="Password" name="password">
            <input type="password" placeholder="Repeat password" name="repeatPassword">
            <input type="submit" value="register" name="submit">
            <a href="index.php" class="buttonGreen">login</a>
            <?php echo $warring;?>
        </form>
        
</body>

</html>