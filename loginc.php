<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login|danperfume</title>    
    <link rel="stylesheet" href="css/style.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@300&display=swap');</style>
</head>
<body id="bglogin">
<div class="boxlogin">
        <h2>Login customer</h2>
        <form action= "" method= "POST" >
        <input type="email" name="email" placeholder="email" autofocus autocomplete="off" class="inputcontrol"><br>
        <input type="password" name="pass" placeholder="password" class="inputcontrol"><br>
        <input type="submit" name="submit" value="login" class="btn">
        </form>
    <?php 
    if(isset($_POST['submit'])){
        session_start();
        include("connect.php");

        $email = mysqli_real_escape_string($konek, $_POST['email']);
        $pass = mysqli_real_escape_string($konek, $_POST['pass']);

        $cek = mysqli_query($konek,"SELECT * FROM customer WHERE customer_email = '".$email."' AND customer_password = '".MD5($pass)."' ");
        if(mysqli_num_rows($cek) > 0){
            $d = mysqli_fetch_object($cek);
            $_SESSION['status_loginc'] = true;
            $_SESSION['c_global'] = $d;
            $_SESSION['id'] = $d->customer_id;
            echo'<script>window.location="checkout.php"</script>';
        }
        else{
            echo'<script>alert("username/password salah!")</script>';
            echo'<script>window.location="loginc.php"</script>';
        }
    }
    ?>
</div>
</body>
</html>