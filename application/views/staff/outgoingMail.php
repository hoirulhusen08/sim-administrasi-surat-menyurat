<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= form_error(
        'menu',
        '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>',
        '</div>'
    ); ?>

    <?= $this->session->flashdata('message'); ?>

    <!-- Datatables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">
                <a class="btn btn-primary" href="<?= base_url('staff/addOutgoingMail'); ?>"><i class="bi bi-folder-plus"></i> Tambah Surat Keluar</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis Surat</th>
                            <th>No. Surat</th>
                            <th>Tgl. Dibuat</th>
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
                                    <!-- Status Surat -->
                                    <?php if ($sk['status'] == 0) : ?>
                                        <span class="badge badge-secondary">Diajukan</span>
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
                                    <a href="<?= base_url('staff/viewOutgoingMail?id=') . $sk['id']; ?>" class="btn btn-sm btn-info mb-1"><i class="bi bi-eye-fill"></i> Lihat</a>

                                    <a href="<?= base_url('staff/editOutgoingMail?id=') . $sk['id']; ?>" class="btn btn-sm btn-primary mb-1"><i class="bi bi-pencil-square"></i> Ubah</a>

                                    <?php if ($sk['status'] >= 4 || $sk['ttd'] == 1) : ?>
                                        <a href="<?= base_url('staff/deleteOutgoingMail?id=') . $sk['id']; ?>" id="notDeletedOutgoingMailApproved" style="cursor: not-allowed;" onclick="return false;" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash3-fill"></i> Hapus</a>
                                    <?php else : ?>
                                        <a href="<?= base_url('staff/deleteOutgoingMail?id=') . $sk['id']; ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash3-fill"></i> Hapus</a>
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