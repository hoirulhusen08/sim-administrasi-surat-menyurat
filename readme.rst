###################
Sistem Informasi Administrasi Surat Menyurat UMKO
###################

Sistem Informasi Administrasi Surat Menyurat ini dibangun dengan Framework [Codeigniter 3](https://www.codeigniter.com/userguide3/). Sistem ini dibuat atas dasar untuk memenuhi kebutuhan Tugas Akhir Mahasiswa (Skripsi) pada Universitas Muhammadiyah Kotabumi (UMKO). Sistem ini memiliki 7 Peran diantaranya :
<ul>
	<li>Administrator</li>
	<li>Mahasiswa</li>
	<li>Staf FTIK</li>
	<li>Kepala Kantor</li>
	<li>Wakil Dekan</li>
	<li>Dekan</li>
	<li>Dosen</li>
</ul>
Selain memiliki peran yang banyak, Sistem ini juga dilengkapi oleh 8 Template Surat untuk kebutuhan pembuatan Surat Keluar.

*******************
Teknologi Yang Digunakan
*******************

Berikut adalah teknologi dibalik Sistem ini :
1. Framework Codeigniter versi 3 (sebagai Kerangka Utama Web)
2. Bootstrap versi 4 (sebagai Framework CSS)
3. CkEditor.js (sebagai WYSIWYG Editor)
4. Datatables (untuk penggunaan Tabel)
5. Jquery (Library JS)
6. Template SB-Admin2 (sebagai Template Dashboard)

**************************
Persiapan Instalasi
**************************

Sebelum melakukan instalasi program ini diwajibkan untuk menyiapkan :
1. Webserver dan MySQL Server (XAMPP, WampServer, Laragon, Mamp, atau yang lainnya)
2. PHP disarankan versi 8.0 - 8.1
3. Composer
4. Git (Optional)

*******************
Proses Instalasi
*******************

1. Aktifkan XAMPP lalu masukan seluruh source code program ke folder htdocs XAMPP
2. Ubah konfigurasi pada file .env diantaranya :
   BASE_URL
   DB_HOSTNAME
   DB_USERNAME
   DB_PASSWORD
   DB_NAME
   Isi nilai pada variabel diatas disesuaikan dengan kasus masing-masing, yang pasti nilai selalu dibungkus tanda petik dua
   contoh : BASE_URL="http://localhost/nama-project-web" dan seterusnya.
3. Ketik perintah "Composer Install" untuk mendownload semua Library yang digunakan.
4. Untuk Login bisa menggunakan akun berikut :
   Admin :
          Email    = admin@gmail.com
          Password = 12345678
   Mahasiswa :
          Email    = mahasiswa@gmail.com
          Password = 12345678
   Staff FTIK :
          Email    = staff@gmail.com
          Password = 12345678
   Kepala Kantor :
          Email    = kepala@gmail.com
          Password = 12345678
   Wakil Dekan :
          Email    = wakildekan@gmail.com
          Password = 12345678
   Dekan :
          Email    = dekan@gmail.com
          Password = 12345678
   Dosen :
          Email    = dosen@gmail.com
          Password = 12345678

************
Pembuat & Lisensi
************

Sistem atau Program ini dibuat oleh @hoirulhusen08 (Khoirul Husen). Source Code ini bersifat Open Source namun ada beberapa aturan yang berlaku diantaranya :
1. Hak Cipta penuh tetap @hoirulhusen08 (Jika disalah gunakan bisa kami komplain).
2. Boleh digunakan dan di Modifikasi asalkan tidak diperjual belikan (Dikomersilkan).
3. Jika menggunakan Source Code ini diharapkan memberikan sumber nama pembuat yaitu : hoirulhusen08.
4. Jika ada hal lain untuk menjaga Hak Cipta bisa hubungi kontak kami : hoirulhusen08@gmail.com

