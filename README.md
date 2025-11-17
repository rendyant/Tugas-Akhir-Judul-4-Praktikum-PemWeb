# 🚀 Simple Contact Manager (PHP + Tailwind)

Aplikasi manajemen kontak sederhana menggunakan **PHP murni** dan **session** tanpa database.  
Dibuat untuk latihan dasar CRUD, validasi form, dan pengelolaan data dalam sesi.  
Tampilan dibuat menggunakan **Tailwind CSS**.

---

## 📁 Struktur Proyek

| File         | Deskripsi                                                                 |
|--------------|---------------------------------------------------------------------------|
| `index.php`  | Halaman utama yang menampilkan daftar kontak. Ada aksi Tambah, Edit, Hapus. |
| `add.php`    | Form untuk menambah kontak baru. Terdapat validasi nama, email, telepon, kota. |
| `edit.php`   | Form untuk mengedit kontak berdasarkan ID yang dikirim melalui URL.        |
| `delete.php` | Menghapus kontak berdasarkan ID (POST), lalu redirect ke halaman utama.    |

---

## ✨ Fitur Utama
- CRUD lengkap: **Create, Read, Update, Delete**
- Penyimpanan **tanpa database**, hanya menggunakan `$_SESSION`
- Validasi input dasar (nama, email, nomor telepon, kota)

---