<?php
include 'config.php';
$menus = mysqli_query($conn, "SELECT * FROM menu");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Menu</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: url('assets/img/restoran.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 700px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        .btn-hapus {
            background-color: #dc3545;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-hapus:hover {
            background-color: #c82333;
        }

        a.kembali {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #28a745;
            font-weight: bold;
            text-decoration: none;
        }

        a.kembali:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function confirmDelete(nama_menu, link) {
            if (confirm("Yakin ingin menghapus menu \"" + nama_menu + "\"?")) {
                window.location.href = link;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Hapus Menu</h2>
        <table>
            <tr>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
            <?php while ($menu = mysqli_fetch_assoc($menus)) : ?>
            <tr>
                <td><?= htmlspecialchars($menu['nama_menu']) ?></td>
                <td>Rp<?= number_format($menu['harga']) ?></td>
                <td><?= $menu['kategori'] ?></td>
                <td>
                    <button class="btn-hapus" onclick="confirmDelete('<?= $menu['nama_menu'] ?>', 'hapus_menu_proses.php?id=<?= $menu['ID_Menu'] ?>')">Hapus</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="index.php" class="kembali">← Kembali ke Beranda</a>
    </div>
</body>
</html>
