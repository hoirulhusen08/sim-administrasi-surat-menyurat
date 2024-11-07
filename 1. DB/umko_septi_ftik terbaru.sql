-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Nov 2024 pada 09.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umko_septi_ftik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip_surat`
--

CREATE TABLE `arsip_surat` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_arsip` varchar(30) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `judul_surat` varchar(250) NOT NULL,
  `no_surat` varchar(150) NOT NULL,
  `file` varchar(256) NOT NULL,
  `ringkasan_surat` text NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `arsip_surat`
--

INSERT INTO `arsip_surat` (`id`, `id_user`, `kode_arsip`, `jenis_surat`, `judul_surat`, `no_surat`, `file`, `ringkasan_surat`, `date_created`) VALUES
(1, 0, '', 'Surat Masuk', 'Kerjasama Bersama Dinas Pendidikan', 'SM/2024/004', '1051-Article_Text-7745-2-10-20240301.pdf', 'Ini adalah isi dari ringkasan surat pra penelitian', 1701139464),
(4, 0, '', 'Surat Masuk', 'Kerjasama Bersama Kemdikbud', 'SM/2024/005', 'Sistematika_Penulisan_Proposal_Skripsi2.pdf', 'Ini adalah ringkasan isi surat', 1721139924),
(5, 0, '', 'Surat Keluar', 'Surat Keterangan Kuliah', '17/KET/II.3.AU/FTIK/F/2024', 'Proposal_Gilang.pdf', 'Ini adalah surat keluar', 1721143342),
(7, 0, '', 'Surat Masuk', 'Surat Pembimbing Akademik', '18/KET/II.3.AU/FTIK/F/2024', 'Sistematika_Penulisan_Proposal_Skripsi1.pdf', 'g iugi iy87 87', 1721144817);

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi_surat`
--

CREATE TABLE `disposisi_surat` (
  `id` int(11) NOT NULL,
  `kode_disposisi` varchar(50) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `departemen` varchar(256) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `tindakan` varchar(256) NOT NULL,
  `catatan` text NOT NULL,
  `batas_waktu` date NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` int(11) NOT NULL,
  `kode_jenis_surat` varchar(10) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `sifat_surat` varchar(20) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `template` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `kode_jenis_surat`, `jenis`, `sifat_surat`, `kategori`, `template`) VALUES
