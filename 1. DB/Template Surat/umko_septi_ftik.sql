-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Sep 2024 pada 12.42
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

INSERT INTO `arsip_surat` (`id`, `jenis_surat`, `judul_surat`, `no_surat`, `file`, `ringkasan_surat`, `date_created`) VALUES
(1, 'Surat Masuk', 'Kerjasama Bersama Dinas Pendidikan', 'SM/2024/004', '1051-Article_Text-7745-2-10-20240301.pdf', 'Ini adalah isi dari ringkasan surat pra penelitian', 1701139464),
(4, 'Surat Masuk', 'Kerjasama Bersama Kemdikbud', 'SM/2024/005', 'Sistematika_Penulisan_Proposal_Skripsi2.pdf', 'Ini adalah ringkasan isi surat', 1721139924),
(5, 'Surat Keluar', 'Surat Keterangan Kuliah', '17/KET/II.3.AU/FTIK/F/2024', 'Proposal_Gilang.pdf', 'Ini adalah surat keluar', 1721143342),
(7, 'Surat Masuk', 'Surat Pembimbing Akademik', '18/KET/II.3.AU/FTIK/F/2024', 'Sistematika_Penulisan_Proposal_Skripsi1.pdf', 'g iugi iy87 87', 1721144817);

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

--
-- Dumping data untuk tabel `disposisi_surat`
--

