<?php 
    session_start();
    include("connect.php");
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    
    $query = mysqli_query($konek, "SELECT * FROM admin WHERE admin_id = '".$_SESSION['id']."'");
    $d = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>danperfume</title>
    <link rel="stylesheet" href="css/style.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@300&display=swap');</style>
</head>
<body>
                <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php"><img src="img/lg.png" width="35px"> Danperfume</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="dtkategori.php">Data Kategori</a></li><?php  ?>
                <li><a href="dtproduk.php">Data Produk</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>
                <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Profile</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="inputcontrol" value="<?php echo $d->admin_name  ?>" required>
                    <input type="text" name="user" placeholder="Username" class="inputcontrol" value="<?php echo $d->username  ?>" required>
                    <input type="text" name="hp" placeholder="No Hp" class="inputcontrol" value="<?php echo $d->admin_telp  ?>" required>
                    <input type="email" name="email" placeholder="Email" class="inputcontrol" value="<?php echo $d->admin_email  ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="inputcontrol" value="<?php echo $d->admin_address  ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn" required>
                </form>
                <?php 
                    if(isset($_POST['submit'])){
                            $nama   = ucwords($_POST['nama']);
                            $user   = $_POST['user'];
                            $hp     = $_POST['hp'];
                            $email  = $_POST['email'];
                            $alamat = ucwords($_POST['alamat']);

                        $update = mysqli_query($konek, "UPDATE admin SET
                                        admin_name     = '".$nama."',
                                        username       = '".$user."',
                                        admin_telp     = '".$hp."',
                                        admin_email    = '".$email."',
                                        admin_address  = '".$alamat."'
                                        WHERE admin_id = '".$d->admin_id."'
                                        ");
                        if ($update){
                            echo '<script> alert("ubah data berhasil") </script>';
                            echo '<script> window.location="profil.php" </script>';
                        }
                        else{
                            echo 'gagal' .mysqli_error($konek);
                        }                       
                    }
                ?>
            </div>

            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru" class="inputcontrol" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="inputcontrol" required>
                    <input type="submit" name="ubahpassword" value="Ubah Password" class="btn">
                </form>
                <?php 
                    if(isset($_POST['ubahpassword'])){
                            $pass1   = $_POST['pass1'];
                            $pass2   = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script> alert("Konfirmasi Password Baru Tidak Sesuai") </script>';
                        }
                        else{
                                $ubpass = mysqli_query ($konek, "UPDATE admin SET
                                password        = '".MD5($pass1)."'
                                WHERE admin_id  = '".$d->admin_id."' 
                                ");                              

                                if ($ubpass){
                                    echo '<script> alert("ubah data berhasil") </script>';
                                    echo '<script> window.location="profil.php" </script>';
                                }
                                else{
                                    echo 'gagal' .mysqli_error($konek);
                                }
                                
                        }                                                
                    }
                ?>
            </div>
        </div>
    </div>
                <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2022 - Danperfume.</small>
        </div>
    </footer>
</body>
</html>