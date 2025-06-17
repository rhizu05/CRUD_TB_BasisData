<?php
include 'config.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM menu WHERE ID_Menu = $id");
$menu = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: url('assets/img/restoran.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .form-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 450px;
        }
          form {
            display: flex;
            flex-direction: column; 
            width: 100%;
            box-sizing: border-box;
        }

        form input,
        form select,
        form button {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        } 


        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            margin-top: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #28a745;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #28a745;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Edit Menu</h2>
        <form method="post" action="proses_edit_menu.php">
            <input type="hidden" name="id" value="<?= $menu['ID_Menu'] ?>">
            <label for="nama_menu">Nama Menu</label>
            <input type="text" id="nama_menu" name="nama_menu" value="<?= $menu['nama_menu'] ?>" required>

            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" value="<?= $menu['harga'] ?>" required>

            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Makanan" <?= $menu['kategori'] == 'Makanan' ? 'selected' : '' ?>>Makanan</option>
                <option value="Minuman" <?= $menu['kategori'] == 'Minuman' ? 'selected' : '' ?>>Minuman</option>
                <option value="Lainnya" <?= $menu['kategori'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
            </select>

            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="edit_menu.php">← Kembali ke Daftar</a>
    </div>
</body>
</html>