INSERT INTO `disposisi_surat` (`id`, `kode_disposisi`, `id_surat`, `departemen`, `tujuan`, `tindakan`, `catatan`, `batas_waktu`, `date_created`) VALUES
(3, '20240411-ID12024013-1', 1, 'Bagian IT (Edited)', 'Pimpinan', 'Lakukan apa yang harusnya dilakukan dengan baik dan benar  ', 'Temui saya -H 1 sebelum agenda dilaksanakan, untuk membahas lebih lanjut terkait hal hal yang perlu di persiapkan      ', '2024-04-19', 1712820174),
(4, '20240414-ID12024013-3', 4, 'Bagian Kemahasiswaan', 'Pimpinan', 'Kita akan selenggarakan acara ini, segera persiapkan segala sesuatu yang dibutuhkan. ', 'Jangan menunggu deadline, kerjakan segera selagi ada waktu, kabari saya jika ada yang kurang jelas. ', '2024-04-21', 1713117586),
(5, '20240414-ID12024013-4', 5, 'Pimpinan', 'Dekan', 'Persiapkan segala sesuatu yang berkaitan dengan agenda ini', 'Persiapkan PPT untuk kegiatan agenda ini, jangan sampe lupa', '2024-04-17', 1713119542),
(6, '20240424-ID12024013-5', 10, 'Bagian IT', 'Pimpinan', ' Persiapkan seluruh kebutuhan untuk bejalannya agenda ini ', ' Besok temui saya untuk musyawarah bersama jhljsdljhsfljasf', '2024-04-27', 1713947224),
(7, '20240717-ID12024013-6', 13, 'Bagian IT', 'Pimpinan', 'Siapkan peralatan untuk kegiatan agenda ini', 'Jangan sampe ada yang kurang atau terbengkalai', '2024-07-20', 1721189535);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` int(11) NOT NULL,
  `kode_jenis_surat` varchar(10) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `template` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `kode_jenis_surat`, `jenis`, `kategori`, `template`) VALUES
(1, 'KET', 'KET. (Surat Keterangan)', 'Mahasiswa', '<p>Dekan Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi Lampung&nbsp;menerangkan bahwa:</p>  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\"> 	<tbody> 		<tr> 			<td>Nama</td> 			<td>:</td> 			<td>&nbsp;.................................................</td> 		</tr> 		<tr> 			<td>NPM</td> 			<td>:</td> 			<td>&nbsp;.................................................</td> 		</tr> 		<tr> 			<td>Tempat, Tgl. Lahir</td> 			<td>:</td> 			<td>&nbsp;.................................................</td> 		</tr> 		<tr> 			<td>Alamat</td> 			<td>:</td> 			<td>&nbsp;.................................................</td> 		</tr> 	</tbody> </table>  <p>Adalah benar yang bersangkutan saat ini tercatat sebagai mahasiswa pada semester 1 (satu) Tahun Akadem&icirc;k 2023/2024 Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi.</p>  <p>Demikian Surat Keterangan ini dibuat untuk dapat dipergunakan sesuai keperluan, jika terdapat kekeliruan akan diperbaiki sebagaimana mestinya.</p>'),
(2, 'KEP', 'KEP. (Surat Keputusan Dosen Pembimbing Akademik)', 'Dosen', '<p><strong>DEKAN FAKULTAS TEKNIK DAN ILMU KOMPUTER UNIVERSITAS MUHAMMADIYAH KOTABUMI,</strong></p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Menimbang</td>\n			<td>:</td>\n			<td>\n			<ol>\n				<li>&nbsp;bahwa dalam rangka kelancaran proses&nbsp;Perkuliahan dan Pembimbing&nbsp;mahasiswa maka, perlu ditunjuk dosen Pembimbing Akademik yang ditetapkan oleh Dekan&nbsp;Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi;</li>\n				<li>bahwa saudara yang namanya tercantum dalam lampiran Surat Keputusan ini, dipandang mampu dan memenuhi syarat untuk menjadi Dosen Pembimbing Akademik pada Program Studi Sistem dan Teknologi lnformasi Universitas Muhammadiyah Kotabumi;</li>\n				<li>Bahwa berdasarkan poin diatas maka perlu ditetapkan Surat Keputusan Dekan Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi.</li>\n			</ol>\n			</td>\n		</tr>\n		<tr>\n			<td>Mengingat</td>\n			<td>:</td>\n			<td>\n			<ol>\n				<li>&nbsp;Undang-Undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional;</li>\n				<li>Undang-Undang Nomor 12 Tahun 2012 tentang Pendidikan Tinggi;</li>\n				<li>Peraturan Pemerintah Nomor 19 Tahun 2005 tentang Standar Nasional Pendidikan, Jo Peraturan Pemeilntah Nomor 32 Tahun 2013 Tentang perubahan Kedua Atas Peraturan Pemerinhh Nomor 19 Tahun 2015 Tentang Standar Nasional Pendidikan;</li>\n				<li>Peraturan Pemedntah Nomor 04 Tahun 2015 tentang Penyelenggaraan Pendidikan Tinggi dan Pengelolaan Perguruan Tinggi;</li>\n				<li>Peraturan Menteri Riset, Teknologi, dan Pendidikan Tinggi Nomor rt4 Tahun 2015 Tentang $tandar Nasional Pendidikan Tinggi;</li>\n				<li>Keputusan Menteri Riset, Teknotogi, dan Pendidikan Tinggi Nomor 447/KPT/l/2019, Tanggal 17 Juni 2019 Tentang lzin Penggabungan Sekolah Tinggi Keguruan dan llmu Pendidikan Muhammadiyah Kotabumi di Lampung Utara dan Sekolah Tinggi llmu Hukum Muhammadiyah Kotabumi di Kabupaten Lampung Utara menjadi Universitas Muhammadiyah Kotabumi di Kabupaten Lampung Utara yang diselenggarakan Persyarikatan Muhammadiyah;</li>\n				<li>Pedoman Pimpinan Pusat Muhammadiyah Nomor 02/PED/I.0/B/ 2012 tentang Perguruan Tinggi Muhammadiyah;</li>\n				<li>Ketentuan Majelis Pendidikan Tinggi, Penelitian, dan Pengembangan Pimpinan Pusat Muhammadiyah, Nomor 178/KET/I.3/2012, Tentang Penjabaran Pedoman Pimpinan Pusat Muhammadiyah, Nomor 02/PED/I.0/B/ 2012, Tentang Perguruan Tinggi Muhammadiyah;</li>\n				<li>Surat Keputusan Pimpinan Pusat Muhammadiyah Nomor 207/KEP/l.0/D/2019 tanggal 09 Dzulqo&#39;idah 1440/2012 Juli 2019, Tentang Pengangkatan Rektor Universitas Muhammadiyah Kotabumi Masa Jabatan 2019-2023;</li>\n				<li>Stafuta Universitas Muhammadiyah Kotabumi;</li>\n				<li>Surat Keputusan Rektor Universitas Muhammadiyah Kotabumi Nomor 119/KEP/ll.3.AU/D/2019 Tentang Penetapan Dekan Fakultas Teknik Dan llmu Komputer Universitas Muhammadiyah Kotabumi.</li>\n			</ol>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p style=\"text-align: center;\"><strong>MEMUTUSKAN</strong></p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Menetapkan</td>\n			<td>:</td>\n			<td>&nbsp;</td>\n		</tr>\n		<tr>\n			<td>PERTAMA</td>\n			<td>:</td>\n			<td>Mengangkat dan menugaskan nama-nama yang terdapat pada lampiran Surat Keputusan ini sebagai dosen Pembimbing Akademik semester Genap Tahun Akademik 2021/2022 Program Studi Sistem dan Teknologi lnformasi Universitas Muhammadiyah Kohbumi.</td>\n		</tr>\n		<tr>\n			<td>KEDUA</td>\n			<td>:</td>\n			<td>Keputusan ini diberikan kepada yang bensangkutan untuk dilaksanakan sebagai amanah dengan penuh rasa tanggung jawab.</td>\n		</tr>\n		<tr>\n			<td>KETIGA</td>\n			<td>:</td>\n			<td>Segala biaya yang berkaitan dengan Surat Keputusan ini dibebankan kepada Universitas Muhammadiyah Kotabumi.</td>\n		</tr>\n		<tr>\n			<td>KEEMPAT</td>\n			<td>:</td>\n			<td>Surat Keputusan ini berlaku sejak tanggal ditetapkan, dengan ketentuan apabila dikemudian hari ternyata terdapat kekeliruan dalam Keputusan ini, maka akan diperbaiki sebagaimana mestinya.</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n'),
(3, 'IZN-PRA', 'IZN. (Surat Izin Pra-Penelitian)', 'Mahasiswa', '<p>Dekan Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi dengan ini mengharapkan bantuan saudara agar mahasiswa kami tersebut dibawah:</p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Nama</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................................</td>\n		</tr>\n		<tr>\n			<td>NPM</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................................</td>\n		</tr>\n		<tr>\n			<td>Semester</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................................</td>\n		</tr>\n		<tr>\n			<td>Alamat</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................................</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>Dapat diberikan izin untuk melakukan Pra-Penelitian di .................................................... selama 1 (satu) minggu dalam rangka penyusunan/penulisan Skripsi yang berjudul:</p>\n\n<p>&quot;................................................................................................................................................................................................................................................................................&quot;</p>\n\n<p>Sebagai salah satu syarat untuk menyelesaikan studinya pada Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi Lampung.</p>\n\n<p>Demikian atas perhatian dan bantuan saudara diucapkan terimakasih.</p>\n\n<p><em>Billahi Fii Sabililhaq Fastabiqul Khoirot</em></p>\n'),
(4, 'IZN-PEN', 'IZN. (Surat Izin Penelitian)', 'Mahasiswa', '<p>Dekan Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi, dengan ini mengharapkan banhan saudara agar mahasiswa kami tersebut dibawah ini:</p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Nama</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................</td>\n		</tr>\n		<tr>\n			<td>NPM</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................</td>\n		</tr>\n		<tr>\n			<td>Semester</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................</td>\n		</tr>\n		<tr>\n			<td>Alamat</td>\n			<td>:</td>\n			<td>&nbsp;..............................................................</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>Dapat diberikan izin untuk mengadakan Penelitian di .................................................... selama 2 (Dua) Minggu dalam rangka penyusunan/penulisan Skripsi yang berjudul:</p>\n\n<p>&quot;.............................................................................................................................................................................................................................................................................&quot;</p>\n\n<p>Sebagai salah satu syarat untuk menyelesaikan studinya pada Fakulhs Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi Lampung.</p>\n\n<p>Demikian atas perhatian dan bantuan Saudara diucapkan terimakasih.</p>\n\n<p><em>Billahi Fii Sabililhaq Fastabiqul Khoirot</em></p>\n'),
(5, 'KEP-PMBNG', 'KEP. (Surat Keputusan Penunjukan Sebagai Pembimbing Skripsi)', 'Mahasiswa', ''),
(6, 'KEP-PMBHS', 'KEP. (Surat Keputusan Penunjukan Sebagai Pembahas SEMHAS)', 'Mahasiswa', ''),
(7, 'KEP-MATKUL', 'KEP. (Surat Keputusan Dosen Penanggung Jawab dan Pengampu Mata Kuliah)', 'Dosen', '<p><strong>DEKAN FAKULTAS TEKNIK DAN ILMU KOMPUTER UNIVERSITAS MUHAMMADIYAH KOTABUMI</strong></p>  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\"> 	<tbody> 		<tr> 			<td>Menimbang</td> 			<td>:</td> 			<td> 			<ol> 				<li>bahwa untuk kelancaran kegiatan Perftuliahan di Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi pada semester GaniilTahun Akademik 2021/2022, perlu ditetapkan Dosen Penanggung Jaumb dan Pengampu mata kuliah;</li> 				<li>bahwa nama-nama dosen yang namanya tersebut dalam lampiran surat keputusan ini dipandang telah memenuhi persyaratan untuk mengajar sesuai bidang keahliannya;</li> 				<li>bahwa berdasarkan pertimbangan sebagaimana dimaksut pada angka 1 dan angka 2 perlu di terbitkan surat Keputusan Dekan tentang dosen penanggung Jawab dan Pengampu mata kuliah Semester Ganjil Tahun Akademik 2021/2022;</li> 			</ol> 			</td> 		</tr> 		<tr> 			<td>Mengingat</td> 			<td>:</td> 			<td> 			<ol> 				<li>Undang-Undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional;</li> 				<li>Undang-Undang Nomor 12 Tahun 2012 tentang Pendidikan Tinggi;</li> 				<li>Peraturan Pemerintah Nomor 19 Tahun 2005 tentang Standar Nasional Pendidikan, Jo Peraturan Pemeilntah Nomor 32 Tahun 2013 Tentang perubahan Kedua Atas Peraturan Pemerinhh Nomor 19 Tahun 2015 Tentang Standar Nasional Pendidikan;</li> 				<li>Peraturan Pemedntah Nomor 04 Tahun 2015 tentang Penyelenggaraan Pendidikan Tinggi dan Pengelolaan Perguruan Tinggi;</li> 				<li>Peraturan Menteri Riset, Teknologi, dan Pendidikan Tinggi Nomor rt4 Tahun 2015 Tentang $tandar Nasional Pendidikan Tinggi;</li> 				<li>Keputusan Menteri Riset, Teknotogi, dan Pendidikan Tinggi Nomor 447/KPT/l/2019, Tanggal 17 Juni 2019 Tentang lzin Penggabungan Sekolah Tinggi Keguruan dan llmu Pendidikan Muhammadiyah Kotabumi di Lampung Utara dan Sekolah Tinggi llmu Hukum Muhammadiyah Kotabumi di Kabupaten Lampung Utara menjadi Universitas Muhammadiyah Kotabumi di Kabupaten Lampung Utara yang diselenggarakan Persyarikatan Muhammadiyah;</li> 				<li>Pedoman Pimpinan Pusat Muhammadiyah Nomor 02/PED/I.0/B/ 2012 tentang Perguruan Tinggi Muhammadiyah;</li> 				<li>Ketentuan Majelis Pendidikan Tinggi, Penelitian, dan Pengembangan Pimpinan Pusat Muhammadiyah, Nomor 178/KET/I.3/2012, Tentang Penjabaran Pedoman Pimpinan Pusat Muhammadiyah, Nomor 02/PED/I.0/B/ 2012, Tentang Perguruan Tinggi Muhammadiyah;</li> 				<li>Surat Keputusan Pimpinan Pusat Muhammadiyah Nomor 207/KEP/l.0/D/2019 tanggal 09 Dzulqo&#39;idah 1440/2012 Juli 2019, Tentang Pengangkatan Rektor Universitas Muhammadiyah Kotabumi Masa Jabatan 2019-2023;</li> 				<li>Stafuta Universitas Muhammadiyah Kotabumi;</li> 				<li>Surat Keputusan Rektor Universitas Muhammadiyah Kotabumi Nomor 119/KEP/ll.3.AU/D/2019 Tentang Penetapan Dekan Fakultas Teknik Dan llmu Komputer Universitas Muhammadiyah Kotabumi.</li> 			</ol> 			</td> 		</tr> 	</tbody> </table>  <p style=\"text-align: center;\"><strong>MEMUTUSKAN</strong></p>  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\"> 	<tbody> 		<tr> 			<td>Menetapkan</td> 			<td>:</td> 			<td>&nbsp;</td> 		</tr> 		<tr> 			<td>PERTAMA</td> 			<td>:</td> 			<td>&nbsp;Menugaskan nama-nama yang terdapat pada lampiran Surat Keputusan ini sebagai dosen pengampu mata kuliah semester Ganjil Tahun Akademik 2021/2022.</td> 		</tr> 		<tr> 			<td>KEDUA</td> 			<td>:</td> 			<td>&nbsp;Kepadanya wajib melaksanakan tugas sesuai dengan penaturan yang berlaku dosen pada Universitas Muhammadiyah Kotabumi.</td> 		</tr> 		<tr> 			<td>KETIGA</td> 			<td>:</td> 			<td>&nbsp;Segala biaya yang berkaitan dengan Surat Keputusan ini dibebankan kepada Universitas Muhammadiyah Kotabumi.</td> 		</tr> 		<tr> 			<td>KEEMPAT</td> 			<td>:</td> 			<td>&nbsp;Surat Keputusan ini berlaku seiak ditetapkan, dengan ketentuan apabila dikemudian hari temyata terdapt kekeliruan dalam Keputusan ini, maka akan diperbaiki sebagaimana mestinya.</td> 		</tr> 	</tbody> </table>  <p>&nbsp;</p>'),
(8, 'KEP-UJK', 'KEP. (Surat Keputusan Panitia dan Pengawas Ujian Akhir)', 'Dosen', '<p><strong><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">DEKAN FAKULTAS TEKNIK DAN ILMU KOMPUTER UNIVERSITAS MUHAMMADIYAH KOTABUMI</span></span></span></strong></p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Menimbang</td>\n			<td>:</td>\n			<td>\n			<ol>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">bahwa dalam rangka kegiatan ujian akhir semester, Dekan Fakultas panita ujian akhir&nbsp;semester guna mempersiapkan dan melaksanakan kegiatan tersebut.</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">bahwa berdasarkan pada poin 1 di atas, maka perlu di buat surat keputusan Dekan.</span></span></span></li>\n			</ol>\n			</td>\n		</tr>\n		<tr>\n			<td>Mengingat</td>\n			<td>:</td>\n			<td>\n			<ol>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Undang-Undang RI. No. 20, Tahun 2003, tentang Sistem Pendidikan Nasional;</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Undang-Undang&nbsp; No. 14, Tahun 2005, tentang Guru dan Dosen;</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Undang-Undang No. 12, Tahun 2012, tentang&nbsp; Pendidikan Tinggi;</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Pedoman Pimpinan Pusat Muhammadiyah Nomor : 02/PED/1.0/B/2012, Tentang Perguruan Tinggi Muhammadiyah;</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Statuta Universitas Muhammadiyah Kotabumi;</span></span></span></li>\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Surat Keputusan Rektor Universitas Muhammadiyah Kotabumi Nomor 941/KEP/II.3.AU/D/2023 Tentang Penetapan Dekan Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi.</span></span></span></li>\n			</ol>\n			</td>\n		</tr>\n		<tr>\n			<td>Memperhatikan</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Edaran Rektor Nomor 1034/MLM/II.3.AU/F/2023 Tentang Ketentuan Pelaksanaan Ujian Akhir Semester Ganjil Universitas Muhammadiyah Kotabumi.</span></span></span></p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p style=\"text-align: center;\"><strong>MEMUTUSKAN</strong></p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Menetapkan</td>\n			<td>:</td>\n			<td>&nbsp;</td>\n		</tr>\n		<tr>\n			<td>PERTAMA</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Menugasi nama-nama yang tercantum pada lampiran 1 sebagai Panitia Ujian Akhir Semester Ganjil Tahun Akademik 2023/2024.</span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>KEDUA</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Menugasi nama-nama yang tercantum pada lampiran 2 sebagai Pengawas Ujian Akhir Semester Ganjil Tahun Akademik 2023/2024.</span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>KETIGA</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Panita dan Pengawas diberikan insentif sesuai dengan ketentuan yang berlaku di Universitas Muhammadiyah Kotabumi.</span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>KEEMPAT</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Surat Keputusan ini diberikan kepada yang bersangkutan sesuai pada lampiran.</span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>KELIMA</td>\n			<td>:</td>\n			<td>\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Surat Keputusan ini berlaku sejak tanggal ditetapkan dan apabila terdapat kekeliruan dalam penetapan ini akan diperbaiki sebagaimana mestinya.</span></span></span></p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n'),
(9, 'URD', 'URD. (Surat Undangan Rapat Dosen)', 'Dosen', '<p>Ba&rsquo;da salam semoga Allah SWT, senantiasa melimpahkan Rahmat dan Hidayah-Nya kepada kita dalam melaksanakan tugas sehari-hari. Amiin.</p>\n\n<p>Sehubungan dengan .................................................................... T.A .................................................. Prodi Sistem dan Teknologi Informasi Fakultas Teknik dan Ilmu Komputer maka, dengan ini kami mengundang Bapak/Ibu untuk hadir pada :</p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">\n	<tbody>\n		<tr>\n			<td>Hari</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n		<tr>\n			<td>Tanggal</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n		<tr>\n			<td>Pukul</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n		<tr>\n			<td>Tempat</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>Demikian undangan kami sampaikan, atas perhatian dan kehadirannya diucapkan terimakasih.</p>\n'),
(10, 'PPG', 'PPG. (Surat Permohonan Peminjaman Gedung)', 'Dosen', '<p>Ba&rsquo;da salam semoga Allah SWT, senantiasa melimpahkan Rahmat dan Hidayah-Nya kepada kita dalam melaksanakan tugas sehari-hari. Amiin.</p>\n\n<p>Sehubungan akan diadakan Seminar Proposal dan Seminar Hasil pada Prodi Sistem dan Teknologi Informasi Fakultas Teknik dan Ilmu Komputer yang akan dibagi menjadi dua ruangan yaitu Ruang Kelas FTIK dan Ruang Rapat Gedung C Universitas Muhammadiyah Kotabumi, yang akan dilaksanakan pada :</p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">\n	<tbody>\n		<tr>\n			<td>Hari</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n		<tr>\n			<td>Tanggal</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n		<tr>\n			<td>Pukul</td>\n			<td>:</td>\n			<td>&nbsp;.......................................................</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>Maka dengan ini kami mohon Peminjaman Gedung tersebut.</p>\n\n<p>Demikian permohonan ini kami sampaikan, atas perhatian&nbsp;kami ucapkan terimakasih.</p>\n');

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
(2, 'SR2', 'Penting', 'Untuk surat dengan jenis penting'),
(3, 'SR3', 'Segera', 'Untuk surat dengan jenis segera'),
(4, 'SR4', 'Rahasia', 'Untuk surat dengan jenis rahasia'),
(5, 'SR5', 'Penting dan Rahasia', 'Untuk surat dengan jenis penting dan rahasia'),
(6, 'SR6', 'Tembusan', 'Untuk surat dengan jenis tembusan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
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

--
-- Dumping data untuk tabel `pengajuan_surat`
--

INSERT INTO `pengajuan_surat` (`id`, `id_user`, `jenis_surat`, `keterangan`, `berkas_pendukung`, `sifat`, `status`, `dilihat`, `catatan_penolakan`, `date_created`, `date_updated`) VALUES
(1, 2, 'IZN. (Surat Izin Pra-Penelitian)', 'Saya atas nama Septiana Sari mengajukan permohonan surat masuk (Updateeesss)', 'CONTOH_SURAT_ARSIPAN.pdf', 'Penting', 1, 1, 'Berkas yang dimasukan tidak sesuai dengan persyaratan kampus ya.', 1720420196, 1721070994),
(2, 2, 'IZN. (Surat Izin Penelitian)', 'Saya sangat butuh surat ini sesegera mungkin min', 'Sistematika_Penulisan_Proposal_Skripsi.pdf', 'Mendesak', 4, 1, 'Berkas yang dimasukan tidak sesuai dengan persyaratan kampus ya.', 1720473297, 1721188075),
(3, 9, 'IZN. (Surat Izin Pra-Penelitian)', 'Saya butuh surat izin pra-penelitian dengan cepat, karena lusa saya harus ke tempat penelitian.', '', 'Mendesak', 3, 1, '', 1721044328, 0),
(6, 2, 'IZN. (Surat Izin Penelitian)', 'Tes limitasike 2', '', 'Mendesak', 1, 1, '', 1721074201, 0),
(5, 2, 'KET. (Surat Keterangan)', 'Tes limitasi ke 1', '', 'Penting', 1, 1, '', 1721074187, 0),
(7, 2, 'IZN. (Surat Izin Pra-Penelitian)', 'Testing aj yaa', '', 'Mendesak', 1, 1, '', 1721074339, 0),
(8, 2, 'IZN. (Surat Izin Pra-Penelitian)', 'Ini tes okeh ya eaeae aeaea', '1051-Article_Text-7745-2-10-20240301.pdf', 'Mendesak', 1, 1, 'Wah saya tolak kan hatoooooo', 1721093663, 1721133209),
(9, 2, 'KEP. (Surat Keputusan Penunjukan Sebagai Pembahas SEMHAS)', 'Tes', '', 'Mendesak', 1, 1, '', 1721187652, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
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

INSERT INTO `setting` (`id`, `web_title`, `tagline`, `caption`, `info_web_p1`, `info_web_p2`, `footer`, `image_workflow`, `institution_name`, `lead_name`, `nktam`, `faculty_name`, `prodi_name`, `address`, `url_maps`, `web`, `email`, `telp_or_fax`, `whatsapp`, `logo`, `alamat_ttd`, `ttd_image`) VALUES
(1, 'FTIK Administrasi', 'Layanan Administrasi', 'Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi.', 'Website ini adalah portal yang memberikan Layanan Administrasi Surat Menyurat pada Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiah Kotabumi, Website ini bisa dimanfaatkan oleh Mahasiswa untuk mengajukan permohonan surat terkait kebutuhan mahasiswa.', 'Dengan adanya Website ini diharapkan dapat membuat proses Layanan Administrasi Surat Menyurat pada Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiah Kotabumi menjadi lebih Efektif dan Efisien bagi Mahasiswa maupun para Dosen, dengan mengedepankan kemudahan.', 'FTIK Administrasi UMKO', 'workflow.png', 'Universitas Muhammadiyah Kotabumi', 'Khusnul Khotimah, S.Kom., M.T.I', '1093733', 'Fakultas Teknik dan Ilmu Komputer', 'Sistem dan Teknologi Informasi', 'Jln. Hasan Kepala Ratu No. 1052 Sindangsari, Kotabumi Lampung Utara, Provinsi Lampung, 34517', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.7532329019077!2d104.86999567407784!3d-4.812380449644992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e38a8cb47225a21%3A0xd2e026f22c44746f!2sUniversitas%20Muhammadiyah%20Kotabumi!5e0!3m2!1sid!2sid!4v1713711586785!5m2!1sid!2sid', 'https://ftik.umko.ac.id', 'ftk@umko.ac.id', '(0724) 22287', '6289624618789', 'logo-umko-min.png', 'Kotabumi', 'ttd1.png');

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

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `jenis_surat`, `id_klasifikasi`, `id_jenis`, `id_user`, `tentang_surat`, `nama_mahasiswa`, `npm`, `semester`, `tahun_akademik`, `nomor_surat`, `tgl_pelaksanaan`, `alamat_tujuan`, `penerima_surat`, `perihal`, `lampiran`, `isi_surat`, `catatan_kaki`, `isi_lampiran`, `status`, `tindak_lanjut`, `catatan`, `ttd`, `date_created`) VALUES
(9, 'Surat Keluar', 3, 3, 9, '', 'Mahasiswa 2', '345345345', '', NULL, '1/IZN/II.3.AU/FTIK/F/2024', '0000-00-00', 'Kotabumi, Lampung Utara', 'Khoirul Husen', 'Izin Penelitian', '1 Lampiran', '<p>4erfgdgdgfgddfgdg</p>', '<p>dfgdg</p>\r\n', '<p>dfgdgd</p>\r\n', 4, 'Oke telah saya cek lebih lanjut untuk validasi kedua, semua bagus akan saya teruskan untuk minta TTD Dekan', 'Siapkan slide presentasi untuk agenda ini ya.', 1, 1713294602),
(10, 'Surat Keluar', 3, 3, 10, '', 'M. Rezi', '4543545435545', '', '', '10/IZN/II.3.AU/FTIK/F/2024', '0000-00-00', 'Bandar Jaya', 'Pimpinan Cabang Pegadaian Bandar Jaya', 'Izin Pra Penelitian', '2 Lampiran', '<p style=\"text-align: center;\"><strong><span style=\"font-size:20px;\">SURAT IZIN PRA-PENELITIAN</span></strong></p>\r\n\r\n<p><strong><span style=\"font-size:12px;\">Berikut nama yg bersangkutan :</span></strong></p>\r\n\r\n<p><strong><span style=\"font-size:12px;\">nama</span></strong></p>\r\n\r\n<p><strong><span style=\"font-size:12px;\">npm</span></strong></p>\r\n\r\n<p><strong><span style=\"font-size:12px;\">jurusan</span></strong></p>\r\n\r\n<p><strong><span style=\"font-size:12px;\">terimakasih</span></strong></p>', '', '', 4, '', '', 1, 1713344959),
(11, 'Surat Keluar', 4, 2, 0, 'Perampasan Hak Aset', '', '', 'Genap', '2024/2025', '11/KEP/II.3.AU/FTIK/F/2024', '0000-00-00', '', '', '', '', '<p>warer</p>', '<p>waerwar</p>\r\n', '<p>awerwar</p>\r\n', 4, '', '', 1, 1713355113),
(12, 'Surat Keluar', 1, 4, 2, '', 'Mahasiswa', '3453535', '', '', '12/IZN/II.3.AU/FTIK/F/2024', '0000-00-00', 'AsaCom Kotabumi', '', 'Izin Penelitian', '1 Lampiran', '<p>34535 asresar</p>', '<p>saersar</p>\r\n', '<p>saersar</p>\r\n', 4, '', '', 1, 1713355225),
(16, 'Surat Keluar', 2, 1, 2, 'Testing', 'Septiana Sari', '658759875597', '', '', '16/KET/II.3.AU/FTIK/F/2024', '0000-00-00', '', '', '', '', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae voluptate ab quos quam perspiciatis consectetur iusto nostrum voluptates voluptas animi! :</p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse: collapse; width: 100%;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Nama</td>\r\n			<td>:</td>\r\n			<td>Septiana Sari</td>\r\n		</tr>\r\n		<tr>\r\n			<td>NPM</td>\r\n			<td>:</td>\r\n			<td>7595975975</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tanggal Lahir</td>\r\n			<td>:</td>\r\n			<td>23 Desmber 1999</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Alamat :</td>\r\n			<td>:</td>\r\n			<td>Alamat saya disini yaaa</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae voluptate ab quos quam perspiciatis consectetur iusto nostrum voluptates voluptas animi! :&nbsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae voluptate ab quos quam perspiciatis consectetur iusto nostrum voluptates voluptas animi! :&nbsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae voluptate ab quos quam perspiciatis consectetur iusto nostrum voluptates voluptas animi! :</p>', '', '', 4, 'Surat diterima, akan saya minta TTD ke Dekan', 'Tidak ada', 1, 1721190003),
(14, 'Surat Keluar', 1, 1, 10, 'Perkumpulan BEM', 'M. Rezi', '8709324024', '', NULL, '14/KET/II.3.AU/FTIK/F/2024', '0000-00-00', '', '', '', '', '<p><strong>SURAT IZIN PRA-PENELITIAN</strong></p>\r\n\r\n<p><strong>Berikut nama yg bersangkutan :</strong></p>\r\n\r\n<p><strong>nama</strong></p>\r\n\r\n<p><strong>npm</strong></p>\r\n\r\n<p><strong>jurusan</strong></p>\r\n\r\n<p><strong>terimakasih</strong></p>', '', '', 4, 'Oke aman', '', 1, 1721178439),
(15, 'Surat Keluar', 2, 2, 0, 'Surat Keputusan', '', '', 'Ganjil-Genap', '2024/2025', '15/KEP/II.3.AU/FTIK/F/2024', '0000-00-00', '', '', '', '', '<p>Oke letsgoo</p>', '', '', 4, '', '', 1, 1721178540),
(17, 'Surat Keluar', 2, 1, 13, 'Surat Keterangan', 'Septi Ajah', '20079231', '', NULL, '17/KET/II.3.AU/FTIK/F/2024', '0000-00-00', '', '', '', '', '<p>Dekan Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi Lampung&nbsp;menerangkan bahwa:</p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Nama</td>\r\n			<td>:</td>\r\n			<td>&nbsp;Septiana Sari</td>\r\n		</tr>\r\n		<tr>\r\n			<td>NPM</td>\r\n			<td>:</td>\r\n			<td>&nbsp;20071213</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tempat, Tgl. Lahir</td>\r\n			<td>:</td>\r\n			<td>&nbsp;28 Januari 1999</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Alamat</td>\r\n			<td>:</td>\r\n			<td>&nbsp;Prokimal Tepatnya dimana saya gak tau</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Adalah benar yang bersangkutan saat ini tercatat sebagai mahasiswa pada semester 1 (satu) Tahun Akadem&icirc;k 2023/2024 Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi.</p>\r\n\r\n<p>Demikian Surat Keterangan ini dibuat untuk dapat dipergunakan sesuai keperluan, jika terdapat kekeliruan akan diperbaiki sebagaimana mestinya.</p>', '', '', 4, 'Oke setuju nih saya', 'Tunggu kabar dari saya nanti ya', 1, 1722568760),
(18, 'Surat Keluar', 2, 2, 0, 'Dosen Pembimbing Akademik', '', '', 'Genap', '2024/2025', '18/KEP/II.3.AU/FTIK/F/2024', '0000-00-00', '', '', '', '', '<p><strong>DEKAN FAKULTAS TEKNIK DAN ILMU KOMPUTER UNIVERSITAS MUHAMMADIYAH KOTABUMI,</strong></p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Menimbang</td>\n			<td>:</td>\n			<td>\n			<ol>\n				<li>&nbsp;bahwa dalam rangka kelancaran proses&nbsp;Perkuliahan dan Pembimbing&nbsp;mahasiswa maka, perlu ditunjuk dosen Pembimbing Akademik yang ditetapkan oleh Dekan&nbsp;Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi;</li>\n				<li>bahwa saudara yang namanya tercantum dalam lampiran Surat Keputusan ini, dipandang mampu dan memenuhi syarat untuk menjadi Dosen Pembimbing Akademik pada Program Studi Sistem dan Teknologi lnformasi Universitas Muhammadiyah Kotabumi;</li>\n				<li>Bahwa berdasarkan poin diatas maka perlu ditetapkan Surat Keputusan Dekan Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi.</li>\n			</ol>\n			</td>\n		</tr>\n		<tr>\n			<td>Mengingat</td>\n			<td>:</td>\n			<td>\n			<ol>\n				<li>&nbsp;Undang-Undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional;</li>\n				<li>Undang-Undang Nomor 12 Tahun 2012 tentang Pendidikan Tinggi;</li>\n				<li>Peraturan Pemerintah Nomor 19 Tahun 2005 tentang Standar Nasional Pendidikan, Jo Peraturan Pemeilntah Nomor 32 Tahun 2013 Tentang perubahan Kedua Atas Peraturan Pemerinhh Nomor 19 Tahun 2015 Tentang Standar Nasional Pendidikan;</li>\n				<li>Peraturan Pemedntah Nomor 04 Tahun 2015 tentang Penyelenggaraan Pendidikan Tinggi dan Pengelolaan Perguruan Tinggi;</li>\n				<li>Peraturan Menteri Riset, Teknologi, dan Pendidikan Tinggi Nomor rt4 Tahun 2015 Tentang $tandar Nasional Pendidikan Tinggi;</li>\n				<li>Keputusan Menteri Riset, Teknotogi, dan Pendidikan Tinggi Nomor 447/KPT/l/2019, Tanggal 17 Juni 2019 Tentang lzin Penggabungan Sekolah Tinggi Keguruan dan llmu Pendidikan Muhammadiyah Kotabumi di Lampung Utara dan Sekolah Tinggi llmu Hukum Muhammadiyah Kotabumi di Kabupaten Lampung Utara menjadi Universitas Muhammadiyah Kotabumi di Kabupaten Lampung Utara yang diselenggarakan Persyarikatan Muhammadiyah;</li>\n				<li>Pedoman Pimpinan Pusat Muhammadiyah Nomor 02/PED/I.0/B/ 2012 tentang Perguruan Tinggi Muhammadiyah;</li>\n				<li>Ketentuan Majelis Pendidikan Tinggi, Penelitian, dan Pengembangan Pimpinan Pusat Muhammadiyah, Nomor 178/KET/I.3/2012, Tentang Penjabaran Pedoman Pimpinan Pusat Muhammadiyah, Nomor 02/PED/I.0/B/ 2012, Tentang Perguruan Tinggi Muhammadiyah;</li>\n				<li>Surat Keputusan Pimpinan Pusat Muhammadiyah Nomor 207/KEP/l.0/D/2019 tanggal 09 Dzulqo&#39;idah 1440/2012 Juli 2019, Tentang Pengangkatan Rektor Universitas Muhammadiyah Kotabumi Masa Jabatan 2019-2023;</li>\n				<li>Stafuta Universitas Muhammadiyah Kotabumi;</li>\n				<li>Surat Keputusan Rektor Universitas Muhammadiyah Kotabumi Nomor 119/KEP/ll.3.AU/D/2019 Tentang Penetapan Dekan Fakultas Teknik Dan llmu Komputer Universitas Muhammadiyah Kotabumi.</li>\n			</ol>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p style=\"text-align: center;\"><strong>MEMUTUSKAN</strong></p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Menetapkan</td>\n			<td>:</td>\n			<td>&nbsp;</td>\n		</tr>\n		<tr>\n			<td>PERTAMA</td>\n			<td>:</td>\n			<td>Mengangkat dan menugaskan nama-nama yang terdapat pada lampiran Surat Keputusan ini sebagai dosen Pembimbing Akademik semester Genap Tahun Akademik 2021/2022 Program Studi Sistem dan Teknologi lnformasi Universitas Muhammadiyah Kohbumi.</td>\n		</tr>\n		<tr>\n			<td>KEDUA</td>\n			<td>:</td>\n			<td>Keputusan ini diberikan kepada yang bensangkutan untuk dilaksanakan sebagai amanah dengan penuh rasa tanggung jawab.</td>\n		</tr>\n		<tr>\n			<td>KETIGA</td>\n			<td>:</td>\n			<td>Segala biaya yang berkaitan dengan Surat Keputusan ini dibebankan kepada Universitas Muhammadiyah Kotabumi.</td>\n		</tr>\n		<tr>\n			<td>KEEMPAT</td>\n			<td>:</td>\n			<td>Surat Keputusan ini berlaku sejak tanggal ditetapkan, dengan ketentuan apabila dikemudian hari ternyata terdapat kekeliruan dalam Keputusan ini, maka akan diperbaiki sebagaimana mestinya.</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n', '<p>Tembusan: Yth</p>\r\n\r\n<ol>\r\n <li>Rektor Universitas Muhammadiyah Kotabumi (sebagai laporan).</li>\r\n <li>Wakil Rektor I Universitas Muhammadiyah Kotabumi (sebagai laporan).</li>\r\n <li>Bagian Administrasi Akademik Universitas Muhammadiyah Kotabumi.</li>\r\n <li>Bagian Administrasi Keuangan dan Kepegawaian Universitas Muhammadiyah Kotabumi.</li>\r\n <li>Masing-masing dosen yang bersangkutan pada Fakultas Teknik dan Ilmu Komputer Muhammadiyah Kotabumi.</li>\r\n</ol>\r\n', '', 4, 'Oke saya berikan izin untuk ditanda tangani', 'Persiapan slide PPT untuk acara ini dengan baik.', 1, 1722569210),
(19, 'Surat Keluar', 2, 3, 2, '', 'Septiana Sari', '20071015', '', '', '19/IZN/II.3.AU/FTIK/F/2024', '0000-00-00', 'Kotabumi, Lampung Utara', 'Pimpinan RS. Handayani', 'Izin Pra-Penelitian', '-', '<p>Dekan Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi dengan ini mengharapkan bantuan saudara agar mahasiswa kami tersebut dibawah:</p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\n	<tbody>\n		<tr>\n			<td>Nama</td>\n			<td>:</td>\n			<td>&nbsp;Septiana Sari</td>\n		</tr>\n		<tr>\n			<td>NPM</td>\n			<td>:</td>\n			<td>&nbsp;20071015</td>\n		</tr>\n		<tr>\n			<td>Semester</td>\n			<td>:</td>\n			<td>&nbsp;8 (Delapan)</td>\n		</tr>\n		<tr>\n			<td>Alamat</td>\n			<td>:</td>\n			<td>&nbsp;Sribasuki, Kotabumi Lampung Utara</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>Dapat diberikan izin untuk melakukan Pra-Penelitian di Rumah Sakit Handayani Kotabumi selama 1 (satu) minggu dalam rangka penyusunan/penulisan Skripsi yang berjudul:</p>\n\n<p>&quot;Sistem Pakar Mendiagnosa Gangguan Kepribadian Menggunakan Metode Forward Chaining dan Certainty Factor&quot;</p>\n\n<p>Sebagai salah satu syarat untuk menyelesaikan studinya pada Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi Lampung.</p>\n\n<p>Demikian atas perhatian dan bantuan saudara diucapkan terimakasih.</p>\n\n<p><em>Billahi Fii Sabililhaq Fastabiqul Khoirot</em></p>', '', '', 4, 'Oke surat saya setujui ya', 'Pastikan semua syarat mahasiswa terlengkapi', 1, 1722578003),
(20, 'Surat Keluar', 2, 4, 2, '', 'Septiana Sari', '20071015', '', '', '20/IZN/II.3.AU/FTIK/F/2024', '0000-00-00', 'Kotabumi, Lampung Utara', 'Pimpinan Perusahaan', 'Izin Penelitian', '-', '<p>Dekan Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi, dengan ini mengharapkan banhan saudara agar mahasiswa kami tersebut dibawah ini:</p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Nama</td>\r\n			<td>:</td>\r\n			<td>&nbsp;Septiana Sari</td>\r\n		</tr>\r\n		<tr>\r\n			<td>NPM</td>\r\n			<td>:</td>\r\n			<td>&nbsp;20071015</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Semester</td>\r\n			<td>:</td>\r\n			<td>&nbsp;8 (Delapan)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Alamat</td>\r\n			<td>:</td>\r\n			<td>&nbsp;Sribasuki, Kotabumi&nbsp;Lampung Utara</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Dapat diberikan izin untuk mengadakan Penelitian di Rumah Sakit Handayani Kotabumi selama 2 (Dua) Minggu dalam rangka penyusunan/penulisan Skripsi yang berjudul:</p>\r\n\r\n<p>&quot;Perancangan Sistem Informasi Administrasi Surat Menyurat Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi&quot;</p>\r\n\r\n<p>Sebagai salah satu syarat untuk menyelesaikan studinya pada Fakulhs Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi Lampung.</p>\r\n\r\n<p>Demikian atas perhatian dan bantuan Saudara diucapkan terimakasih.</p>\r\n\r\n<p>Billahi Fii Sabililhaq Fastabiqul Khoirot</p>', '', '', 4, 'Oke surat yang ACC ya', 'Pastikan berkas administrasi dan keuangan sudah dilengkapi', 1, 1722578160),
(21, 'Surat Keluar', 2, 7, 0, 'Dosen Penanggung Jawab Dan Pengampu Mata Kuliah', '', '', 'Ganjil', '2024/2025', '21/KEP/II.3.AU/FTIK/F/2024', '0000-00-00', '', '', '', '', '<p><strong>DEKAN FAKULTAS TEKNIK DAN ILMU KOMPUTER UNIVERSITAS MUHAMMADIYAH KOTABUMI</strong></p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Menimbang</td>\r\n			<td>:</td>\r\n			<td>\r\n			<ol>\r\n				<li>bahwa untuk kelancaran kegiatan Perftuliahan di Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi pada semester GaniilTahun Akademik 2021/2022, perlu ditetapkan Dosen Penanggung Jaumb dan Pengampu mata kuliah;</li>\r\n				<li>bahwa nama-nama dosen yang namanya tersebut dalam lampiran surat keputusan ini dipandang telah memenuhi persyaratan untuk mengajar sesuai bidang keahliannya;</li>\r\n				<li>bahwa berdasarkan pertimbangan sebagaimana dimaksut pada angka 1 dan angka 2 perlu di terbitkan surat Keputusan Dekan tentang dosen penanggung Jawab dan Pengampu mata kuliah Semester Ganjil Tahun Akademik 2021/2022;</li>\r\n			</ol>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mengingat</td>\r\n			<td>:</td>\r\n			<td>\r\n			<ol>\r\n				<li>Undang-Undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional;</li>\r\n				<li>Undang-Undang Nomor 12 Tahun 2012 tentang Pendidikan Tinggi;</li>\r\n				<li>Peraturan Pemerintah Nomor 19 Tahun 2005 tentang Standar Nasional Pendidikan, Jo Peraturan Pemeilntah Nomor 32 Tahun 2013 Tentang perubahan Kedua Atas Peraturan Pemerinhh Nomor 19 Tahun 2015 Tentang Standar Nasional Pendidikan;</li>\r\n				<li>Peraturan Pemedntah Nomor 04 Tahun 2015 tentang Penyelenggaraan Pendidikan Tinggi dan Pengelolaan Perguruan Tinggi;</li>\r\n				<li>Peraturan Menteri Riset, Teknologi, dan Pendidikan Tinggi Nomor rt4 Tahun 2015 Tentang $tandar Nasional Pendidikan Tinggi;</li>\r\n				<li>Keputusan Menteri Riset, Teknotogi, dan Pendidikan Tinggi Nomor 447/KPT/l/2019, Tanggal 17 Juni 2019 Tentang lzin Penggabungan Sekolah Tinggi Keguruan dan llmu Pendidikan Muhammadiyah Kotabumi di Lampung Utara dan Sekolah Tinggi llmu Hukum Muhammadiyah Kotabumi di Kabupaten Lampung Utara menjadi Universitas Muhammadiyah Kotabumi di Kabupaten Lampung Utara yang diselenggarakan Persyarikatan Muhammadiyah;</li>\r\n				<li>Pedoman Pimpinan Pusat Muhammadiyah Nomor 02/PED/I.0/B/ 2012 tentang Perguruan Tinggi Muhammadiyah;</li>\r\n				<li>Ketentuan Majelis Pendidikan Tinggi, Penelitian, dan Pengembangan Pimpinan Pusat Muhammadiyah, Nomor 178/KET/I.3/2012, Tentang Penjabaran Pedoman Pimpinan Pusat Muhammadiyah, Nomor 02/PED/I.0/B/ 2012, Tentang Perguruan Tinggi Muhammadiyah;</li>\r\n				<li>Surat Keputusan Pimpinan Pusat Muhammadiyah Nomor 207/KEP/l.0/D/2019 tanggal 09 Dzulqo&#39;idah 1440/2012 Juli 2019, Tentang Pengangkatan Rektor Universitas Muhammadiyah Kotabumi Masa Jabatan 2019-2023;</li>\r\n				<li>Stafuta Universitas Muhammadiyah Kotabumi;</li>\r\n				<li>Surat Keputusan Rektor Universitas Muhammadiyah Kotabumi Nomor 119/KEP/ll.3.AU/D/2019 Tentang Penetapan Dekan Fakultas Teknik Dan llmu Komputer Universitas Muhammadiyah Kotabumi.</li>\r\n			</ol>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"text-align: center;\"><strong>MEMUTUSKAN</strong></p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Menetapkan</td>\r\n			<td>:</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>PERTAMA</td>\r\n			<td>:</td>\r\n			<td>&nbsp;Menugaskan nama-nama yang terdapat pada lampiran Surat Keputusan ini sebagai dosen pengampu mata kuliah semester Ganjil Tahun Akademik 2021/2022.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>KEDUA</td>\r\n			<td>:</td>\r\n			<td>&nbsp;Kepadanya wajib melaksanakan tugas sesuai dengan penaturan yang berlaku dosen pada Universitas Muhammadiyah Kotabumi.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>KETIGA</td>\r\n			<td>:</td>\r\n			<td>&nbsp;Segala biaya yang berkaitan dengan Surat Keputusan ini dibebankan kepada Universitas Muhammadiyah Kotabumi.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>KEEMPAT</td>\r\n			<td>:</td>\r\n			<td>&nbsp;Surat Keputusan ini berlaku seiak ditetapkan, dengan ketentuan apabila dikemudian hari temyata terdapt kekeliruan dalam Keputusan ini, maka akan diperbaiki sebagaimana mestinya.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>', '<p>Tembusan: disampaikan Yth,</p>\r\n\r\n<ol>\r\n <li>Rektor Universitas Muhammadiyah Kotabumi (sebagai laporan).</li>\r\n <li>Wakil Rektor l, ll, dan lll Universitas Muhammdiyah Kotabumi (sebagai laporan).</li>\r\n <li>Bagian Administrasi Akademik Universitas Muhammadiyah Kotabumi.</li>\r\n <li>Bagian Administrasi Umum, Prasarana dan Sarana Universitas Muhammadiyah Kotabumi.</li>\r\n <li>Bagian Adminstrasi Keuangan dan kepegawaian Universitas Muhammadiyah Kotabumi.</li>\r\n <li>Masing-masing Ketua Program Studi pda Fakultas Teknik dan llmu Komputer Universitas Muhammadiyah Kotabumi.</li>\r\n <li>Masing-masing nama Dosen yang bersangkutan.</li>\r\n</ol>\r\n', '<p><strong>LAMPIRAN :</strong></p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" xss=removed>\r\n <tbody>\r\n  <tr>\r\n   <td xss=removed><strong>Lampiran </strong></td>\r\n   <td xss=removed><strong>Satu</strong></td>\r\n   <td xss=removed><strong>Dua</strong></td>\r\n   <td xss=removed><strong>Tiga</strong></td>\r\n   <td xss=removed><strong>Empat</strong></td>\r\n  </tr>\r\n  <tr>\r\n   <td>Lampiran 1</td>\r\n   <td>Data 1</td>\r\n   <td>Data 2</td>\r\n   <td>Data 3</td>\r\n   <td>Data 4</td>\r\n  </tr>\r\n  <tr>\r\n   <td>Lampiran 2</td>\r\n   <td>Data 1</td>\r\n   <td>Data 2</td>\r\n   <td>Data 3</td>\r\n   <td>Data 4</td>\r\n  </tr>\r\n  <tr>\r\n   <td>Lampiran 3</td>\r\n   <td>Data 1</td>\r\n   <td>Data 2</td>\r\n   <td>Data 3</td>\r\n   <td>Data 4</td>\r\n  </tr>\r\n  <tr>\r\n   <td>Lampiran 4</td>\r\n   <td>Data 1</td>\r\n   <td>Data 2</td>\r\n   <td>Data 3</td>\r\n   <td>Data 4</td>\r\n  </tr>\r\n  <tr>\r\n   <td>Lampiran 5</td>\r\n   <td>Data 1</td>\r\n   <td>Data 2</td>\r\n   <td>Data 3</td>\r\n   <td>Data 4</td>\r\n  </tr>\r\n  <tr>\r\n   <td>Lampiran 6</td>\r\n   <td>Data 1</td>\r\n   <td>Data 2</td>\r\n   <td>Data 3</td>\r\n   <td>Data 4</td>\r\n  </tr>\r\n  <tr>\r\n   <td>Lampiran 7</td>\r\n   <td>Data 1</td>\r\n   <td>Data 2</td>\r\n   <td>Data 3</td>\r\n   <td>Data 4</td>\r\n  </tr>\r\n </tbody>\r\n</table>\r\n\r\n<p> </p>\r\n', 4, 'Surat saya ACC dan akan diteruskan untuk meminta TTD Dekan', 'Siapkan berkas pendukung surat ini segera', 1, 1722750510),
(22, 'Surat Keluar', 2, 8, 0, 'Panitia Dan Pengawas Ujian Akhir', '', '', 'Ganjil', '2024/2025', '22/KEP/II.3.AU/FTIK/F/2024', '0000-00-00', '', '', '', '', '<p><strong><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">DEKAN FAKULTAS TEKNIK DAN ILMU KOMPUTER UNIVERSITAS MUHAMMADIYAH KOTABUMI</span></span></span></strong></p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Menimbang</td>\r\n			<td>:</td>\r\n			<td>\r\n			<ol>\r\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">bahwa dalam rangka kegiatan ujian akhir semester, Dekan Fakultas panita ujian akhir&nbsp;semester guna mempersiapkan dan melaksanakan kegiatan tersebut.</span></span></span></li>\r\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">bahwa berdasarkan pada poin 1 di atas, maka perlu di buat surat keputusan Dekan.</span></span></span></li>\r\n			</ol>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mengingat</td>\r\n			<td>:</td>\r\n			<td>\r\n			<ol>\r\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Undang-Undang RI. No. 20, Tahun 2003, tentang Sistem Pendidikan Nasional;</span></span></span></li>\r\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Undang-Undang&nbsp; No. 14, Tahun 2005, tentang Guru dan Dosen;</span></span></span></li>\r\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Undang-Undang No. 12, Tahun 2012, tentang&nbsp; Pendidikan Tinggi;</span></span></span></li>\r\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Pedoman Pimpinan Pusat Muhammadiyah Nomor : 02/PED/1.0/B/2012, Tentang Perguruan Tinggi Muhammadiyah;</span></span></span></li>\r\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Statuta Universitas Muhammadiyah Kotabumi;</span></span></span></li>\r\n				<li><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Surat Keputusan Rektor Universitas Muhammadiyah Kotabumi Nomor 941/KEP/II.3.AU/D/2023 Tentang Penetapan Dekan Fakultas Teknik dan Ilmu Komputer Universitas Muhammadiyah Kotabumi.</span></span></span></li>\r\n			</ol>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Memperhatikan</td>\r\n			<td>:</td>\r\n			<td>\r\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Edaran Rektor Nomor 1034/MLM/II.3.AU/F/2023 Tentang Ketentuan Pelaksanaan Ujian Akhir Semester Ganjil Universitas Muhammadiyah Kotabumi.</span></span></span></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"text-align: center;\"><strong>MEMUTUSKAN</strong></p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-responsive table-bordered table-striped\" style=\"border-collapse:collapse;width:100%;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Menetapkan</td>\r\n			<td>:</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>PERTAMA</td>\r\n			<td>:</td>\r\n			<td>\r\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Menugasi nama-nama yang tercantum pada lampiran 1 sebagai Panitia Ujian Akhir Semester Ganjil Tahun Akademik 2023/2024.</span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>KEDUA</td>\r\n			<td>:</td>\r\n			<td>\r\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Menugasi nama-nama yang tercantum pada lampiran 2 sebagai Pengawas Ujian Akhir Semester Ganjil Tahun Akademik 2023/2024.</span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>KETIGA</td>\r\n			<td>:</td>\r\n			<td>\r\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Panita dan Pengawas diberikan insentif sesuai dengan ketentuan yang berlaku di Universitas Muhammadiyah Kotabumi.</span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>KEEMPAT</td>\r\n			<td>:</td>\r\n			<td>\r\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Surat Keputusan ini diberikan kepada yang bersangkutan sesuai pada lampiran.</span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>KELIMA</td>\r\n			<td>:</td>\r\n			<td>\r\n			<p style=\"margin-left: 40px;\"><span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Surat Keputusan ini berlaku sejak tanggal ditetapkan dan apabila terdapat kekeliruan dalam penetapan ini akan diperbaiki sebagaimana mestinya.</span></span></span></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>', '<p xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Tembusan : disampaikan Yth</span></span></span></span></p>\n\n<ol>\n <li><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Rektor Universitas Muhammadiyah Kotabumi (sebagai laporan).</span></span></span></span></span></li>\n <li><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Wakil Rektor I, II, III, IV Universitas Muhammadiyah Kotabumi.</span></span></span></span></span></li>\n <li><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Kepala Biro Universitas Muhammadiyah Kotabumi.</span></span></span></span></span></li>\n <li><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Masing-masing Dosen dan Panitia yang bersangkutan.</span></span></span></span></li>\n</ol>\n', '', 4, 'Tidak ada', 'Tidak ada', 1, 1722826313),
(23, 'Surat Keluar', 2, 9, 0, '', '', '', '', '', '23/URD/II.3.AU/FTIK/F/2024', '2024-08-08', 'Kotabumi, Lampung Utara', 'Pimpinan ITBA-DCC', 'Undangan Rapat Dosen', '-', '<p>Ba&rsquo;da salam semoga Allah SWT, senantiasa melimpahkan Rahmat dan Hidayah-Nya kepada kita dalam melaksanakan tugas sehari-hari. Amiin.</p>\n\n<p>Sehubungan dengan persiapan Ujian Akhir Semester Ganjil T.A 2023/2024 Prodi Sistem dan Teknologi Informasi Fakultas Teknik dan Ilmu Komputer maka, dengan ini kami mengundang Bapak/Ibu untuk hadir pada :</p>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">\n	<tbody>\n		<tr>\n			<td>Hari</td>\n			<td>:</td>\n			<td>&nbsp;Jumat</td>\n		</tr>\n		<tr>\n			<td>Tanggal</td>\n			<td>:</td>\n			<td>&nbsp;28 Juli 2024</td>\n		</tr>\n		<tr>\n			<td>Pukul</td>\n			<td>:</td>\n			<td>08:00 WIB s.d</td>\n		</tr>\n		<tr>\n			<td>Tempat</td>\n			<td>:</td>\n			<td>&nbsp;Aula Universitas Muhammadiyah Kotabumi</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>Demikian undangan kami sampaikan, atas perhatian dan kehadirannya diucapkan terimakasih.</p>\n', '<p><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Tembusan Yth:</span></span></span></span></span></p>\r\n\r\n<ol>\r\n <li xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Rektor Universitas Muhammadiyah Kotabumi.</span></span></span></span></span></li>\r\n <li xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Wakil Rektor I, II, III, IV Universitas Muhammadiyah Kotabumi.</span></span></span></span></span></li>\r\n <li xss=removed><span xss=removed><span xss=removed><span xss=removed>Kepala Biro Administrasi Umum dan Aset Universitas Muhammadiyah Kotabumi.</span></span></span></li>\r\n</ol>\r\n', '', 4, 'Tidak ada', 'Tidak ada', 1, 1722826826),
(24, 'Surat Keluar', 2, 10, 0, '', '', '', '', '', '24/PPG/II.3.AU/FTIK/F/2024', '2024-08-07', 'Kotabumi', 'Rektor Muhammadiyah Kotabumi', 'Permohonan Peminjaman Gedung', '-', '<p>Ba&rsquo;da salam semoga Allah SWT, senantiasa melimpahkan Rahmat dan Hidayah-Nya kepada kita dalam melaksanakan tugas sehari-hari. Amiin.</p>\r\n\r\n<p>Sehubungan akan diadakan Seminar Proposal dan Seminar Hasil pada Prodi Sistem dan Teknologi Informasi Fakultas Teknik dan Ilmu Komputer yang akan dibagi menjadi dua ruangan yaitu Ruang Kelas FTIK dan Ruang Rapat Gedung C Universitas Muhammadiyah Kotabumi, yang akan dilaksanakan pada :</p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Hari</td>\r\n			<td>:</td>\r\n			<td>&nbsp;Rabu</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tanggal</td>\r\n			<td>:</td>\r\n			<td>&nbsp;<span style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">27 Desember 2023</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pukul</td>\r\n			<td>:</td>\r\n			<td>&nbsp;<span style=\"font-size:12.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">08.00 Wib s/d Selesai</span></span></span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Maka dengan ini kami mohon Peminjaman Gedung tersebut.</p>\r\n\r\n<p>Demikian permohonan ini kami sampaikan, atas perhatian&nbsp;kami ucapkan terimakasih.</p>', '<p><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Tembusan Yth:</span></span></span></span></span></p>\r\n\r\n<ol>\r\n <li xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Rektor Universitas Muhammadiyah Kotabumi</span></span></span></span></span></li>\r\n <li xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed><span xss=removed>Wakil Rektor I, II, III, IV Universitas Muhammadiyah Kotabumi</span></span></span></span></span></li>\r\n <li xss=removed><span xss=removed><span xss=removed><span xss=removed>Kepala Biro Administrasi Umum dan Aset Universitas Muhammadiyah Kotabumi</span></span></span></li>\r\n</ol>\r\n', '', 4, 'Tidak ada', 'Tidak ada', 1, 1722827264);

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
(4, 'Surat Masuk', 6, 'SM/2024/003', '2024-04-14', 'Yayasan Tunas Pertiwi', 'Undangan Rapat', '<h2 style=\"text-align: center;\"><strong>RINGKASAN SURAT MASUK</strong></h2>\r\n\r\n<p>Ini adalah ringkasan surat yand didapat dari <span style=\"background-color:#f1c40f;\">Yayasan Tunas Pertiwi</span> tentang Undangan Rapat yang akan dilaksanakan minggu depan, surat ini bersifat Tembusan dan tidak wajib dihadiri oleh kita. hal yang mungkin perlu dipersiapkan :</p>\r\n\r\n<ol>\r\n	<li>Ruangan Aula</li>\r\n	<li>Budget untuk membeli jamuan</li>\r\n	<li>Persiapan musyawarah bersama</li>\r\n</ol>\r\n\r\n<p>Sekian paparan dari ringakasan surat ini, semoga bisa menjadi gambaran bagi pembaca, terimakasih</p>', '3 Lampiran', 'M. Alba Syaputra', 5, 'Oke surat telah saya cek kembali, dan hasilnya sudah sesuai, saya terima dan akan diteruskan ke dekan untuk meminta TTD', 'Persiapkan bahas materi untuk presentasi pada acara ini', 'Data2.pdf', 1, 1713116756),
(5, 'Surat Masuk', 4, 'SM/2024/004', '2024-04-15', 'STMIK Surya Intan', 'Rapat bersama terkait Lebaran', '<p>Ini adalah surat yang sangat rahasia, jadi tidak boleh diketahui oleh khalayak umum, mohon jaga kerahasiaan surat ini bersama</p>', '2 Lampiran', 'Khoirul Husen', 5, 'Oke surat saya ACC, akan saya lanjutkan untuk meminta TTD', 'Siapkan slide simpel saja, karena ini acara rahasia jadi tidak banyak yang datang', 'Data1.pdf', 1, 1713119127),
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

INSERT INTO `users` (`id`, `kode_user`, `name`, `email`, `telp`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(2, 'ID12024011', 'Septiana Sari', 'mahasiswa@gmail.com', 0, 'default.jpg', '$2y$10$EYHL90J3KjMLmTa1Jt6uLuoZfjaBc3TCVpnjumYpfw1B51dpDddvG', 2, 1, 1712589882),
(3, 'ID12024012', 'Staff FTIK', 'staff@gmail.com', 0, 'default.jpg', '$2y$10$EBQGemIClvXFCYbDhr/MLus6Ia8WFsXuL8Vg339fKkvwJ.C1/rKLa', 3, 1, 1712590051),
(4, 'ID12024013', 'Kepala Kantor', 'kepala@gmail.com', 0, 'default.jpg', '$2y$10$EJyLnHv8EceVwL0embnjrufnSFGLAJA366POUyxnC2COzyrubWPPm', 4, 1, 1712590083),
(5, 'ID12024014', 'Wakil Dekan', 'wakildekan@gmail.com', 0, 'default.jpg', '$2y$10$8feGSkVy5sinFx78k9zgwONIOEXrsQfQqlfX/x6fLv/LT5B.ZI/5W', 5, 1, 1712590105),
(6, 'ID12024015', 'Dekan', 'dekan@gmail.com', 0, 'default.jpg', '$2y$10$vnAGEYQlCBP12KEPAoDeDOgUCFfITYAo3FHospYUc3nIpwjoDq9AG', 6, 1, 1712590119),
(7, 'ID12024016', 'Dosen', 'dosen@gmail.com', 0, 'default.jpg', '$2y$10$3oDJn62KjFRQ5zL/GWRaBu5dA/qmE.6Wyvj6IahRPCa7Rx/ZkYjju', 7, 1, 1712590138),
(8, 'ID12024017', 'Administrator', 'admin@gmail.com', 0, '6481225432795d8cdf48f0f85800cf66.jpg', '$2y$10$F8CpuCu6rbllCPz0Il8f6.IrG1LJ0o3zTZmmo.YtrZy8NehFqZM3y', 1, 1, 1712666172),
(9, 'ID12024018', 'Mahasiswa 2', 'mahasiswa2@gmail.com', 0, 'default.jpg', '$2y$10$A8EHkAty.3KiNnaXggBrUev6Z709uK5TQqAX2EiRqephe76HrOy/.', 2, 1, 1713292224);

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
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(22, 'muhammadalfarizi041@gmail.com', 'Vpi4fSMrVv3k4o0o9Q4uHv0XWrmsQkZh13/cfKnZxo0=', 1713337443),
(26, 'opposepti115@gmail.com', 'iF9ByCFtN+Kl1rEYFDlOZHjUWQb4ub1c26tA5BUkwhw=', 1721279044);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `disposisi_surat`
--
ALTER TABLE `disposisi_surat`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menus`
--
ALTER TABLE `user_access_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menus`
--
ALTER TABLE `user_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menus`
--
ALTER TABLE `user_sub_menus`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `disposisi_surat`
--
ALTER TABLE `disposisi_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
