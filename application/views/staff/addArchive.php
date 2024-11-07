<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <h5 class="mt-4"><a style="text-decoration: none;" href="<?= base_url('staff/archiveMail'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>

    <form method="post" action="<?= base_url('staff/addArchive'); ?>" enctype="multipart/form-data">
        <div class="card shadow p-5 mb-5">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Input type hidden -->
                    <div class="form-group">
                        <label for="jenis_surat">Kode Arsip</label>
                        <input type="text" name="kode_arsip" class="form-control" value="<?= $kode_arsip; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="jenis_surat"><span style="color: red;">* </span>Jenis Surat</label>
                        <select name="jenis_surat" id="jenis_surat" class="form-control <?= (form_error('jenis_surat') ? 'is-invalid' : '') ?>">
                            <option value="">-- Pilih --</option>
                            <option value="Surat Masuk">Surat Masuk</option>
                            <option value="Surat Keluar">Surat Keluar</option>
                        </select>
                        <?= form_error('jenis_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="no_surat"><span style="color: red;">* </span>Nomor Surat</label>
                        <input type="text" name="no_surat" class="form-control <?= (form_error('no_surat') ? 'is-invalid' : '') ?>" id="no_surat" value="<?= set_value('no_surat'); ?>" placeholder="Nomor surat...">
                        <?= form_error('no_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="judul_surat"><span style="color: red;">* </span>Judul Surat</label>
                        <input type="text" name="judul_surat" class="form-control <?= (form_error('judul_surat') ? 'is-invalid' : '') ?>" id="judul_surat" value="<?= set_value('judul_surat'); ?>" placeholder="Judul surat...">
                        <?= form_error('judul_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="ringkasan_surat"><span style="color: red;">* </span>Ringkasan Surat</label>
                        <textarea name="ringkasan_surat" id="ringkasan_surat" class="form-control <?= (form_error('ringkasan_surat') ? 'is-invalid' : '') ?>" placeholder="Isi ringkasan surat..."><?= set_value('ringkasan_surat'); ?></textarea>
                        <?= form_error('ringkasan_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Upload File -->
                    <div class="upload-file">
                        <label for="input-file" id="drop-area">
                            <input type="file" name="file" accept=".pdf" id="input-file" hidden>
                            <div id="file-preview">
                                <img src="<?= base_url('assets/img/upload_file.png'); ?>">
                                <p>Tarik & Letakan atau klik disini <br> untuk Unggah File</p>
                                <span>Unggah File Surat <br> ( Format yang didukung hanya PDF ) <br> dan maksimal ukuran file 5 MB.</span>
                            </div>
                            <div id="file-name"></div>
                        </label>
                    </div>
                    <!-- End Upload File -->
                </div>
            </div>

            <hr>

            <div class="row mt-4">
                <div class="col text-right">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Arsipkan Data</button>
                </div>
            </div>

        </div>
    </form>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->