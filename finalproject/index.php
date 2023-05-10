<?php
require_once("config.php");

session_start();
if(isset($_SESSION["user"])){
    if($_SESSION["user"]["type"] == 1) header("Location: admin.php"); 
    else if($_SESSION["user"]["type"] == 2) header("Location: guru.php"); 
    else if($_SESSION["user"]["type"] == 3) header("Location: siswa.php"); 
}


if(isset($_POST['login'])){
    $user;
    $found = 0;
    $ctr = 0;
    $searchLocation = array(
        array('data_guru', 'nip'),
        array('data_guru', 'username'),
        array('data_guru', 'email'),
        array('data_siswa', 'nis'),
        array('data_siswa', 'nisn'),
        array('data_siswa', 'email')
    );
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    while($found == 0){
        $sql = "SELECT * FROM ".$searchLocation[$ctr][0]." WHERE ".$searchLocation[$ctr][1]."='".$username."';";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user){
            if($user[$searchLocation[$ctr][1]] == $username){
                $found = 1;
            }
            else $ctr++;
        }
        else{
            $ctr++;
            if($ctr >= 6) $found = -1;
        }
    }
    if($user){
        if(password_verify($password, $user["password"])){
            session_start();
            $_SESSION["user"] = $user;
            if($_SESSION["user"]["type"] == 1) header("Location: admin.php?edit=guru");
            else if($_SESSION["user"]["type"] == 2) header("Location: guru.php");
            else if($_SESSION["user"]["type"] == 3) header("Location: siswa.php");
        }
        else{
            echo '<script> alert("password salah!"); </script>';
        }
    }
    else{
        echo '<script> alert("User tidak terdaftar!"); </script>';
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">

    <title>E-Learning MAN Kota Surabaya</title>
</head>

<body>
    <div class="banner">
            <img src="img/MidLetter.png" alt="">
            <div class="loginc">
                <a id="LoginButton" class="loginbutton">LOGIN</a>
            </div>
    </div>
    
    <form action="" method="POST">
        <div id="myModal" class="modal hidden">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>LOGIN</h2>
                <div class="inputBox">
                    <input type="text" name="username" required="">
                    <label>Username</label>
                </div>
                <div class="inputBox">
                    <input type="password" name="password" required="">
                    <label>Password</label>
                </div>
                <input type="submit" name="login" value="Submit">
            </div>
        </div>
    </form>

    <?php require_once 'footer.php'; ?>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("LoginButton");
        var span = document.getElementsByClassName("close")[0];

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
            window.location.href = "index.php";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                window.location.href = "index.php";
            }
        }
    </script>
</body>

</html>