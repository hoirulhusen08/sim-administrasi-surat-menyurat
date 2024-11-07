<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>Upss...</strong> ada kesalahan saat input data, cek kembali!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Datatables -->
    <h5><a style="text-decoration: none;" href="<?= base_url('wakildekan/incomingMail'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>
    <div class="card shadow mb-4 p-4">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No. Surat</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Lampiran</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><?= $lihat_surat_masuk['nomor_surat']; ?></th>
                                <td><?= $lihat_surat_masuk['tanggal_surat']; ?></td>
                                <td><?= $lihat_surat_masuk['perihal']; ?></td>
                                <td><?= $lihat_surat_masuk['lampiran']; ?></td>
                                <td>
                                    <?php if ($lihat_surat_masuk['status'] == 0) : ?>
                                        <span class="badge badge-secondary">Belum Dicek</span>
                                    <?php elseif ($lihat_surat_masuk['status'] == 1) : ?>
                                        <span class="badge badge-danger"><i class="bi bi-arrow-left-circle-fill"></i> Dikembalikan (Revisi)</span>
                                    <?php elseif ($lihat_surat_masuk['status'] == 2) : ?>
                                        <span class="badge badge-info"><i class="bi bi-exclamation-triangle-fill"></i> Butuh Persetujuan</span>
                                    <?php elseif ($lihat_surat_masuk['status'] == 3) : ?>
                                        <span class="badge badge-success">Menunggu TTD </span>
                                    <?php elseif ($lihat_surat_masuk['status'] == 4) : ?>
                                        <span class="badge badge-success">Disetujui <i class="bi bi-check2-all"></i></span>
                                    <?php elseif ($lihat_surat_masuk['status'] == 5) : ?>
                                        <span class="badge badge-success">Terdisposisi <i class="bi bi-check2-all"></i></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr class="m-0 mb-4 p-0">
        <div class="row surat-masuk">
            <div class="col-lg-6 mb-4">
                <p class="head-title">Surat diinput pada : <?= date('d F Y', $lihat_surat_masuk['date_created']); ?></p>
                <div class="card p-3 rounded-0">
                    <div class="kop-surat">
                        <p><strong>Sumber Dari :</strong> <?= $lihat_surat_masuk['sumber_surat']; ?></p>
                        <p><strong>Penerima Surat :</strong> <?= $lihat_surat_masuk['penerima_surat']; ?></p>
                        <p><strong>Sifat :</strong>
                            <!-- Klasifikasi Surat -->
                            <?php if ($lihat_surat_masuk['nama_klasifikasi'] == 'Penting' || $lihat_surat_masuk['nama_klasifikasi'] == 'Segera') : ?>
                                <span class="badge badge-danger"><i class="bi bi-info-circle-fill"></i> <?= $lihat_surat_masuk['nama_klasifikasi']; ?></span>
                            <?php elseif ($lihat_surat_masuk['nama_klasifikasi'] == 'Penting dan Rahasia' || $lihat_surat_masuk['nama_klasifikasi'] == 'Penting Dan Rahasia') : ?>
                                <span class="badge badge-info"><i class="bi bi-info-circle-fill"></i> <?= $lihat_surat_masuk['nama_klasifikasi']; ?></span>
                            <?php elseif ($lihat_surat_masuk['nama_klasifikasi'] == 'Rahasia') : ?>
                                <span class="badge badge-warning"><i class="bi bi-info-circle-fill"></i> <?= $lihat_surat_masuk['nama_klasifikasi']; ?></span>
                            <?php else : ?>
                                <span class="badge badge-secondary"><i class="bi bi-info-circle-fill"></i> <?= $lihat_surat_masuk['nama_klasifikasi']; ?></span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <p class="head-title">Lakukan Validasi Surat Disini</p>
                    <div class="isi-surat">
                        <label class="mb-0">Isi Ringkasan Surat Masuk :</label>
                        <p><?= $lihat_surat_masuk['isi_surat']; ?></p>
                        <hr>
                        <form method="post" action="<?= base_url('wakildekan/viewIncomingMail?id=') . $lihat_surat_masuk['id']; ?>">
                            <div class="form-group">
                                <label for="status"><span style="color:red;">*</span> Status Surat <small>(Wajib)</small></label>
                                <select name="status" id="status" class="form-control <?= (form_error('status') ? 'is-invalid' : '') ?>" <?= ($lihat_surat_masuk['status'] >= 4) ? 'disabled' : ''; ?>>
                                    <option value="">-- Pilih Surat --</option>
                                    <option value="0" hidden>Belum Dicek</option>
                                    <option value="1">Kembalikan (Revisi)</option>
                                    <option value="2" hidden>Teruskan (Proses Dilanjutkan)</option>
                                    <option value="3">Teruskan (Minta TTD)</option>
                                    <option value="4" hidden>Beri Izin TTD (ACC)</option>
                                </select>
                                <?= form_error('status', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <p><small><strong>Histori Tindak Lanjut :</strong><br> <?= $lihat_surat_masuk['tindak_lanjut']; ?></small></p>

                                    <p><small><strong>Histori Catatan :</strong><br> <?= $lihat_surat_masuk['catatan']; ?></small></p>

                                    <div class="close">
                                        <i class="bi bi-info-circle"></i>
                                    </div>
                                </div>

                                <label for="tindak_lanjut">Beri Tindak Lanjut <small>(Optional)</small></label>
                                <textarea name="tindak_lanjut" class="form-control <?= (form_error('tindak_lanjut') ? 'is-invalid' : '') ?>" id="tindak_lanjut" rows="4" placeholder="Beri pesan tindakan lanjut baru..." <?= ($lihat_surat_masuk['status'] >= 4) ? 'disabled' : ''; ?>></textarea>
                                <?= form_error('tindak_lanjut', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="catatan">Beri Catatan <small>(Optional)</small></label>
                                <textarea name="catatan" class="form-control" id="catatan" rows="4" placeholder="Beri catatan baru..." <?= ($lihat_surat_masuk['status'] >= 4) ? 'disabled' : ''; ?>></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary" <?= ($lihat_surat_masuk['status'] >= 4) ? 'disabled' : ''; ?>><i class="bi bi-send"></i> Perbarui Hasil Validasi</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- File Uploaded Surat Masuk -->
            <div class="col-lg-6 preview-file lead">
                <small class="head-title d-block">Preview untuk Surat Masuk</small>
                <iframe src="<?= base_url('assets/file/surat-masuk/') . $lihat_surat_masuk['file_surat_masuk']; ?>"></iframe>
            </div>
        </div>
    </div>
    <!-- End Datatables -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->