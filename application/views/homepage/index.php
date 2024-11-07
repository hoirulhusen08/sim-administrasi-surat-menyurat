<!-- Nabbar -->
<section id="navbar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#toTop">
                <img src="<?= base_url('assets/img/setting/') . $setting['logo']; ?>" width="30" height="30" class="d-inline-block align-top" alt="">
                <span><?= $setting['web_title']; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list menu-humberger"></i>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link btn-menu" href="#toTop">Beranda</a>
                    <li class="nav-item">
                        <a class="nav-link btn-menu" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-menu" href="#features">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-menu" href="#contact">Kontak</a>
                    </li>
                    <?php if ($this->session->userdata('email')) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn-logged" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                <img class="rounded-circle" width="20" src="<?= base_url('assets/img/profile/') . $user['image']; ?>"> Akun
                            </a>
                            <div class="dropdown-menu" style="border: 2px solid #fff; margin-top: 8px;">
                                <div class="box-dropdown" style="border: 1px solid #eaeaea;">
                                    <div class="dropdown-after-login" style="background-color:#1EA5EC;margin-top:-8px;padding:8px;color:#fff;font-weight:bolder;">
                                        <p class="text-center m-0 p-0">Hi, <?= $user['name'] ?></p>
                                        <p class="text-center m-0 p-0">
                                            <small>
                                                <?php if ($this->session->userdata('role_id') == 1) : ?>
                                                    (Administrator)
                                                <?php elseif ($this->session->userdata('role_id') == 2) : ?>
                                                    (Mahasiswa)
                                                <?php elseif ($this->session->userdata('role_id') == 3) : ?>
                                                    (Staf FTIK)
                                                <?php elseif ($this->session->userdata('role_id') == 4) : ?>
                                                    (Kepala Kantor)
                                                <?php elseif ($this->session->userdata('role_id') == 5) : ?>
                                                    (Wakil Dekan)
                                                <?php elseif ($this->session->userdata('role_id') == 6) : ?>
                                                    (Dekan)
                                                <?php elseif ($this->session->userdata('role_id') == 7) : ?>
                                                    (Dosen)
                                                <?php endif; ?>
                                            </small>
                                        </p>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('user'); ?>"><i class="bi bi-person-circle"></i> Profil Saya</a>

                                    <?php if ($this->session->userdata('role_id') == 2) : ?>
                                        <a class="dropdown-item" href="#pengajuan"><i class="bi bi-envelope-plus-fill"></i> Ajukan Surat</a>
                                    <?php endif; ?>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="bi bi-box-arrow-left"></i> Keluar</a>
                                </div>
                            </div>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="btn btn-danger btn-login" href="<?= base_url('auth'); ?>"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>

<!-- Banner -->
<section id="banner" class="bg-primary text-white">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url('assets/img/banner.jpeg'); ?>" class="d-block w-100" alt="Image">
                <div class="carousel-caption d-sm-block">
                    <h5><?= $setting['tagline']; ?></h5>
                    <p><?= $setting['caption']; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <section id="banner" class="bg-primary text-white">
    <div class="banner d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="title"><?= $setting['tagline']; ?></h4>
                    <p class="caption"><?= $setting['caption']; ?></p>
                    <a href="#contact" class="btn btn-warning help-desk"><i class="bi bi-question-circle-fill"></i> Pusat Bantuan</a>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- Pengajuan Surat -->
