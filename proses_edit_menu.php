<?php
include 'config.php';

$id        = $_POST['id'];
$nama_menu = $_POST['nama_menu'];
$harga     = $_POST['harga'];
$kategori  = $_POST['kategori'];

$query = "UPDATE menu 
          SET nama_menu = '$nama_menu', 
              harga = $harga, 
              kategori = '$kategori'
          WHERE ID_Menu = $id";

if (mysqli_query($conn, $query)) {
    header("Location: edit_menu.php");
} else {
    echo "Gagal mengupdate menu: " . mysqli_error($conn);
}
?>
