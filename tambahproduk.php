<?php 
    session_start();
    include("connect.php");
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
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
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
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
            <h3>Tambah Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="inputcontrol" name="kategori" required>
                        <option value="">--Kategori--</option>
                        <?php 
                            $kategori = mysqli_query($konek, "SELECT * FROM category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                             <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                        <?php 
                            }
                        ?>
                    </select>
                    <input type="text" name="nama" class="inputcontrol" placeholder="Nama Produk" autofocus autocomplete="off" required>
                    <input type="text" name="harga" class="inputcontrol" placeholder="Harga" autofocus autocomplete="off" required>
                    <input type="file" name="gambar" class="inputcontrol" required>
                    <textarea name="deskripsi" class="inputcontrol" placeholder="Deskripsi"></textarea><br>
                    <select class="inputcontrol" name="status">
                        <option value="">--pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn" >
                </form>
                <?php 
                    if(isset($_POST['submit'])){
                        //print_r($_FILES['gambar']);
                            // menampung inputan dari form
                        $kategori   = $_POST['kategori'];
                        $nama       = $_POST['nama'];
                        $harga      = $_POST['harga'];
                        $deskripsi  = $_POST['deskripsi'];
                        $status     = $_POST['status'];

                            // menampung data file yang di upload
                        $filename   =  $_FILES['gambar']['name'];
                        $tmp_name    =  $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1['1']; //type2 = format file

                        $newname = 'produk'.time().'.'. $type2;

                            // menampung data format file yang diizinkan
                        $type_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                            // validasi format file
                        if(!in_array($type2, $type_diizinkan)){
                            // jika format file tidak ada di dalam tipe diizinkan
                                echo '<script>alert("format file tidak diizinkan")</script>';
                        }
                        else{
                            // jika format file sesuai dengan yang ada di dalam array tipe dizinkan
                            // proses upload file == insert ke database
                                move_uploaded_file($tmp_name, './produk/'.$newname);                               
                               
                               $insert = mysqli_query($konek, "INSERT INTO product VALUES(
                                        null,
                                        '".$kategori."',
                                        '".$nama."',
                                        '".$harga."',
                                        '".$deskripsi."',
                                        '".$newname."',
                                        '".$status."',
                                        null
                                                )");

                            if($insert){
                                echo '<script>alert("simpan data berhasil")</script>';
                                echo '<script>window.location="dtproduk.php"</script>';
                            }
                            else{
                                echo 'gagal'.mysqli_error($konek);
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
    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>