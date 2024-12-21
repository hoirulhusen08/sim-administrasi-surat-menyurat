###################
Sistem Informasi Administrasi Surat Menyurat UMKO
###################

Sistem Informasi Administrasi Surat Menyurat ini dibangun dengan Framework CodeIgniter 3 <https://codeigniter.com/userguide3>_. Sistem ini dibuat atas dasar untuk memenuhi kebutuhan Tugas Akhir Mahasiswa (Skripsi) pada Universitas Muhammadiyah Kotabumi (UMKO). Sistem ini memiliki 7 Peran di antaranya:

Administrator.

Mahasiswa.

Staf FTIK.

Kepala Kantor.

Wakil Dekan.

Dekan.

Dosen.

Selain memiliki peran yang banyak, sistem ini juga dilengkapi oleh 8 Template Surat untuk kebutuhan pembuatan Surat Keluar.

.. image:: https://github.com/hoirulhusen08/.github/blob/main/assets/1.%20Home%20Page%20SIM%20Administrasi.PNG
:alt: Homepage SIM-Administrasi
:align: center
:width: 100%

Teknologi Yang Digunakan

Berikut adalah teknologi di balik sistem ini:

Framework CodeIgniter versi 3 (sebagai Kerangka Utama Web)

Bootstrap versi 4 (sebagai Framework CSS)

CkEditor.js (sebagai WYSIWYG Editor)

Datatables (untuk penggunaan Tabel)

Jquery (Library JS)

Template SB-Admin2 (sebagai Template Dashboard)

Persiapan Instalasi

Sebelum melakukan instalasi program ini diwajibkan untuk menyiapkan:

Webserver dan MySQL Server (XAMPP, WampServer, Laragon, Mamp, atau yang lainnya)

PHP disarankan versi 8.0 - 8.1

Composer

Git (Optional)

Proses Instalasi

Aktifkan XAMPP lalu masukan seluruh source code program ke folder htdocs XAMPP.

Ubah konfigurasi pada file .env di antaranya:

BASE_URL

DB_HOSTNAME

DB_USERNAME

DB_PASSWORD

DB_NAME

Isi nilai pada variabel di atas disesuaikan dengan kasus masing-masing, yang pasti nilai selalu dibungkus tanda petik dua. Contoh:
BASE_URL="http://localhost/nama-project-web" dan seterusnya.

Ketik perintah Composer Install untuk mendownload semua library yang digunakan.

Untuk Login bisa menggunakan akun berikut:

Admin:

Email: admin@gmail.com

Password: 12345678

Mahasiswa:

Email: mahasiswa@gmail.com

Password: 12345678

Staff FTIK:

Email: staff@gmail.com

Password: 12345678

Kepala Kantor:

Email: kepala@gmail.com

Password: 12345678

Wakil Dekan:

Email: wakildekan@gmail.com

Password: 12345678

Dekan:

Email: dekan@gmail.com

Password: 12345678

Dosen:

Email: dosen@gmail.com

Password: 12345678

Pembuat & Lisensi

Sistem atau program ini dibuat oleh @hoirulhusen08 (Khoirul Husen). Source code ini bersifat Open Source, namun ada beberapa aturan yang berlaku di antaranya:

Hak cipta penuh tetap @hoirulhusen08 (Jika disalahgunakan bisa kami komplain).

Boleh digunakan dan dimodifikasi asalkan tidak diperjualbelikan (dikomersilkan).

Jika menggunakan source code ini, diharapkan memberikan sumber nama pembuat yaitu: hoirulhusen08.

Jika ada hal lain untuk menjaga hak cipta, bisa hubungi kontak kami: hoirulhusen08@gmail.com