(1, 'KET', 'KET. (Surat Keterangan)', 'Biasa', 'Mahasiswa', '<p>Dekan Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi Lampung&nbsp;menerangkan bahwa:</p>  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\"> 	<tbody> 		<tr> 			<td>Nama</td> 			<td>:</td> 			<td id=\"idNamaMhs\">&nbsp;..............................................................................</td> 		</tr> 		<tr> 			<td>NPM</td> 			<td>:</td> 			<td id=\"idNpmMhs\">&nbsp;..............................................................................</td> 		</tr> 		<tr> 			<td>Tempat, Tgl. Lahir</td> 			<td>:</td> 			<td id=\"idTglLahirMhs\">&nbsp;..............................................................................</td> 		</tr> 		<tr> 			<td>Alamat</td> 			<td>:</td> 			<td id=\"idAlamatMhs\">&nbsp;..............................................................................</td> 		</tr> 	</tbody> </table>  <p>Adalah benar yang bersangkutan saat ini tercatat sebagai mahasiswa pada semester 1 (satu) Tahun Akadem&icirc;k 2023/2024 Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi.</p>  <p>Demikian Surat Keterangan ini dibuat untuk dapat dipergunakan sesuai keperluan, jika terdapat kekeliruan akan diperbaiki sebagaimana mestinya.</p>'),
(2, 'KEP', 'KEP. (Surat Keputusan Penunjuk Sebagai Pembimbing Skripsi)', 'Penting', 'Dosen', '<p><strong>DEKAN FAKULTAS TEKNIK DAN ILMU KOMPUTER UNIVERSITAS MUHAMMADIYAH KOTABUMI,</strong></p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Menimbang</td>\n			<td>:</td>\n			<td>\n			<ol>\n				<li>&nbsp;Bahwa penyusunan dan penulisan skripsi pada Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi perlu diselenggarakan dengan terarah dan terpadu serta memenuhi persyaratan ilmiah;</li>\n				<li>Bahwa untuk itu diperlukan proses akademis yang akuntantabel, transparan dan bermoral;</li>\n				<li>Bahwa proses sebagaimana dimaksut pada huruf 2 diatas diperlukan pembimbing yang ditetapkan dengan suatu keputusan dekan.</li>\n			</ol>\n			</td>\n		</tr>\n		<tr>\n			<td>Mengingat</td>\n			<td>:</td>\n			<td>\n			<ol>\n				<li>&nbsp;Undang-Undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional;</li>\n				<li>Undang-Undang Nomor 12 Tahun 2012 tentang Pendidikan Tinggi;</li>\n				<li>Peraturan Pemerintah Nomor 19 Tahun 2005 tentang Standar Nasional Pendidikan, Jo Peraturan Pemeilntah Nomor 32 Tahun 2013 Tentang perubahan Kedua Atas Peraturan Pemerinhh Nomor 19 Tahun 2015 Tentang Standar Nasional Pendidikan;</li>\n				<li>Peraturan pemerintah Nomor 04 Tahun 2015 tentang Penyelenggaraan Pendidikan Tinggi dan Pengelolaan Perguruan Tinggi;</li>\n				<li>Surat keputusan BAN-PT kemendiknas RI Nomor&nbsp;564/SK/BAN-PT/Akred/PT/VI/2015 tentang akreditasi institusi;</li>\n				<li>Surat keputusan BAN-PT kemendiknas RI Nomor 1537/SK/BAN-PT/Ak/S/IV/2023 tanggal 23 April 2023 tentang akreditasi program studi;</li>\n				<li>Surat Keputusan Menristekdikti No. 477/KPT/1/2019 tanggal 17 Juni 2019, tentang Izin Penggabungan Sekolah Tinggi Keguruan dan Ilmu Pendidikan Muhammadiyah Kotabumi di Kabupaten Lampung Utara dan Sekolah Tinggi Ilmu Hukum Muhammadiyah Kotabumi di Kabupaten Lampung Utara menjadi Universitas Muhammadiyah Kotabumi di Kabupaten Lampung Utara Provinsi Lampung yang diselenggarakan persyarikatan Muhammadiyah;</li>\n				<li>Pedoman Pimpinan Pusat Muhammadiyah nomor 02/PEDD/I.0/B/2012 tentang pergurugan tinggi Muhammadiyah;</li>\n				<li>Ketentuan Majelis Pendidikan Tinggi Pimpinan Pusat Muhammadiyah nomor 178/KET/I.3/D/2012 tentang penjabaran pedoman pimpinan pusat Muhammadiyah nomor 02/PED/I.0/B/2012 tanggal 24 Jumadil Awal 1433 H / 16 April 2012 M tentang perguruan tinggi Muhammadiyah;</li>\n				<li>Surat keputusan Rektor Universitas Muhammadiyah Kotabumi nomor 941/KEP/II.3/AU/D/2023 tentang penetapan Dekan Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi.</li>\n			</ol>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p style=\"text-align: center;\">&nbsp;</p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Memperhatikan&nbsp;</td>\n			<td>:</td>\n			<td>\n			<ol>\n				<li>Pedoman penulisan karya tulis ilmiah Universitas Muhammadiyah Kotabumi untuk penulisan makalah, Laporan BAB, Laporan Buku, Artikel, Skripsi, Proposal Penelitian dan Laporan Penelitian.</li>\n				<li>Surat Keputusan Rektor Universitas Muhammadiyah Kotabumi nomor 106/KEP/II.3.AU/F/2019 tentang plagiarisme dilingkungan Universitas Muhammadiyah Kotabumi.</li>\n			</ol>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p style=\"text-align: center;\"><strong>MEMUTUSKAN</strong></p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Menetapkan</td>\n			<td>:</td>\n			<td>&nbsp;</td>\n		</tr>\n		<tr>\n			<td>PERTAMA</td>\n			<td>:</td>\n			<td>...........................................................................................................................................................................................................................</td>\n		</tr>\n		<tr>\n			<td>KEDUA</td>\n			<td>:</td>\n			<td>Kepada nama tersebut diberikan honorarium sesuai dengan pedoman keuangan yang berlaku dilingkungan Universitas Muhammadiyah Kotabumi.</td>\n		</tr>\n		<tr>\n			<td>KETIGA</td>\n			<td>:</td>\n			<td>Surat keputusan ini berlaku sejak ditetapkan.</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n'),
(3, 'IZN-PRA', 'IZN. (Surat Izin Pra-Penelitian)', 'Biasa', 'Mahasiswa', '<p>Dekan Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi dengan ini mengharapkan bantuan saudara agar mahasiswa kami tersebut dibawah:</p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Nama</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................................</td>\n		</tr>\n		<tr>\n			<td>NPM</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................................</td>\n		</tr>\n		<tr>\n			<td>Semester</td>\n			<td>:</td>\n			<td>&nbsp;8 (Delapan)</td>\n		</tr>\n		<tr>\n			<td>Alamat</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................................</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>Dapat diberikan izin untuk melakukan Pra-Penelitian di .................................................... selama 1 (satu) minggu dalam rangka penyusunan/penulisan Skripsi yang berjudul:</p>\n\n<p>&quot;................................................................................................................................................................................................................................................................................&quot;</p>\n\n<p>Sebagai salah satu syarat untuk menyelesaikan studinya pada Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi Lampung.</p>\n\n<p>Demikian atas perhatian dan bantuan saudara diucapkan terimakasih.</p>\n\n<p><em>Billahi Fii Sabililhaq Fastabiqul Khoirot</em></p>\n'),
(4, 'IZN-PEN', 'IZN. (Surat Izin Penelitian)', 'Biasa', 'Mahasiswa', '<p>Dekan Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi, dengan ini mengharapkan banhan saudara agar mahasiswa kami tersebut dibawah ini:</p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Nama</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................</td>\n		</tr>\n		<tr>\n			<td>NPM</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................</td>\n		</tr>\n		<tr>\n			<td>Semester</td>\n			<td>:</td>\n			<td>&nbsp;8 (Delapan)</td>\n		</tr>\n		<tr>\n			<td>Alamat</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>Dapat diberikan izin untuk mengadakan Penelitian di .................................................... selama 2 (Dua) Minggu dalam rangka penyusunan/penulisan Skripsi yang berjudul:</p>\n\n<p>&quot;.............................................................................................................................................................................................................................................................................&quot;</p>\n\n<p>Sebagai salah satu syarat untuk menyelesaikan studinya pada Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi Lampung.</p>\n\n<p>Demikian atas perhatian dan bantuan Saudara diucapkan terimakasih.</p>\n\n<p><em>Billahi Fii Sabililhaq Fastabiqul Khoirot</em></p>\n'),
(5, 'KEP-PMBNG', 'KEP. (Pengajuan Surat Keputusan Judul Tugas Akhir)', 'Penting', 'Mahasiswa', ''),
(6, 'KEP-PMBHS', 'KEP. (Surat Keputusan Penunjukan Sebagai Pembahas SEMHAS)', 'Penting', 'Dosen', ''),
(7, 'KEP-MATKUL', 'KEP. (Surat Keputusan Dosen Penanggung Jawab dan Pengampu Mata Kuliah)', 'Penting', 'Dosen', '<p><strong>DEKAN FAKULTAS TEKNIK DAN ILMU KOMPUTER UNIVERSITAS MUHAMMADIYAH KOTABUMI</strong></p>  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\"> 	<tbody> 		<tr> 			<td>Menimbang</td> 			<td>:</td> 			<td> 			<ol> 				<li>bahwa untuk kelancaran kegiatan Perftuliahan di Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi pada semester GaniilTahun Akademik 2021/2022, perlu ditetapkan Dosen Penanggung Jaumb dan Pengampu mata kuliah;</li> 				<li>bahwa nama-nama dosen yang namanya tersebut dalam lampiran surat keputusan ini dipandang telah memenuhi persyaratan untuk mengajar sesuai bidang keahliannya;</li> 				<li>bahwa berdasarkan pertimbangan sebagaimana dimaksut pada angka 1 dan angka 2 perlu di terbitkan surat Keputusan Dekan tentang dosen penanggung Jawab dan Pengampu mata kuliah Semester Ganjil Tahun Akademik 2021/2022;</li> 			</ol> 			</td> 		</tr> 		<tr> 			<td>Mengingat</td> 			<td>:</td> 			<td> 			<ol> 				<li>Undang-Undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional;</li> 				<li>Undang-Undang Nomor 12 Tahun 2012 tentang Pendidikan Tinggi;</li> 				<li>Peraturan Pemerintah Nomor 19 Tahun 2005 tentang Standar Nasional Pendidikan, Jo Peraturan Pemeilntah Nomor 32 Tahun 2013 Tentang perubahan Kedua Atas Peraturan Pemerinhh Nomor 19 Tahun 2015 Tentang Standar Nasional Pendidikan;</li> 				<li>Peraturan Pemedntah Nomor 04 Tahun 2015 tentang Penyelenggaraan Pendidikan Tinggi dan Pengelolaan Perguruan Tinggi;</li> 				<li>Peraturan Menteri Riset, Teknologi, dan Pendidikan Tinggi Nomor rt4 Tahun 2015 Tentang $tandar Nasional Pendidikan Tinggi;</li> 				<li>Keputusan Menteri Riset, Teknotogi, dan Pendidikan Tinggi Nomor 447/KPT/l/2019, Tanggal 17 Juni 2019 Tentang lzin Penggabungan Sekolah Tinggi Keguruan dan llmu Pendidikan Muhammadiyah Kotabumi di Lampung Utara dan Sekolah Tinggi llmu Hukum Muhammadiyah Kotabumi di Kabupaten Lampung Utara menjadi Universitas Muhammadiyah Kotabumi di Kabupaten Lampung Utara yang diselenggarakan Persyarikatan Muhammadiyah;</li> 				<li>Pedoman Pimpinan Pusat Muhammadiyah Nomor 02/PED/I.0/B/ 2012 tentang Perguruan Tinggi Muhammadiyah;</li> 				<li>Ketentuan Majelis Pendidikan Tinggi, Penelitian, dan Pengembangan Pimpinan Pusat Muhammadiyah, Nomor 178/KET/I.3/2012, Tentang Penjabaran Pedoman Pimpinan Pusat Muhammadiyah, Nomor 02/PED/I.0/B/ 2012, Tentang Perguruan Tinggi Muhammadiyah;</li> 				<li>Surat Keputusan Pimpinan Pusat Muhammadiyah Nomor 207/KEP/l.0/D/2019 tanggal 09 Dzulqo&#39;idah 1440/2012 Juli 2019, Tentang Pengangkatan Rektor Universitas Muhammadiyah Kotabumi Masa Jabatan 2019-2023;</li> 				<li>Stafuta Universitas Muhammadiyah Kotabumi;</li> 				<li>Surat Keputusan Rektor Universitas Muhammadiyah Kotabumi Nomor 119/KEP/ll.3.AU/D/2019 Tentang Penetapan Dekan Fakultas Teknik Dan llmu Komputer Universitas Muhammadiyah Kotabumi.</li> 			</ol> 			</td> 		</tr> 	</tbody> </table>  <p style=\"text-align: center;\"><strong>MEMUTUSKAN</strong></p>  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\"> 	<tbody> 		<tr> 			<td>Menetapkan</td> 			<td>:</td> 			<td>&nbsp;</td> 		</tr> 		<tr> 			<td>PERTAMA</td> 			<td>:</td> 			<td>&nbsp;Menugaskan nama-nama yang terdapat pada lampiran Surat Keputusan ini sebagai dosen pengampu mata kuliah semester Ganjil Tahun Akademik 2021/2022.</td> 		</tr> 		<tr> 			<td>KEDUA</td> 			<td>:</td> 			<td>&nbsp;Kepadanya wajib melaksanakan tugas sesuai dengan penaturan yang berlaku dosen pada Universitas Muhammadiyah Kotabumi.</td> 		</tr> 		<tr> 			<td>KETIGA</td> 			<td>:</td> 			<td>&nbsp;Segala biaya yang berkaitan dengan Surat Keputusan ini dibebankan kepada Universitas Muhammadiyah Kotabumi.</td> 		</tr> 		<tr> 			<td>KEEMPAT</td> 			<td>:</td> 			<td>&nbsp;Surat Keputusan ini berlaku seiak ditetapkan, dengan ketentuan apabila dikemudian hari temyata terdapt kekeliruan dalam Keputusan ini, maka akan diperbaiki sebagaimana mestinya.</td> 		</tr> 	</tbody> </table>  <p>&nbsp;</p>'),
(8, 'KEP-UJK', 'KEP. (Surat Keputusan Panitia dan Pengawas Ujian Akhir)', 'Penting', 'Dosen', '<p><strong><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">DEKAN FAKULTAS TEKNIK DAN ILMU KOMPUTER UNIVERSITAS MUHAMMADIYAH KOTABUMI</span></span></span></strong></p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Menimbang</td>\n			<td>:</td>\n			<td>\n			<ol>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">bahwa dalam rangka kegiatan ujian akhir semester, Dekan Fakultas panita ujian akhir&nbsp;semester guna mempersiapkan dan melaksanakan kegiatan tersebut.</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">bahwa berdasarkan pada poin 1 di atas, maka perlu di buat surat keputusan Dekan.</span></span></span></li>\n			</ol>\n			</td>\n		</tr>\n		<tr>\n			<td>Mengingat</td>\n			<td>:</td>\n			<td>\n			<ol>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Undang-Undang RI. No. 20, Tahun 2003, tentang Sistem Pendidikan Nasional;</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Undang-Undang&nbsp; No. 14, Tahun 2005, tentang Guru dan Dosen;</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Undang-Undang No. 12, Tahun 2012, tentang&nbsp; Pendidikan Tinggi;</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Pedoman Pimpinan Pusat Muhammadiyah Nomor : 02/PED/1.0/B/2012, Tentang Perguruan Tinggi Muhammadiyah;</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Statuta Universitas Muhammadiyah Kotabumi;</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Surat Keputusan Rektor Universitas Muhammadiyah Kotabumi Nomor 941/KEP/II.3.AU/D/2023 Tentang Penetapan Dekan Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi.</span></span></span></li>\n			</ol>\n			</td>\n		</tr>\n		<tr>\n			<td>Memperhatikan</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Edaran Rektor Nomor 1034/MLM/II.3.AU/F/2023 Tentang Ketentuan Pelaksanaan Ujian Akhir Semester Ganjil Universitas Muhammadiyah Kotabumi.</span></span></span></p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p style=\"text-align: center;\"><strong>MEMUTUSKAN</strong></p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Menetapkan</td>\n			<td>:</td>\n			<td>&nbsp;</td>\n		</tr>\n		<tr>\n			<td>PERTAMA</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Menugasi nama-nama yang tercantum pada lampiran 1 sebagai Panitia Ujian Akhir Semester Ganjil Tahun Akademik 2023/2024.</span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>KEDUA</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Menugasi nama-nama yang tercantum pada lampiran 2 sebagai Pengawas Ujian Akhir Semester Ganjil Tahun Akademik 2023/2024.</span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>KETIGA</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Panita dan Pengawas diberikan insentif sesuai dengan ketentuan yang berlaku di Universitas Muhammadiyah Kotabumi.</span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>KEEMPAT</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Surat Keputusan ini diberikan kepada yang bersangkutan sesuai pada lampiran.</span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>KELIMA</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Surat Keputusan ini berlaku sejak tanggal ditetapkan dan apabila terdapat kekeliruan dalam penetapan ini akan diperbaiki sebagaimana mestinya.</span></span></span></p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n'),
(9, 'URD', 'URD. (Surat Undangan Rapat Dosen)', 'Biasa', 'Dosen', '<p>Ba&rsquo;da salam semoga Allah SWT, senantiasa melimpahkan Rahmat dan Hidayah-Nya kepada kita dalam melaksanakan tugas sehari-hari. Amiin.</p>\n\n<p>Sehubungan dengan .................................................................... T.A .................................................. Prodi Sistem dan Teknologi Informasi Fakultas Teknik dan Ilmu Komputer maka, dengan ini kami mengundang Bapak/Ibu untuk hadir pada :</p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">\n	<tbody>\n		<tr>\n			<td>Hari</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n		<tr>\n			<td>Tanggal</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n		<tr>\n			<td>Pukul</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n		<tr>\n			<td>Tempat</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>Demikian undangan kami sampaikan, atas perhatian dan kehadirannya diucapkan terimakasih.</p>\n'),
(10, 'PPG', 'PPG. (Surat Permohonan Peminjaman Gedung)', 'Biasa', 'Dosen', '<p>Ba&rsquo;da salam semoga Allah SWT, senantiasa melimpahkan Rahmat dan Hidayah-Nya kepada kita dalam melaksanakan tugas sehari-hari. Amiin.</p>\n\n<p>Sehubungan akan diadakan Seminar Proposal dan Seminar Hasil pada Prodi Sistem dan Teknologi Informasi Fakultas Teknik dan Ilmu Komputer yang akan dibagi menjadi dua ruangan yaitu Ruang Kelas FTIK dan Ruang Rapat Gedung C Universitas Muhammadiyah Kotabumi, yang akan dilaksanakan pada :</p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">\n	<tbody>\n		<tr>\n			<td>Hari</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n		<tr>\n			<td>Tanggal</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n		<tr>\n			<td>Pukul</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>Maka dengan ini kami mohon Peminjaman Gedung tersebut.</p>\n\n<p>Demikian permohonan ini kami sampaikan, atas perhatian&nbsp;kami ucapkan terimakasih.</p>\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `klasifikasi_surat`
--

CREATE TABLE `klasifikasi_surat` (
  `id` int(11) NOT NULL,
  `kode_klasifikasi` varchar(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `uraian` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `klasifikasi_surat`
--

INSERT INTO `klasifikasi_surat` (`id`, `kode_klasifikasi`, `nama`, `uraian`) VALUES
(1, 'SR1', 'Biasa', 'Untuk surat dengan jenis biasa'),
(2, 'SR2', 'Penting', 'Untuk surat dengan jenis penting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_pengajuan` varchar(100) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `berkas_pendukung` varchar(256) NOT NULL,
  `sifat` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `dilihat` int(11) NOT NULL,
  `catatan_penolakan` varchar(256) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `web_title` varchar(50) NOT NULL,
  `tagline` varchar(100) NOT NULL,
  `caption` varchar(150) NOT NULL,
  `info_web_p1` text NOT NULL,
  `info_web_p2` text NOT NULL,
  `footer` varchar(30) NOT NULL,
  `image_workflow` varchar(60) NOT NULL,
  `institution_name` varchar(50) NOT NULL,
  `lead_name` varchar(50) NOT NULL,
  `nktam` varchar(20) NOT NULL,
  `faculty_name` varchar(50) NOT NULL,
  `prodi_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `url_maps` text NOT NULL,
  `web` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telp_or_fax` varchar(30) NOT NULL,
  `whatsapp` varchar(15) NOT NULL,
  `logo` varchar(60) NOT NULL,
  `alamat_ttd` varchar(100) NOT NULL,
  `ttd_image` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id`, `id_user`, `web_title`, `tagline`, `caption`, `info_web_p1`, `info_web_p2`, `footer`, `image_workflow`, `institution_name`, `lead_name`, `nktam`, `faculty_name`, `prodi_name`, `address`, `url_maps`, `web`, `email`, `telp_or_fax`, `whatsapp`, `logo`, `alamat_ttd`, `ttd_image`) VALUES
(1, 0, 'FTIK Administrasi', 'Layanan Administrasi', 'Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi.', 'Website ini adalah portal yang memberikan Layanan Administrasi Surat Menyurat pada Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiah Kotabumi, Website ini bisa dimanfaatkan oleh Mahasiswa untuk mengajukan permohonan surat terkait kebutuhan mahasiswa.', 'Dengan adanya Website ini diharapkan dapat membuat proses Layanan Administrasi Surat Menyurat pada Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiah Kotabumi menjadi lebih Efektif dan Efisien bagi Mahasiswa maupun para Dosen, dengan mengedepankan kemudahan.', 'FTIK Administrasi UMKO', 'workflow.png', 'Universitas Muhammadiyah Kotabumi', 'Khusnul Khotimah, S.Kom., M.T.I', '1093733', 'Fakultas Teknik dan Ilmu Komputer', 'Sistem dan Teknologi Informasi', 'Jln. Hasan Kepala Ratu No. 1052 Sindangsari, Kotabumi Lampung Utara, Provinsi Lampung, 34517', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.7532329019077!2d104.86999567407784!3d-4.812380449644992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e38a8cb47225a21%3A0xd2e026f22c44746f!2sUniversitas%20Muhammadiyah%20Kotabumi!5e0!3m2!1sid!2sid!4v1713711586785!5m2!1sid!2sid', 'https://ftik.umko.ac.id', 'ftk@umko.ac.id', '(0724) 22287', '6289624618789', 'logo-umko-min.png', 'Kotabumi', 'ttd1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `id_klasifikasi` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tentang_surat` varchar(256) NOT NULL,
  `id_tujuan_dosen` int(11) NOT NULL,
  `nama_mahasiswa` varchar(60) NOT NULL,
  `npm` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `tahun_akademik` varchar(25) DEFAULT NULL,
  `nomor_surat` varchar(150) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `alamat_tujuan` text NOT NULL,
  `penerima_surat` varchar(50) NOT NULL,
  `perihal` varchar(50) NOT NULL,
  `lampiran` varchar(50) NOT NULL,
  `isi_surat` longtext NOT NULL,
  `catatan_kaki` text NOT NULL,
  `isi_lampiran` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `tindak_lanjut` text NOT NULL,
  `catatan` text NOT NULL,
  `ttd` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `id_klasifikasi` int(11) NOT NULL,
  `nomor_surat` varchar(100) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `sumber_surat` varchar(150) NOT NULL,
  `perihal` varchar(50) NOT NULL,
  `isi_surat` longtext NOT NULL,
  `lampiran` varchar(50) NOT NULL,
  `penerima_surat` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `tindak_lanjut` text NOT NULL,
  `catatan` text NOT NULL,
  `file_surat_masuk` varchar(50) NOT NULL,
  `ttd` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `jenis_surat`, `id_klasifikasi`, `nomor_surat`, `tanggal_surat`, `sumber_surat`, `perihal`, `isi_surat`, `lampiran`, `penerima_surat`, `status`, `tindak_lanjut`, `catatan`, `file_surat_masuk`, `ttd`, `date_created`) VALUES
(4, 'Surat Masuk', 1, 'SM/2024/003', '2024-04-14', 'Yayasan Tunas Pertiwi', 'Undangan Rapat', '<h2 style=\"text-align: center;\"><strong>RINGKASAN SURAT MASUK</strong></h2>\r\n\r\n<p>Ini adalah ringkasan surat yand didapat dari <span style=\"background-color:#f1c40f;\">Yayasan Tunas Pertiwi</span> tentang Undangan Rapat yang akan dilaksanakan minggu depan, surat ini bersifat Tembusan dan tidak wajib dihadiri oleh kita. hal yang mungkin perlu dipersiapkan :</p>\r\n\r\n<ol>\r\n	<li>Ruangan Aula</li>\r\n	<li>Budget untuk membeli jamuan</li>\r\n	<li>Persiapan musyawarah bersama</li>\r\n</ol>\r\n\r\n<p>Sekian paparan dari ringakasan surat ini, semoga bisa menjadi gambaran bagi pembaca, terimakasih</p>', '3 Lampiran', 'M. Alba Syaputra', 5, 'Oke surat telah saya cek kembali, dan hasilnya sudah sesuai, saya terima dan akan diteruskan ke dekan untuk meminta TTD', 'Persiapkan bahas materi untuk presentasi pada acara ini', 'Data2.pdf', 1, 1713116756),
(5, 'Surat Masuk', 1, 'SM/2024/004', '2024-04-15', 'STMIK Surya Intan', 'Rapat bersama terkait Lebaran', '<p>Ini adalah surat yang sangat rahasia, jadi tidak boleh diketahui oleh khalayak umum, mohon jaga kerahasiaan surat ini bersama</p>', '2 Lampiran', 'Khoirul Husen', 5, 'Oke surat saya ACC, akan saya lanjutkan untuk meminta TTD', 'Siapkan slide simpel saja, karena ini acara rahasia jadi tidak banyak yang datang', 'Data1.pdf', 1, 1713119127),
(11, 'Surat Masuk', 1, 'SDF/FJLAK/2009', '2024-07-09', 'Dinas Pendidikan', 'Kerjasama', '<p>sdfaf</p>', '2 Lampiran', 'Suhartono', 0, '', '', 'CONTOH_SURAT_ARSIPAN.pdf', 0, 1720405805),
(12, 'Surat Masuk', 2, 'SM/2024/006', '2024-07-16', 'ITBA-DCC', 'Kerjasama antar kampus', '<p>Ini adalah isi ringkasan dari surat masuk yang ada</p>', '2 Lampiran', 'Septiana Sari', 4, 'Oke saya ACC tanda tangan', 'Persiapkan semua kebutuhan untuk agenda ini', 'Sistematika_Penulisan_Proposal_Skripsi.pdf', 1, 1721177473);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(50) NOT NULL,
  `name` varchar(25) NOT NULL,
  `judul_mhs` varchar(100) NOT NULL,
  `npm_nbm` varchar(20) NOT NULL,
  `tgl_lahir` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telp` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `kode_user`, `name`, `judul_mhs`, `npm_nbm`, `tgl_lahir`, `alamat`, `email`, `telp`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(2, 'ID12024011', 'Septiana Sari', 'Sistem Informasi Administrasi Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi', '2059201033', 'Kotabumi, 9 September 1999', 'Jl. Raya Prokimal, Sukajadi Madukoro Baru, RT/RW 001/001 No. 04 Kotabumi Lampung Utara', 'mahasiswa@gmail.com', 0, 'default.jpg', '$2y$10$EYHL90J3KjMLmTa1Jt6uLuoZfjaBc3TCVpnjumYpfw1B51dpDddvG', 2, 1, 1712589882),
(3, 'ID12024012', 'Staff FTIK', '', '12345678', 'Kotabumi, 26 Agustus 1994', 'Jl. Hasan Kepala Ratu No.1052, Sindang Sari, Kec. Kotabumi, Kabupaten Lampung Utara, Lampung 34517', 'staff@gmail.com', 0, 'default.jpg', '$2y$10$EBQGemIClvXFCYbDhr/MLus6Ia8WFsXuL8Vg339fKkvwJ.C1/rKLa', 3, 1, 1712590051),
(4, 'ID12024013', 'Kepala Kantor', '', '', '', '', 'kepala@gmail.com', 0, 'default.jpg', '$2y$10$EJyLnHv8EceVwL0embnjrufnSFGLAJA366POUyxnC2COzyrubWPPm', 4, 1, 1712590083),
(5, 'ID12024014', 'Wakil Dekan', '', '', '', '', 'wakildekan@gmail.com', 0, 'default.jpg', '$2y$10$8feGSkVy5sinFx78k9zgwONIOEXrsQfQqlfX/x6fLv/LT5B.ZI/5W', 5, 1, 1712590105),
(6, 'ID12024015', 'Dekan', '', '', '', '', 'dekan@gmail.com', 0, 'default.jpg', '$2y$10$vnAGEYQlCBP12KEPAoDeDOgUCFfITYAo3FHospYUc3nIpwjoDq9AG', 6, 1, 1712590119),
(7, 'ID12024016', 'Dosen 1', '', '', '', '', 'dosen@gmail.com', 0, 'default.jpg', '$2y$10$3oDJn62KjFRQ5zL/GWRaBu5dA/qmE.6Wyvj6IahRPCa7Rx/ZkYjju', 7, 1, 1712590138),
(8, 'ID12024017', 'Administrator', '', '', '', '', 'admin@gmail.com', 0, '6481225432795d8cdf48f0f85800cf66.jpg', '$2y$10$F8CpuCu6rbllCPz0Il8f6.IrG1LJ0o3zTZmmo.YtrZy8NehFqZM3y', 1, 1, 1712666172),
(9, 'ID12024018', 'Mahasiswa 2', '', '621901274', 'Prokimal, 28 September 1999', 'Jl. Lintas Sumatera, Sribasuki, Kotabumi Lampung Utara - Indonesia 6321', 'mahasiswa2@gmail.com', 0, 'default.jpg', '$2y$10$A8EHkAty.3KiNnaXggBrUev6Z709uK5TQqAX2EiRqephe76HrOy/.', 2, 1, 1713292224),
(16, 'ID12024019', 'Dosen 2', '', '', '', '', 'dosen2@gmail.com', 0, 'default.jpg', '$2y$10$DxTQLshTxUPd.ixoK5WSrex2U4A4NVkSEvll8Nsqu.aT3E.CnjST.', 7, 1, 1729316854),
(17, 'ID120240116', 'Dosen 3', '', '3242523', 'Kotabumi, 02 Agustus 1989', 'Jl. Sample aj, No. 00 RT/RW 00/00 Kotabumi Lampung Utara', 'dosen3@gmail.com', 0, 'default.jpg', '$2y$10$d8A205vddGhzn2Wx8eE8RecBqcSoN5YBn2LYhdZbhfvI9uESSnEWu', 7, 1, 1729316901),
(18, 'ID120240117', 'Dosen 4', '', '', '', '', 'dosen4@gmail.com', 0, 'default.jpg', '$2y$10$vpVK93WGQkG5/4GnWL3lL.qV5ePruw9s8iBcUUjjv/ls33Am9/wPq', 7, 1, 1729316923);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id` int(11) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Mahasiswa'),
(3, 'Staf FTIK'),
(4, 'Kepala Kantor'),
(5, 'Wakil Dekan'),
(6, 'Dekan'),
(7, 'Dosen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menus`
--

CREATE TABLE `user_access_menus` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_menus`
--

INSERT INTO `user_access_menus` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(14, 1, 2),
(3, 2, 2),
(4, 1, 3),
(16, 5, 7),
(8, 3, 5),
(9, 3, 2),
(10, 4, 2),
(11, 5, 2),
(12, 6, 2),
(13, 7, 2),
(15, 4, 6),
(17, 6, 8),
(18, 7, 9),
(19, 3, 10),
(21, 3, 9),
(22, 5, 11),
(23, 6, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menus`
--

CREATE TABLE `user_menus` (
  `id` int(11) NOT NULL,
  `menu` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_menus`
--

INSERT INTO `user_menus` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(5, 'Staff'),
(6, 'Lead'),
(7, 'WakilDekan'),
(8, 'Dekan'),
(9, 'Dosen'),
(10, 'Submission'),
(11, 'Report');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menus`
--

CREATE TABLE `user_sub_menus` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_sub_menus`
--

INSERT INTO `user_sub_menus` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dasbor', 'admin', 'bi bi-speedometer', 1),
(2, 2, 'Profil Saya', 'user', 'bi bi-person-fill', 1),
(3, 2, 'Ubah Profil', 'user/editUser', 'bi bi-pencil-square', 0),
(4, 3, 'Manajemen Menu', 'menu', 'bi bi-menu-button-fill', 1),
(5, 3, 'Manajemen Submenu', 'menu/submenu', 'bi bi-folder2-open', 1),
(6, 1, 'Peran', 'admin/role', 'bi bi-person-vcard', 1),
(7, 3, 'Coba2', 'coba2/cobacoba', 'cobaaja haha', 0),
(8, 1, 'Asal aja', 'asal', 'asal', 0),
(10, 1, 'Manajemen Pengguna', 'admin/manageAllUser', 'bi bi-people-fill', 1),
(11, 1, 'Pengaturan Web', 'admin/settings', 'bi bi-gear-fill', 1),
(12, 5, 'Surat Masuk', 'staff/incomingMail', 'bi bi-envelope-fill', 1),
(13, 5, 'Surat Keluar', 'staff/outgoingMail', 'bi bi-envelope-paper-fill', 1),
(14, 5, 'Pengarsipan Surat', 'staff/archiveMail', 'bi bi-archive-fill', 1),
(15, 6, 'Validasi Surat Masuk', 'lead/incomingMail', 'bi bi-envelope-fill', 1),
(16, 6, 'Disposisi Surat', 'lead/listDisposisi', 'bi bi-envelope-check-fill', 1),
(17, 6, 'Validasi Surat Keluar', 'lead/outgoingMail', 'bi bi-envelope-paper-fill', 1),
(18, 7, 'ACC Surat Masuk', 'wakildekan/incomingMail', 'bi bi-envelope-fill', 1),
(19, 7, 'ACC Surat Keluar', 'wakildekan/outgoingMail', 'bi bi-envelope-paper-fill', 1),
(20, 8, 'TTD Surat Masuk', 'dekan/incomingMail', 'bi bi-envelope-fill', 1),
(21, 8, 'TTD Surat Keluar', 'dekan/outgoingMail', 'bi bi-envelope-paper-fill', 1),
(22, 9, 'Unduh Surat Masuk', 'dosen/incomingMail', 'bi bi-envelope-fill', 1),
(23, 9, 'Unduh Surat Keluar', 'dosen/outgoingMail', 'bi bi-envelope-paper-fill', 1),
(24, 10, 'Pengajuan Surat', 'submission/listLetter', 'bi bi-envelope-arrow-up-fill', 1),
(25, 6, 'Kelola Laporan', 'lead/manageReport', 'bi bi-journal-text', 1),
(26, 11, 'Lihat Laporan', 'report', 'bi bi-journal-text', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `disposisi_surat`
--
ALTER TABLE `disposisi_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_surat` (`id_surat`);

--
-- Indeks untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `klasifikasi_surat`
--
ALTER TABLE `klasifikasi_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klasifikasi` (`id_klasifikasi`,`id_jenis`,`id_user`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klasifikasi` (`id_klasifikasi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menus`
--
ALTER TABLE `user_access_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`,`menu_id`);

--
-- Indeks untuk tabel `user_menus`
--
ALTER TABLE `user_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menus`
--
ALTER TABLE `user_sub_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `arsip_surat`
--
ALTER TABLE `arsip_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `disposisi_surat`
--
ALTER TABLE `disposisi_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `klasifikasi_surat`
--
ALTER TABLE `klasifikasi_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_access_menus`
--
ALTER TABLE `user_access_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `user_menus`
--
ALTER TABLE `user_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menus`
--
ALTER TABLE `user_sub_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