<?php if ($this->session->userdata('role_id') == 2) : ?> <!-- Jika role mahasiswa -->
    <section id="pengajuan" class="mb-5">
        <div class="container">
            <div class="card text-center mt-5 p-5">
                <i class="bi bi-envelope-arrow-up" style="font-size: 50px;"></i>
                <h2 class="mb-4">Form Pengajuan Surat</h2>
                <small class="text-muted mb-3" style="margin-top: -20px;">Dengan Pemohon yaitu : <?= $user['name'] ?></small>

                <?= form_error(
                    'menu',
                    '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>',
                    '</div>'
                ); ?>

                <?= $this->session->flashdata('message'); ?>

                <form method="post" action="<?= base_url('/'); ?>" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <!-- Id pengguna tipe hidden -->
                        <input type="hidden" name="id" class="form-control" value="<?= $this->session->userdata('user_id'); ?>">
                        <!-- Kode Pengajuan tipe hidden -->
                        <input type="hidden" name="kode_pengajuan" class="form-control" value="<?= $kode_pengajuan; ?>">

                        <div class="col-lg-8">
                            <div class="form-group">
                                <select id="containerJenisSurat" name="jenis_surat" id="jenis_surat" class="form-control <?= (form_error('jenis_surat') ? 'is-invalid' : '') ?>" onchange="updateSifat()">
                                    <option value="">-- Pilih Jenis Surat --</option>
                                    <?php foreach ($jenis_surat as $row) : ?>
                                        <option value="<?= $row['jenis'] ?>" id="jenisSuratKet">
                                            <?= $row['jenis'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                </select>
                                <?= form_error('jenis_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <!-- <select name="sifat" id="sifat" class="form-control <?= (form_error('sifat') ? 'is-invalid' : '') ?>">
                                    <option value="">-- Pilih Sifat Surat --</option>
                                    <option value="Penting">Penting</option>
                                    <option value="Biasa">Biasa</option>
                                </select> -->
                                <input type="text" name="sifat" id="sifat" class="form-control <?= (form_error('sifat') ? 'is-invalid' : '') ?>" readonly>
                                <?= form_error('sifat', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                            <!-- <div class="form-group">
                                <textarea name="keterangan" rows="5" id="keterangan" class="form-control <?= (form_error('keterangan') ? 'is-invalid' : '') ?>" placeholder="Keterangan pengajuan..."><?= set_value('keterangan'); ?></textarea>
                                <?= form_error('keterangan', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div> -->

                            <div class="row" id="fileUploadContainer" style="display:none;">
                                <div class="col-lg-8">
                                    <div class="custom-file">
                                        <input type="file" name="berkas_pendukung" accept=".jpeg,.jpg,.png,.pdf" class="custom-file-input" id="berkas_pendukung">
                                        <label class="custom-file-label" for="berkas_pendukung">Berkas Pendukung...</label>
                                        <small class="text-muted">*Tidak wajib diisi. (Format harus PDF, JPEG, JPG atau PNG dengan ukuran maks. 5MB)</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Sifat Surat Otomatis -->
                            <script>
                                function updateSifat() {
                                    const jenisSurat = document.getElementById('containerJenisSurat').value;
                                    const sifatSelect = document.getElementById('sifat');

                                    // Reset nilai sifat
                                    sifatSelect.value = '';

                                    switch (jenisSurat) {
                                        case 'KET. (Surat Keterangan)':
                                            sifatSelect.value = 'Biasa';
                                            break;
                                        case 'KEP. (Surat Keputusan Dosen Pembimbing Akademik)':
                                            sifatSelect.value = 'Penting';
                                            break;
                                        case 'IZN. (Surat Izin Pra-Penelitian)':
                                            sifatSelect.value = 'Biasa';
                                            break;
                                        case 'IZN. (Surat Izin Penelitian)':
                                            sifatSelect.value = 'Biasa';
                                            break;
                                        case 'KEP. (Pengajuan Surat Keputusan Judul Tugas Akhir)':
                                            sifatSelect.value = 'Penting';
                                            break;
                                        case 'KEP. (Surat Keputusan Penunjukan Sebagai Pembahas SEMHAS)':
                                            sifatSelect.value = 'Penting';
                                            break;
                                        case 'KEP. (Surat Keputusan Dosen Penanggung Jawab dan Pengampu Mata Kuliah)':
                                            sifatSelect.value = 'Penting';
                                            break;
                                        case 'KEP. (Surat Keputusan Panitia dan Pengawas Ujian Akhir)':
                                            sifatSelect.value = 'Penting';
                                            break;
                                        case 'URD. (Surat Undangan Rapat Dosen)':
                                            sifatSelect.value = 'Biasa';
                                            break;
                                        case 'PPG. (Surat Permohonan Peminjaman Gedung)':
                                            sifatSelect.value = 'Biasa';
                                            break;
                                        default:
                                            sifatSelect.value = '';
                                            break;
                                    }
                                }
                            </script>

                            <!-- Form Inputan Berkas Pendukung -->
                            <script>
                                document.getElementById("containerJenisSurat").addEventListener("change", function() {
                                    let jenisSuratKet = document.getElementById("containerJenisSurat");
                                    let fileUploadContainer = document.getElementById("fileUploadContainer");

                                    if (jenisSuratKet.value == "KEP. (Pengajuan Surat Keputusan Judul Tugas Akhir)" || jenisSuratKet.value == "KET. (Surat Keterangan)") {
                                        fileUploadContainer.style.display = "block";
                                    } else {
                                        fileUploadContainer.style.display = "none";
                                    }
                                });
                            </script>

                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-right">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Kirim Pengajuan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- About -->
<div id="about">
    <div class="container">
        <h2 class="text-center mb-4">Sekilas Info Tentang Kami</h2>
        <div class="row text-center justify-content-center">
            <div class="col-md-5">
                <p><?= $setting['info_web_p1']; ?></p>
            </div>
            <div class="col-md-5">
                <p><?= $setting['info_web_p2']; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Features -->
<section id="features">
    <div class="container">
        <h2 class="text-center mb-4">Apa Yang Kami Tawarkan?</h2>
        <div class="row text-center">
            <div class="col-md-4 features">
                <img src="<?= base_url('assets/img/work.png'); ?>" class="img-fluid" alt="Image">
                <h4>Tidak Antri</h4>
                <p>Proses pengajuan surat menyurat tanpa antrian, memberikan fleksibilitas dan efisiensi dalam proses administrasi.</p>
            </div>
            <div class="col-md-4 features">
                <img src="<?= base_url('assets/img/package.png'); ?>" class="img-fluid" alt="Image">
                <h4>Basis Digital</h4>
                <p>Penyelenggaraan surat menyurat secara digital, mempermudah pengelolaan dan akses informasi dengan cepat.</p>
            </div>
            <div class="col-md-4 features">
                <img src="<?= base_url('assets/img/search.png'); ?>" class="img-fluid" alt="Image">
                <h4>Akses Mudah</h4>
                <p>Kemudahan akses dan pencarian informasi surat menyurat secara langsung dan cepat, mengurangi hambatan.</p>
            </div>
        </div>
    </div>
</section>

<!-- WorkFlow -->
<svg class="wave-top-workflow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#eaeaea" fill-opacity="1" d="M0,288L48,277.3C96,267,192,245,288,218.7C384,192,480,160,576,170.7C672,181,768,235,864,256C960,277,1056,267,1152,240C1248,213,1344,171,1392,149.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
</svg>
<div id="workflow">
    <div class="container">
        <h2 class="text-center mb-4">Alur Kerja Sistem Kami</h2>
        <div class="row">
            <div class="col">
                <img src="<?= base_url('assets/img/setting/') . $setting['image_workflow']; ?>" class="img-fluid img-thumbnail" alt="Image">
            </div>
        </div>
    </div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#eaeaea" fill-opacity="1" d="M0,224L48,202.7C96,181,192,139,288,144C384,149,480,203,576,218.7C672,235,768,213,864,197.3C960,181,1056,171,1152,176C1248,181,1344,203,1392,213.3L1440,224L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
</svg>

<!-- Contact -->
<div id="contact">
    <div class="container">
        <div class="contact-head text-center">
            <h2>Hubungi Kami</h2>

            <p>Untuk bertanya terkait kendala apapun itu, dapat menghubungi pada Pusat Bantuan dibawah ini.</p>
            <a href="https://wa.me/<?= $setting['whatsapp']; ?>" target="_blank" class="btn btn-sm btn-success ml-2 mr-2 mb-2"><i class="bi bi-whatsapp"></i> Via WhatsApp</a>

            <a href="mailto:<?= $setting['email']; ?>" target="_blank" class="btn btn-sm btn-danger ml-2 mr-2 mb-2"><i class="bi bi-envelope-check"></i> Via Email</a>
            
            <a href="<?= $setting['web']; ?>" target="_blank" class="btn btn-sm btn-primary ml-2 mr-2 mb-2"><i class="bi bi-globe"></i> Web Official</a>

            <hr class="mb-4">
        </div>
        <div class="row contact">
            <div class="col-md">
                <div class="card p-4 mb-3">
                    <h4 class="mb-3">Informasi Lainnya Dari Kami :</h4>
                    <!-- Info Instansi -->
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">Telp/Fax</th>
                                <td>:</td>
                                <td><?= $setting['telp_or_fax']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Instansi</th>
                                <td>:</td>
                                <td><?= $setting['institution_name']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Fakultas</th>
                                <td>:</td>
                                <td><?= $setting['faculty_name']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Prodi</th>
                                <td>:</td>
                                <td><?= $setting['prodi_name']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Info Instansi -->

                    <p class="mb-4 mt-2 text-center"><?= $setting['address']; ?></p>
                    <iframe src="<?= $setting['url_maps']; ?>" height="400" style="border:0;" allowfullscreen="yes" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>