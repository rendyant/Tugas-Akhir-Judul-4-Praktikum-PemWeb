# 🚀 Simple Contact Manager (PHP + Tailwind)

---

## 📁 Struktur Proyek

| File         | Deskripsi                                                                 |
|--------------|---------------------------------------------------------------------------|
| `index.php`  | Halaman utama yang menampilkan daftar kontak. Ada aksi Tambah, Edit, Hapus. |
| `add.php`    | Form untuk menambah kontak baru. Terdapat validasi nama, email, telepon, kota. |
| `edit.php`   | Form untuk mengedit kontak.  |
| `delete.php` | Menghapus kontak berdasarkan ID (POST), lalu redirect ke halaman utama.    |

---

## ✨ Fitur Utama
- Penyimpanan **tanpa database**, hanya menggunakan `$_SESSION`
- Validasi input dasar (nama, email, nomor telepon, kota)

---