<?php 
    session_start();
    include("connect.php");
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    $produk = mysqli_query($konek, "SELECT * FROM product WHERE product_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk) == 0){
        echo '<script>window.location="dtproduk.php"</script>';
    }
    $p = mysqli_fetch_object($produk);
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
            <h3>Edit Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="inputcontrol" name="kategori" required>
                        <option value="">--pilih--</option>
                        <?php 
                            $kategori = mysqli_query($konek, "SELECT * FROM category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                             <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id)?'selected':''; ?>><?php echo $r['category_name'] ?></option>
                        <?php 
                            }
                        ?>
                    </select>
                    <input type="text" name="nama" class="inputcontrol" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" autofocus autocomplete="off" required>
                    <input type="text" name="harga" class="inputcontrol" placeholder="Harga" value="<?php echo $p->product_price ?>" autofocus autocomplete="off" required>
                    
                    <img src="produk/<?php echo $p->product_image ?>" width="100px">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="inputcontrol">
                    <textarea name="deskripsi" class="inputcontrol" placeholder="Deskripsi"><?php echo $p->product_description ?></textarea><br>
                    <select class="inputcontrol" name="status">
                        <option value="">--pilih--</option>
                        <option value="1" <?php echo($p->product_status == 1)? 'selected':''; ?> >Aktif</option>
                        <option value="0"  <?php echo($p->product_status == 0)? 'selected':''; ?> >Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn" >
                </form>
                <?php 
                    if(isset($_POST['submit'])){

                            //menampung data inputan dari form
                        $kategori   = $_POST['kategori'];
                        $nama       = $_POST['nama'];
                        $harga      = $_POST['harga'];
                        $deskripsi  = $_POST['deskripsi'];
                        $status     = $_POST['status'];
                        $foto       = $_POST['foto'];

                            //menampung data gambar yang baru
                        $filename   =  $_FILES['gambar']['name'];
                        $tmp_name    =  $_FILES['gambar']['tmp_name'];                     
                            
                            //jika admin ganti gambar
                        if($filename != ''){
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
                                unlink('./produk/'.$foto);
                                move_uploaded_file($tmp_name, './produk/'.$newname);
                                $namagambar = $newname;
                            }
                        }
                        else{
                                //jika admin tidak ganti gambar
                            $namagambar = $foto;
                        }

                            //query update data produk
                        $update = mysqli_query($konek, "UPDATE product SET
                                    category_id           = '".$kategori."',
                                    product_name          = '".$nama."',
                                    product_price         = '".$harga."',
                                    product_description   = '".$deskripsi."',
                                    product_image         = '".$namagambar."',
                                    product_status        = '".$status."'
                                 WHERE product_id = '".$p->product_id."'        ");

                        if($update){
                                    echo '<script>alert("simpan data berhasil")</script>';
                                    echo '<script>window.location="dtproduk.php"</script>';
                        }
                        else{
                                    echo 'gagal'.mysqli_error($konek);
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