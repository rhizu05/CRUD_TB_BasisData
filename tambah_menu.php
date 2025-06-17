<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_menu = $_POST['nama_menu'];
    $harga     = $_POST['harga'];
    $kategori  = $_POST['kategori'];

    $query = "INSERT INTO menu (nama_menu, harga, kategori)
              VALUES ('$nama_menu', $harga, '$kategori')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambahkan menu: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Menu</title>
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

        .form-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 450px;
            box-sizing: border-box;
        
            
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
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            box-sizing: border-box;
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
            transition: background 0.2s ease;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 18px;
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
        <h2>Tambah Menu Baru</h2>
        <form method="post" action="" class="form">
            <label for="nama_menu">Nama Menu</label>
            <input type="text" id="nama_menu" name="nama_menu" required>

            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" required>

            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Lainnya">Lainnya</option>
            </select>

            <button type="submit">Simpan Menu</button>
        </form>
        <a href="index.php">← Kembali ke Beranda</a>
    </div>
</body>
</html>
