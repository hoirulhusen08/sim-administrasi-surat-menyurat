<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <!-- Datatables -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Surat</th>
                            <th>Tanggal</th>
                            <th>Sumber</th>
                            <th>Perihal</th>
                            <th>Penerima</th>
                            <th>Status</th>
                            <th>Sifat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($surat_masuk as $sm) : ?>
                            <?php if ($sm['status'] > 1) : ?>
                                <tr>
                                    <td><?= $i++ . "."; ?></td>
                                    <td><?= $sm['nomor_surat']; ?></td>
                                    <td><?= $sm['tanggal_surat']; ?></td>
                                    <td><?= $sm['sumber_surat']; ?></td>
                                    <td><?= $sm['perihal']; ?></td>
                                    <td><?= $sm['penerima_surat']; ?></td>
                                    <td>
                                        <?php if ($sm['status'] == 0) : ?>
                                            <span class="badge badge-secondary">Belum Dicek</span>
                                        <?php elseif ($sm['status'] == 1) : ?>
                                            <span class="badge badge-danger"><i class="bi bi-arrow-left-circle-fill"></i> Revisi</span>
                                        <?php elseif ($sm['status'] == 2) : ?>
                                            <span class="badge badge-info"><i class="bi bi-exclamation-triangle-fill"></i> Butuh Persetujuan</span>
                                        <?php elseif ($sm['status'] == 3) : ?>
                                            <span class="badge badge-success">Menunggu TTD</span>
                                        <?php elseif ($sm['status'] == 4) : ?>
                                            <span class="badge badge-success">Disetujui <i class="bi bi-check2-all"></i></span>
                                        <?php elseif ($sm['status'] == 5) : ?>
                                            <span class="badge badge-success">Terdisposisi <i class="bi bi-check2-all"></i></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Klasifikasi Surat -->
                                        <?php if ($sm['nama_klasifikasi'] == 'Penting' || $sm['nama_klasifikasi'] == 'Segera') : ?>
                                            <span class="badge badge-danger"><i class="bi bi-info-circle-fill"></i> <?= $sm['nama_klasifikasi']; ?></span>
                                        <?php elseif ($sm['nama_klasifikasi'] == 'Penting dan Rahasia' || $sm['nama_klasifikasi'] == 'Penting Dan Rahasia') : ?>
                                            <span class="badge badge-info"><i class="bi bi-info-circle-fill"></i> <?= $sm['nama_klasifikasi']; ?></span>
                                        <?php elseif ($sm['nama_klasifikasi'] == 'Rahasia') : ?>
                                            <span class="badge badge-warning"><i class="bi bi-info-circle-fill"></i> <?= $sm['nama_klasifikasi']; ?></span>
                                        <?php else : ?>
                                            <span class="badge badge-secondary"><i class="bi bi-info-circle-fill"></i> <?= $sm['nama_klasifikasi']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('wakildekan/viewIncomingMail?id=') . $sm['id']; ?>" class="btn btn-sm btn-info mb-1"><i class="bi bi-eye-fill"></i> Lihat</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Datatables -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->