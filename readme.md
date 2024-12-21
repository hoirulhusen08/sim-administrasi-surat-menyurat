# Sistem Informasi Administrasi Surat Menyurat UMKO

Sistem Informasi Administrasi Surat Menyurat ini dibangun dengan Framework <a href="https://codeigniter.com/userguide3" target="_blank">Codeigniter 3</a>. Sistem ini dibuat atas dasar untuk memenuhi kebutuhan Tugas Akhir Mahasiswa (Skripsi) pada Universitas Muhammadiyah Kotabumi (UMKO). Sistem ini memiliki 7 Peran di antaranya:

1. Administrator.
2. Mahasiswa.
3. Staf FTIK.
4. Kepala Kantor.
5. Wakil Dekan.
6. Dekan.
7. Dosen.

Selain memiliki peran yang banyak, sistem ini juga dilengkapi oleh 8 Template Surat untuk kebutuhan pembuatan Surat Keluar.

<label>Halaman Utama Web</label>
<p align="center">
  <img src='https://github.com/My-Introvert/.github/blob/main/profile/HomePage%20My%20Introvert.PNG' alt="This is Logo Image" width="100%">
</p>

## Teknologi Yang Digunakan

Berikut adalah teknologi di balik sistem ini:

1. Framework CodeIgniter versi 3 (sebagai Kerangka Utama Web)
2. Bootstrap versi 4 (sebagai Framework CSS)
3. CkEditor.js (sebagai WYSIWYG Editor)
4. Datatables (untuk penggunaan Tabel)
5. Jquery (Library JS)
6. Template SB-Admin2 (sebagai Template Dashboard)

## Persiapan Instalasi

Sebelum melakukan instalasi program ini diwajibkan untuk menyiapkan:

1. Webserver dan MySQL Server (XAMPP, WampServer, Laragon, Mamp, atau yang lainnya)
2. PHP disarankan versi 8.0 - 8.1
3. Composer
4. Git (Optional)

## Proses Instalasi

1. Aktifkan XAMPP lalu masukan seluruh source code program ke folder `htdocs` XAMPP.

2. Ubah konfigurasi pada file `.env` di antaranya:

   - `BASE_URL`
   - `DB_HOSTNAME`
   - `DB_USERNAME`
   - `DB_PASSWORD`
   - `DB_NAME`

   Isi nilai pada variabel di atas disesuaikan dengan kasus masing-masing, yang pasti nilai selalu dibungkus tanda petik dua. Contoh:
   `BASE_URL="http://localhost/nama-project-web"` dan seterusnya.

3. Ketik perintah `Composer Install` untuk mendownload semua library yang digunakan.

4. Untuk Login bisa menggunakan akun berikut:

   **Admin:**

   - Email: [admin@gmail.com](mailto\:admin@gmail.com)
   - Password: 12345678

   **Mahasiswa:**

   - Email: [mahasiswa@gmail.com](mailto\:mahasiswa@gmail.com)
   - Password: 12345678

   **Staff FTIK:**

   - Email: [staff@gmail.com](mailto\:staff@gmail.com)
   - Password: 12345678

   **Kepala Kantor:**

   - Email: [kepala@gmail.com](mailto\:kepala@gmail.com)
   - Password: 12345678

   **Wakil Dekan:**

   - Email: [wakildekan@gmail.com](mailto\:wakildekan@gmail.com)
   - Password: 12345678

   **Dekan:**

   - Email: [dekan@gmail.com](mailto\:dekan@gmail.com)
   - Password: 12345678

   **Dosen:**

   - Email: [dosen@gmail.com](mailto\:dosen@gmail.com)
   - Password: 12345678

## Pembuat & Lisensi

Sistem atau program ini dibuat oleh **@hoirulhusen08 (Khoirul Husen)**. Source code ini bersifat Open Source, namun ada beberapa aturan yang berlaku di antaranya:

1. Hak cipta penuh tetap **@hoirulhusen08** (Jika disalahgunakan bisa kami komplain).
2. Boleh digunakan dan dimodifikasi asalkan tidak diperjualbelikan (dikomersilkan).
3. Jika menggunakan source code ini, diharapkan memberikan sumber nama pembuat yaitu: **hoirulhusen08**.
4. Jika ada hal lain untuk menjaga hak cipta, bisa hubungi kontak kami: [hoirulhusen08@gmail.com](mailto\:hoirulhusen08@gmail.com)

