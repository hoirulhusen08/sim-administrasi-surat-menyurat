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

<strong>A. Halaman Utama Web</strong>
<p align="center">
  <img src='https://github.com/hoirulhusen08/.github/blob/main/assets/1.%20Home%20Page%20SIM%20Administrasi.PNG' alt="Homepage" width="100%">
</p>

<strong>B. Halaman Administrator</strong>
<p align="center">
  <img src='https://github.com/hoirulhusen08/.github/blob/main/assets/2.%20Halaman%20Admin%20SIM%20Administrasi.PNG' alt="Admin Page" width="100%">
</p>

<strong>C. Halaman Mahasiswa</strong>
<p align="center">
  <img src='https://github.com/hoirulhusen08/.github/blob/main/assets/3.%20Halaman%20Mahasiswa%20SIM%20Administrasi.PNG' alt="Mahasiswa Page" width="100%">
</p>

<strong>D. Halaman Staff FTIK</strong>
<p align="center">
  <img src='https://github.com/hoirulhusen08/.github/blob/main/assets/4.%20Halaman%20Staff%20SIM%20Administrasi.PNG' alt="Staff Page" width="100%">
</p>

<strong>E. Halaman Kepala Kantor</strong>
<p align="center">
  <img src='https://github.com/hoirulhusen08/.github/blob/main/assets/5.%20Halaman%20Kepala%20SIM%20Administrasi.PNG' alt="Kepala Page" width="100%">
</p>

<strong>F. Halaman Wakil Dekan</strong>
<p align="center">
  <img src='https://github.com/hoirulhusen08/.github/blob/main/assets/6.%20Halaman%20Wakil%20Dekan%20SIM%20Administrasi.PNG' alt="Wakil Dekan Page" width="100%">
</p>

<strong>G. Halaman Dekan</strong>
<p align="center">
  <img src='https://github.com/hoirulhusen08/.github/blob/main/assets/7.%20Halaman%20Dekan%20SIM%20Administrasi.PNG' alt="Dekan Page" width="100%">
</p>

<strong>H. Halaman Dosen</strong>
<p align="center">
  <img src='https://github.com/hoirulhusen08/.github/blob/main/assets/8.%20Halaman%20Dosen%20SIM%20Administrasi.PNG' alt="Dosen Page" width="100%">
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

