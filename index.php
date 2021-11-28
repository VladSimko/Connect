<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <?php include "head.php" ?>
<head>
    <title>Connect</title>
</head>

<?php 
    $warring = "";
    $_SESSION['login'] = "";
    $_SESSION['username'] = "";

    if(isset($_POST["submit"]))
    {
        $connection = mysqli_connect("localhost","root","","connectapp");
        $username = $_POST["username"];
        $username = trim($username); //odstranenie medzier za menom
        $password = $_POST["password"];
        $username = mysqli_real_escape_string($connection,$username); //kvoli specialnym znakom osetrujem
        $password = mysqli_real_escape_string($connection,$password);


        $selectUser = "SELECT username FROM users WHERE username LIKE '$username' AND password LIKE '$password'";
        $resultUser = mysqli_query($connection,$selectUser);
        $row = mysqli_fetch_row($resultUser);

       

        if(empty($row))
        {
            $warring = "<div style='color:red;'>wrong password or username!<br></div>";
          
        }else
        {
            //otvorim appku
            $_SESSION['login'] = $password;
            $_SESSION['username'] = $username;
            header("Location: connect.php");
        }
        
    }

?>



<body class="bodyLogin">
    
        <form class="bg_Color" action="index.php" method="POST">
        <h1>Connect</h1>
            <h3>Login</h3>
            <input type="text" name="username" placeholder="Name">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" name="submit" value="Login"> 
            <a href="register.php" class="btn_register">registration</a></br>
            <?php echo $warring;?>
        </form>
        
</body>

</html>