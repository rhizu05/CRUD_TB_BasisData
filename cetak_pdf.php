<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

include 'config.php';

$id = $_GET['id'];

$q1 = mysqli_query($conn, "SELECT t.*, k.nama_kasir, p.nama_pelanggan, b.tunai, b.kembalian
FROM transaksi t
JOIN kasir k ON t.ID_Kasir = k.ID_Kasir
JOIN pelanggan p ON t.ID_Pelanggan = p.ID_Pelanggan
LEFT JOIN pembayaran b ON t.ID_Transaksi = b.ID_Transaksi
WHERE t.ID_Transaksi = $id");

$t = mysqli_fetch_assoc($q1);

$q2 = mysqli_query($conn, "SELECT m.nama_menu, ps.jumlah_pesanan, ps.harga_satuan, 
(ps.jumlah_pesanan * ps.harga_satuan) AS total
FROM pesanan ps
JOIN menu m ON ps.ID_Menu = m.ID_Menu
WHERE ps.ID_Transaksi = $id");

$logoPath = 'assets/img/logo.jpg';
if (file_exists($logoPath)) {
    $data = base64_encode(file_get_contents($logoPath));
    $logo = 'data:image/jpeg;base64,' . $data;
} else {
    $logo = ''; // fallback
}

// start output buffer
ob_start();
?>

<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    .struk {
        width: 100%;
    }

    .logo {
        text-align: center;
        margin-bottom: 10px;
    }

    .logo img {
        max-width: 100px;
        height: auto;
    }

    h2 {
        text-align: center;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    th, td {
        border-bottom: 1px solid #ccc;
        padding: 6px;
        text-align: left;
    }

    h3 {
        text-align: right;
        margin-top: 15px;
    }

    .info {
        margin-bottom: 10px;
    }

    .info p {
        margin: 2px 0;
    }
</style>

<div class="struk">
    <div class="logo">
        <img src="<?= $logo ?>" alt="Logo Restoran" style="max-width: 120px;">
    </div>
    <h2>STRUK PESANAN</h2>

    <div class="info">
        <p><strong>No. Transaksi:</strong> <?= $id ?></p>
        <p><strong>Waktu:</strong> <?= $t['waktu_pesanan'] ?></p>
        <p><strong>Kasir:</strong> <?= $t['nama_kasir'] ?></p>
        <p><strong>Pelanggan:</strong> <?= $t['nama_pelanggan'] ?></p>
    </div>

    <table>
        <tr>
            <th>Menu</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        <?php while ($item = mysqli_fetch_assoc($q2)) : ?>
            <tr>
                <td><?= $item['nama_menu'] ?></td>
                <td><?= $item['jumlah_pesanan'] ?></td>
                <td>Rp<?= number_format($item['harga_satuan']) ?></td>
                <td>Rp<?= number_format($item['total']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h3>Total Bayar: Rp<?= number_format($t['total_harga']) ?></h3>
    <?php if ($t['tunai'] !== null): ?>
        <p><strong>Tunai:</strong> Rp<?= number_format($t['tunai']) ?></p>
        <p><strong>Kembalian:</strong> Rp<?= number_format($t['kembalian']) ?></p>
    <?php endif; ?>
</div>

<?php
$html = ob_get_clean(); // ambil isi buffer

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("struk_transaksi_$id.pdf", array("Attachment" => true));
exit;
