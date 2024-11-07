<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 m-0 text-gray-800"><?= $title; ?></h1>
    <h4 class="m-0 mb-4"><small>Daftar Surat yang telah Disetujui</small></h4>

    <?= $this->session->flashdata('message'); ?>

    <!-- Datatables -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis Surat</th>
                            <th>No. Surat</th>
                            <th>Tgl. Dibuat</th>
                            <th>Teruntuk</th>
                            <th>Status</th>
                            <th>Sifat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($surat_keluar as $sk) : ?>
                            <tr>
                                <td><?= $i++ . "."; ?></td>
                                <td><?= $sk['jenis']; ?></td>
                                <td><?= $sk['nomor_surat']; ?></td>
                                <td><?= date('d F Y', $sk['date_created']); ?></td>
                                <td>
                                    <?php if (!empty($sk['nama_mahasiswa'])) : ?>
                                        <span><?= $sk['nama_mahasiswa']; ?></span>
                                    <?php else : ?>
                                        <span class="badge badge-primary">Dosen</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Status Surat -->
                                    <?php if ($sk['status'] == 0) : ?>
                                        <span class="badge badge-secondary">Belum Dicek</span>
                                    <?php elseif ($sk['status'] == 1) : ?>
                                        <span class="badge badge-danger"><i class="bi bi-pencil-square"></i> Revisi</span>
                                    <?php elseif ($sk['status'] == 2) : ?>
                                        <span class="badge badge-info">Dilanjutkan <i class="bi bi-arrow-right-circle-fill"></i></span>
                                    <?php elseif ($sk['status'] == 3) : ?>
                                        <span class="badge badge-success">Menunggu TTD</span>
                                    <?php elseif ($sk['status'] == 4) : ?>
                                        <span class="badge badge-success">Disetujui <i class="bi bi-check2-all"></i></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Klasifikasi Surat -->
                                    <?php if ($sk['nama_klasifikasi'] == 'Penting' || $sk['nama_klasifikasi'] == 'Segera') : ?>
                                        <span class="badge badge-danger"><i class="bi bi-info-circle-fill"></i> <?= $sk['nama_klasifikasi']; ?></span>
                                    <?php elseif ($sk['nama_klasifikasi'] == 'Penting dan Rahasia' || $sk['nama_klasifikasi'] == 'Penting Dan Rahasia') : ?>
                                        <span class="badge badge-info"><i class="bi bi-info-circle-fill"></i> <?= $sk['nama_klasifikasi']; ?></span>
                                    <?php elseif ($sk['nama_klasifikasi'] == 'Rahasia') : ?>
                                        <span class="badge badge-warning"><i class="bi bi-info-circle-fill"></i> <?= $sk['nama_klasifikasi']; ?></span>
                                    <?php else : ?>
                                        <span class="badge badge-secondary"><i class="bi bi-info-circle-fill"></i> <?= $sk['nama_klasifikasi']; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($sk['id_jenis_surat'] == '1') : ?>
                                        <a href="<?= base_url('dosen/downloadOutgoingMailPDF1?id=') . $sk['id']; ?>" class="btn btn-sm btn-primary mb-1"><i class="bi bi-download"></i> Unduh</a>
                                    <?php elseif ($sk['id_jenis_surat'] == '2') : ?>
                                        <a href="<?= base_url('dosen/downloadOutgoingMailPDF2?id=') . $sk['id']; ?>" class="btn btn-sm btn-secondary mb-1"><i class="bi bi-download"></i> Unduh</a>
                                    <?php elseif ($sk['id_jenis_surat'] == '3') : ?>
                                        <a href="<?= base_url('dosen/downloadOutgoingMailPDF3?id=') . $sk['id']; ?>" class="btn btn-sm btn-success mb-1"><i class="bi bi-download"></i> Unduh</a>
                                    <?php elseif ($sk['id_jenis_surat'] == '4') : ?>
                                        <a href="<?= base_url('dosen/downloadOutgoingMailPDF4?id=') . $sk['id']; ?>" class="btn btn-sm btn-danger mb-1"><i class="bi bi-download"></i> Unduh</a>
                                    <?php elseif ($sk['id_jenis_surat'] == '5') : ?>
                                        <a href="<?= base_url('dosen/downloadOutgoingMailPDF5?id=') . $sk['id']; ?>" class="btn btn-sm btn-warning mb-1"><i class="bi bi-download"></i> Unduh</a>
                                    <?php elseif ($sk['id_jenis_surat'] == '6') : ?>
                                        <a href="<?= base_url('dosen/downloadOutgoingMailPDF6?id=') . $sk['id']; ?>" class="btn btn-sm btn-info mb-1"><i class="bi bi-download"></i> Unduh</a>
                                    <?php elseif ($sk['id_jenis_surat'] == '7') : ?>
                                        <a href="<?= base_url('dosen/downloadOutgoingMailPDF7?id=') . $sk['id']; ?>" class="btn btn-sm btn-dark mb-1"><i class="bi bi-download"></i> Unduh</a>
                                    <?php elseif ($sk['id_jenis_surat'] == '8') : ?>
                                        <a href="<?= base_url('dosen/downloadOutgoingMailPDF8?id=') . $sk['id']; ?>" class="btn btn-sm btn-light border mb-1"><i class="bi bi-download"></i> Unduh</a>
                                    <?php elseif ($sk['id_jenis_surat'] == '9') : ?>
                                        <a href="<?= base_url('dosen/downloadOutgoingMailPDF9?id=') . $sk['id']; ?>" class="btn btn-sm btn-warning mb-1"><i class="bi bi-download"></i> Unduh</a>
                                    <?php elseif ($sk['id_jenis_surat'] == '10') : ?>
                                        <a href="<?= base_url('dosen/downloadOutgoingMailPDF10?id=') . $sk['id']; ?>" class="btn btn-sm btn-info mb-1"><i class="bi bi-download"></i> Unduh</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
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