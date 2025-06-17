<?php
include 'config.php';

// Ambil data dari form
$nama_kasir     = $_POST['nama_kasir'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$waktu_pesanan  = $_POST['waktu_pesanan'];
$id_menu        = $_POST['id_menu'];
$jumlah         = $_POST['jumlah'];
$harga          = $_POST['harga'];

// === Cek atau Tambah Kasir ===
$q_kasir = mysqli_query($conn, "SELECT ID_Kasir FROM kasir WHERE nama_kasir = '$nama_kasir' LIMIT 1");
if (mysqli_num_rows($q_kasir) > 0) {
    $id_kasir = mysqli_fetch_assoc($q_kasir)['ID_Kasir'];
} else {
    mysqli_query($conn, "INSERT INTO kasir (nama_kasir) VALUES ('$nama_kasir')");
    $id_kasir = mysqli_insert_id($conn);
}

// === Cek atau Tambah Pelanggan ===
$q_pelanggan = mysqli_query($conn, "SELECT ID_Pelanggan FROM pelanggan WHERE nama_pelanggan = '$nama_pelanggan' LIMIT 1");
if (mysqli_num_rows($q_pelanggan) > 0) {
    $id_pelanggan = mysqli_fetch_assoc($q_pelanggan)['ID_Pelanggan'];
} else {
    mysqli_query($conn, "INSERT INTO pelanggan (nama_pelanggan) VALUES ('$nama_pelanggan')");
    $id_pelanggan = mysqli_insert_id($conn);
}

// === Hitung Total Harga ===
$total_harga = 0;
for ($i = 0; $i < count($id_menu); $i++) {
    $total_harga += $jumlah[$i] * $harga[$i];
}

// === Simpan ke transaksi ===
mysqli_query($conn, "INSERT INTO transaksi (ID_Pelanggan, ID_Kasir, status_pesanan, waktu_pesanan, total_harga)
                     VALUES ($id_pelanggan, $id_kasir, 'Selesai', '$waktu_pesanan', $total_harga)");
$id_transaksi = mysqli_insert_id($conn);

// === Simpan ke pesanan ===
for ($i = 0; $i < count($id_menu); $i++) {
    $id = (int)$id_menu[$i];
    $jml = (int)$jumlah[$i];
    $hrg = (int)$harga[$i];

    mysqli_query($conn, "INSERT INTO pesanan (ID_Transaksi, ID_Menu, jumlah_pesanan, harga_satuan)
                         VALUES ($id_transaksi, $id, $jml, $hrg)");
}

// === Simpan pembayaran dummy (tunai = total, kembalian = 0) ===
mysqli_query($conn, "INSERT INTO pembayaran (ID_Transaksi, metode_pembayaran, status_pembayaran, tunai, kembalian)
                     VALUES ($id_transaksi, 'Tunai', 'Lunas', $total_harga, 0)");

// Redirect ke struk
header("Location: struk.php?id=$id_transaksi");
exit;
?>
