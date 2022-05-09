<?php 

session_start();
$product_id = $_GET['id'];
unset($_SESSION["keranjang"]["$product_id"]);
echo '<script>window.location="keranjang.php"</script>';

?>