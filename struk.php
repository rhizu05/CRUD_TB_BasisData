<?php
include 'config.php';

$id_transaksi = $_GET['id'];

// Ambil detail transaksi, kasir, pelanggan, pembayaran
$query = mysqli_query($conn, "
    SELECT t.*, 
           k.nama_kasir, 
           p.nama_pelanggan, 
           b.tunai, 
           b.kembalian
    FROM transaksi t
    JOIN kasir k ON t.ID_Kasir = k.ID_Kasir
    JOIN pelanggan p ON t.ID_Pelanggan = p.ID_Pelanggan
    LEFT JOIN pembayaran b ON t.ID_Transaksi = b.ID_Transaksi
    WHERE t.ID_Transaksi = $id_transaksi
");

$transaksi = mysqli_fetch_assoc($query);

// Ambil daftar pesanan
$items = mysqli_query($conn, "
    SELECT m.nama_menu, ps.jumlah_pesanan, ps.harga_satuan, 
           (ps.jumlah_pesanan * ps.harga_satuan) AS total
    FROM pesanan ps
    JOIN menu m ON ps.ID_Menu = m.ID_Menu
    WHERE ps.ID_Transaksi = $id_transaksi
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk Pesanan</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('assets/img/restoran.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .struk {
            max-width: 600px;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            max-width: 120px;
            height: auto;
        }

        h2 {
            text-align: center;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        th {
            border-bottom: 1px solid #aaa;
        }

        hr {
            margin: 10px 0;
        }

        h3 {
            text-align: right;
            margin-top: 15px;
        }

        a {
            display: inline-block;
            text-decoration: none;
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        a:hover {
            background: #218838;
        }

        .info {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="struk">
        <div class="logo">
            <img src="assets/img/logo.jpg" alt="Logo Restoran">
        </div>
        <h2>STRUK PESANAN</h2>

        <div class="info">
            <p><strong>No. Transaksi:</strong> <?= $id_transaksi ?></p>
            <p><strong>Waktu:</strong> <?= $transaksi['waktu_pesanan'] ?></p>
            <p><strong>Kasir:</strong> <?= $transaksi['nama_kasir'] ?></p>
            <p><strong>Pelanggan:</strong> <?= $transaksi['nama_pelanggan'] ?></p>
        </div>

        <hr>

        <table>
            <tr>
                <th>Menu</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
            <?php while ($item = mysqli_fetch_assoc($items)): ?>
            <tr>
                <td><?= $item['nama_menu'] ?></td>
                <td><?= $item['jumlah_pesanan'] ?></td>
                <td>Rp<?= number_format($item['harga_satuan']) ?></td>
                <td>Rp<?= number_format($item['total']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <hr>

        <h3>Total Bayar: Rp<?= number_format($transaksi['total_harga']) ?></h3>
        <?php if ($transaksi['tunai'] !== null): ?>
        <p><strong>Tunai:</strong> Rp<?= number_format($transaksi['tunai']) ?></p>
        <p><strong>Kembalian:</strong> Rp<?= number_format($transaksi['kembalian']) ?></p>
        <?php endif; ?>

        <a href="index.php">Kembali Ke Halaman Utama</a>
        <a href="cetak_pdf.php?id=<?= $id_transaksi ?>" target="_blank">Download PDF</a>
    </div>
</body>
</html>
