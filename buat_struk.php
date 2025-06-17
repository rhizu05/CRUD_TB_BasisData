<?php
include 'config.php';

// Ambil semua menu dari database
$menus = [];
$result = mysqli_query($conn, "SELECT * FROM menu");
while ($row = mysqli_fetch_assoc($result)) {
    $menus[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buat Struk</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Style tetap sama seperti sebelumnya */
        body {
            margin: 0;
            padding: 0;
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
           
            
        }
         form {
            display: flex;
            flex-direction: column; 
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 32px;
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
            margin-bottom: 20px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .pesanan-row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .pesanan-row select,
        .pesanan-row input {
            flex: 1;
        }

        .pesanan-row button {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px;
            cursor: pointer;
        }

        .pesanan-row button:hover {
            background: #c82333;
        }

        .add-btn,
        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            margin-top: 10px;
            cursor: pointer;
        }

        .add-btn:hover,
        .submit-btn:hover {
            background-color: #218838;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #28a745;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

    <script>
    const menuData = <?= json_encode($menus) ?>;

    function addRow() {
        const container = document.getElementById("pesanan-container");
        const row = document.createElement("div");
        row.className = "pesanan-row";

        const options = menuData.map(menu =>
            `<option value="${menu.ID_Menu}" data-harga="${menu.harga}">
                ${menu.nama_menu} - Rp${parseInt(menu.harga).toLocaleString()}
            </option>`
        ).join('');

        row.innerHTML = `
            <select name="id_menu[]" onchange="updateHarga(this)" required>
                <option value="">-- Pilih Menu --</option>
                ${options}
            </select>
            <input type="number" name="jumlah[]" placeholder="Jumlah" min="1" required>
            <input type="number" name="harga[]" placeholder="Harga" readonly required>
            <button type="button" onclick="removeRow(this)">-</button>
        `;
        container.appendChild(row);
    }

    function updateHarga(selectEl) {
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');
        const hargaInput = selectEl.parentElement.querySelector('input[name="harga[]"]');
        hargaInput.value = harga;
    }

    function removeRow(button) {
        button.parentElement.remove();
    }
    </script>
</head>
<body>
    <div class="container">
        <h2>Buat Struk Pesanan</h2>
        <form action="proses.php" method="post">
            <input type="text" name="nama_kasir" placeholder="Nama Kasir" required>
            <input type="text" name="nama_pelanggan" placeholder="Nama Pelanggan" required>
            <input type="datetime-local" name="waktu_pesanan" required>

            <div id="pesanan-container">
                <!-- Baris pertama -->
                <div class="pesanan-row">
                    <select name="id_menu[]" onchange="updateHarga(this)" required>
                        <option value="">-- Pilih Menu --</option>
                        <?php foreach ($menus as $menu): ?>
                            <option value="<?= $menu['ID_Menu'] ?>" data-harga="<?= $menu['harga'] ?>">
                                <?= $menu['nama_menu'] ?> - Rp<?= number_format($menu['harga']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="jumlah[]" placeholder="Jumlah" min="1" required>
                    <input type="number" name="harga[]" placeholder="Harga" readonly required>
                    <button type="button" onclick="removeRow(this)">-</button>
                </div>
            </div>

            <button type="button" class="add-btn" onclick="addRow()">+ Tambah Menu</button>
            <button type="submit" class="submit-btn">Simpan & Cetak Struk</button>
        </form>
        <a href="index.php">← Kembali ke Beranda</a>
    </div>
</body>
</html>
