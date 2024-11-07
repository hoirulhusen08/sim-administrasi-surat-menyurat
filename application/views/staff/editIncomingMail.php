<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <h5 class="mt-4"><a style="text-decoration: none;" href="<?= base_url('staff/incomingMail'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>

    <form method="post" action="<?= base_url('staff/editIncomingMail?id=') . $this->input->get('id'); ?>" enctype="multipart/form-data">
        <div class="card shadow p-5 mb-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nomor_surat"><span style="color: red;">* </span>Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control <?= (form_error('nomor_surat') ? 'is-invalid' : '') ?>" id="nomor_surat" value="<?= $surat_masuk['nomor_surat']; ?>" placeholder="Nomor surat...">
                        <?= form_error('nomor_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat"><span style="color: red;">* </span>Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" value="<?= $surat_masuk['tanggal_surat']; ?>" class="form-control <?= (form_error('tanggal_surat') ? 'is-invalid' : '') ?>" id="tanggal_surat">
                        <?= form_error('tanggal_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="sumber_surat"><span style="color: red;">* </span>Sumber Surat</label>
                        <input type="text" name="sumber_surat" class="form-control <?= (form_error('sumber_surat') ? 'is-invalid' : '') ?>" id="sumber_surat" value="<?= $surat_masuk['sumber_surat']; ?>" placeholder="Sumber surat dari...">
                        <?= form_error('sumber_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="perihal"><span style="color: red;">* </span>Perihal</label>
                        <input type="text" name="perihal" class="form-control <?= (form_error('perihal') ? 'is-invalid' : '') ?>" id="perihal" value="<?= $surat_masuk['perihal']; ?>" placeholder="Perihal surat...">
                        <?= form_error('perihal', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lampiran"><span style="color: red;">* </span>Lampiran</label>
                                <input type="text" name="lampiran" class="form-control <?= (form_error('lampiran') ? 'is-invalid' : '') ?>" id="lampiran" value="<?= $surat_masuk['lampiran']; ?>" placeholder="Lampiran surat...">
                                <?= form_error('lampiran', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="penerima_surat"><span style="color: red;">* </span>Penerima Surat</label>
                                <input type="text" name="penerima_surat" class="form-control <?= (form_error('penerima_surat') ? 'is-invalid' : '') ?>" id="penerima_surat" value="<?= $surat_masuk['penerima_surat']; ?>" placeholder="Penerima surat...">
                                <?= form_error('penerima_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_klasifikasi"><span style="color: red;">* </span>Klasifikasi Surat</label>
                        <select name="id_klasifikasi" id="id_klasifikasi" class="form-control select2 <?= (form_error('id_klasifikasi') ? 'is-invalid' : '') ?>">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($klasifikasi_surat as $ks) : ?>
                                <option value="<?= $ks['id']; ?>" <?= set_select('id_klasifikasi', $ks['id'], $surat_masuk['id_klasifikasi'] == $ks['id']); ?>>
                                    <?= $ks['nama']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('id_klasifikasi', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Isi Surat / Pesan -->
            <div class="row">
                <div class="col-lg">
                    <div class="form-group">
                        <label for="isi_surat_masuk">
                            <span style="color: red;">* </span>Ringkasan Isi Surat
                            <?= form_error('isi_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                        </label>
                        <textarea name="isi_surat" class="form-control <?= (form_error('isi_surat') ? 'is-invalid' : '') ?>" id="isi_surat_masuk" rows="8" placeholder="Isi ringkasan isi surat..."><?= set_value('isi_surat'); ?> <?= $surat_masuk['isi_surat']; ?> </textarea>
                    </div>
                </div>
            </div>

            <script>
                // Inisialisasi CKEditor Iterfaces
                CKEDITOR.replace('isi_surat_masuk', {
                    filebrowserImageBrowseUrl: '<?= base_url('assets/vendor/ckeditor/kcfinder/browse.php'); ?>',
                });
            </script>
            <!-- End Isi Surat / Pesan -->

            <!-- Upload File -->
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="upload-file">
                        <label for="input-file" id="drop-area">
                            <input type="file" name="file_surat_masuk" accept=".pdf" id="input-file" hidden>
                            <div id="file-preview">
                                <img src="<?= base_url('assets/img/upload_file.png'); ?>">
                                <p>Tarik & Letakan atau klik disini <br> untuk Unggah File</p>
                                <span>Unggah File Surat Masuk Baru ? <br> ( Format yang didukung hanya PDF ) <br> dan maksimal ukuran file 5 MB.</span>
                            </div>
                            <div id="file-name"></div>
                        </label>
                    </div>
                </div>

                <div class="col-lg-6">
                    <iframe src="<?= base_url('assets/file/surat-masuk/') . $surat_masuk['file_surat_masuk']; ?>" width="100%" height="350"></iframe>
                </div>
            </div>
            <!-- End Upload File -->

            <div class="row mt-4">
                <div class="col text-right">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Perbarui Data</button>
                </div>
            </div>


        </div>
    </form>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->