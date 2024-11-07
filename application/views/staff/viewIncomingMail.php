<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Datatables -->
    <h5><a style="text-decoration: none;" href="<?= base_url('staff/incomingMail'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>
    <div class="card shadow view-surat-masuk mb-4 p-4">
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
                                        <span class="badge badge-secondary">Diajukan</span>
                                    <?php elseif ($lihat_surat_masuk['status'] == 1) : ?>
                                        <span class="badge badge-danger"><i class="bi bi-pencil-square"></i> Dikembalikan (Revisi)</span>
                                    <?php elseif ($lihat_surat_masuk['status'] == 2) : ?>
                                        <span class="badge badge-info">Proses Dilanjutkan <i class="bi bi-arrow-right-circle-fill"></i></span>
                                    <?php elseif ($lihat_surat_masuk['status'] == 3) : ?>
                                        <span class="badge badge-success">Menunggu TTD</span>
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
                    <p class="head-title">Isi Ringkasan Surat Masuk</p>
                    <div class="isi-surat">
                        <p><?= $lihat_surat_masuk['isi_surat']; ?></p>
                        <hr>
                        <p><strong>Tindak Lanjut :</strong> <?= $lihat_surat_masuk['tindak_lanjut']; ?></p>
                        <p><strong>Catatan :</strong> <?= $lihat_surat_masuk['catatan']; ?></p>
                    </div>
                </div>
            </div>

            <!-- File Uploaded Surat Masuk -->
            <div class="col-lg-6 preview-file">
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