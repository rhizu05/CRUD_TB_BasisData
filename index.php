<!DOCTYPE html>
<html>
<head>
    <title>Beranda - Dapoer Katendjo</title>
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

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            max-width: 500px;
        }

        .container h1 {
            margin-bottom: 30px;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .btn-group a {
            text-decoration: none;
            background-color: #28a745;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-group a:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="assets/img/logo.jpg" alt="Logo Restoran">
        </div>
        <h1>Dapoer Katendjo</h1>

        <div class="btn-group">
            <a href="tambah_menu.php">➕ Tambah Menu</a>
            <a href="hapus_menu.php">🗑 Hapus Menu</a>
            <a href="edit_menu.php">✏️ Edit Menu</a>
            <a href="buat_struk.php">🧾 Buat Struk</a>
        </div>
    </div>
</body>
</html>
