# CRUD Sistem Struk Restoran 🍽️

Aplikasi berbasis web untuk mengelola menu, pesanan, dan mencetak struk transaksi restoran menggunakan **PHP**, **MySQL**, dan **Dompdf**.

---

## 🔧 Teknologi yang Digunakan

- PHP 7+
- MySQL (via XAMPP)
- HTML, CSS (dengan background dan logo)
- JavaScript (untuk tambah-hapus baris pesanan)
- [Dompdf](https://github.com/dompdf/dompdf) – generate PDF

---

## ✨ Fitur Utama

- **🔁 CRUD Menu**: Tambah, edit, dan hapus daftar menu
- **🧾 Input Transaksi**: Form input kasir, pelanggan, dan pesanan
- **📃 Cetak Struk**: Tampilkan hasil transaksi seperti struk belanja
- **⬇️ Download PDF**: Fitur untuk mengunduh struk dalam bentuk file PDF
- **🎨 UI Bersih & Responsif**: Tampilan rapi dengan latar restoran

---

## 🗃️ Struktur Database (Tabel)

- `kasir`
- `pelanggan`
- `menu`
- `transaksi`
- `pesanan`
- `pembayaran`

> File `dapoerkatenjo.sql` tersedia di folder `/database/`

## 🚀 Cara Menjalankan

1. Clone repo ini ke `htdocs`
2. Import file `database/dapoerkatenjo.sql` ke phpMyAdmin
3. Jalankan XAMPP (Apache + MySQL)
4. Akses via browser:  
   `http://localhost/struk_restoran`
5. Untuk export struk ke PDF, pastikan ekstensi PHP `gd` aktif dan Dompdf terpasang

---

## 📌 Catatan Tambahan

- Background dan logo disimpan di `assets/img/`
- Tidak menggunakan framework, cocok untuk latihan PHP native
- Kompatibel dengan XAMPP (Windows)

---

## 👤 Author

> Created by **Muhamad Ar Rasyid Rizki Oktavian**  
> Institut Teknologi Garut – Tugas Besar Basis Data

---

## 📬 License

This project is open-source for educational purposes only.
