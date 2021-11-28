<?php 
    session_start();

    if(!isset($_SESSION['login']) && !isset($_SESSION['username']))
    {
        header("index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="styleConnect.css">
    <link rel="stylesheet" href="styleAnimation.css">
</head>
<head>
    <title>Connect</title>
</head>

<?php
    if(isset($_SESSION['login']) && isset($_SESSION['username'])) 
    {
        $username = $_SESSION['username'];
        $password = $_SESSION['login'];

    }
    else
    {
        echo "error!";
    }

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['update']))
    {
        update();
    }
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['delete']))
{
        delete();
}

function update()
{
    global $username;
    $connection = mysqli_connect("localhost","root","","connectapp");
    $sqlSelectPassword = "SELECT password FROM users WHERE username LIKE '$username'";
    $result = mysqli_query($connection,$sqlSelectPassword);
    $row = mysqli_fetch_row($result);
    $password = $row[0];
    $cPassword = $_POST["currentPassword"];
    $nPassword = $_POST["newPassword"];



    if($password == $cPassword){
        $sql = "UPDATE users SET password = '$nPassword' WHERE username='$username'";
        mysqli_query($connection,$sql);
        echo "<script type='text/javascript'>alert('NEW password activated');</script>";
     } else {
        echo "<script type='text/javascript'>alert('wrong current password');</script>";
     }

}

function delete() {
    global $username;

    $connection = mysqli_connect("localhost","root","","connectapp");
    $sql = "DELETE from users WHERE username='$username'";
    mysqli_query($connection,$sql);
    header("Location: index.php");
}
  
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<body>

<section class="welcome">

<div class="container">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand WhiteBorder" href="connect.php">Connect</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <form action="connect.php" method="post">
                <?php echo "<h5>User: ".$username."</h5>"?>

                    <a class="nav-link" href="index.php" style="display: inline;" >LOG OUT</a>
                    <button class="menuBtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">New password</button>
                    <input type="submit" name="delete" value="delete acc" />
                </form>
                </div>
            </div>
        </div>
    </nav>

        <div class="BlackSolid">
            WELCOME BACK
        </div>
        <div class="HalfBlackSolid">
            <?php echo $username ?>
        </div>
</div>
</section>

<br><br>
<div class="container">

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
        <div class="offcanvas-header"  style="background-color: #1375a8">
            <h3>Change password</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="background-color: #808080">
            <form class="bg_Color" action="connect.php" method="POST">
                <input type="password" name="currentPassword" placeholder="current Password">
                <input  type="password" name="newPassword" placeholder="new Password">
                <input type="submit" name="update" value="Change">

            </form>
        </div>
    </div>

</div>
<br><br>

<?php
    if ($username !== "") {
        include "body.php";
    }
?>



</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</html>