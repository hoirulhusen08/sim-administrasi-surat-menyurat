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
            <p class="m-0">Histori Pengajuan Surat : <strong><?= $user['name'] ?></strong></p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Jenis Surat</th>
                            <!-- <th>Keterangan</th> -->
                            <th>Sifat</th>
                            <th>Status</th>
                            <th>Berkas</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($histori_pengajuan as $histori) : ?>
                            <tr>
                                <td><?= $i++ . '.'; ?></td>
                                <td><?= $histori['name']; ?></td>
                                <td><?= $histori['jenis_surat']; ?></td>
                                <!-- <td><?= $histori['keterangan']; ?></td> -->
                                <td>
                                    <?php if ($histori['sifat'] == "Penting") : ?>
                                        <small class="badge badge-primary"><?= $histori['sifat'] ?></small>
                                    <?php elseif ($histori['sifat'] == "Mendesak") : ?>
                                        <small class="badge badge-danger"><?= $histori['sifat'] ?></small>
                                    <?php else : ?>
                                        <small class="badge badge-secondary"><?= $histori['sifat'] ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($histori['status'] == 0) : ?>
                                        <small class="badge badge-secondary">Belum Dibaca</small>
                                    <?php elseif ($histori['status'] == 1 && $histori['dilihat'] == 1) : ?>
                                        <small class="badge badge-info"><i class="bi bi-check-all"></i> Sudah Dibaca</small>
                                    <?php elseif ($histori['status'] == 2) : ?>
                                        <small class="badge badge-primary"><i class="bi bi-hourglass-split"></i> Sedang Diproses...</small>
                                    <?php elseif ($histori['status'] == 3) : ?>
                                        <small class="badge badge-success"><i class="bi bi-check-circle-fill"></i> Ready</small>
                                    <?php else : ?>
                                        <small class="badge badge-danger">Pengajuan Ditolak!</small>
                                        <a href="javascript:void(0);" type="button" data-toggle="modal" data-target="#modalDitolak<?= $histori['id']; ?>">
                                            <small class="badge badge-warning"><i class="bi bi-eye-fill"></i> Lihat Alasan?</small>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (empty($histori['berkas_pendukung'])) : ?>
                                        <span class="badge badge-secondary">Kosong!</span>
                                    <?php else :  ?>
                                        <a href="javascript:void(0);" type="button" data-toggle="modal" data-target="#modalBerkas<?= $histori['id']; ?>">
                                            <span class="btn btn-sm btn-success">
                                                <i class="bi bi-eye-fill"></i> Lihat
                                            </span>
                                        </a>
                                    <?php endif;  ?>
                                </td>
                                <td><?= date('d F Y', $histori['date_created']); ?></td>
                                <td>
                                    <div class="mb-2">
                                        <a href="<?= base_url('user/editHistorySubmission?id=') . $histori['id']; ?>" title="Ubah Histori">
                                            <span class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></span>
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <a href="<?= base_url('user/deleteHistorySubmission?id=') . $histori['id']; ?>" title="Hapus Histori" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <span class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Datatables -->


    <!-- Modal ALL -->
    <!-- Modal Pengajuan Ditolak -->
    <?php $no = 0; ?>
    <?php foreach ($histori_pengajuan as $histori) : $no++; ?>
        <div class="modal fade" id="modalDitolak<?= $histori['id']; ?>" tabindex="-1" aria-labelledby="modalDitolakLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDitolakLabel">
                <i class="bi bi-exclamation-circle-fill"></i> Alasan Penolakan
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?= $histori['catatan_penolakan']; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal Pengajuan Ditolak -->
    <?php $no = 0; ?>
    <?php foreach ($histori_pengajuan as $histori) : $no++; ?>
        <div class="modal fade" id="modalBerkas<?= $histori['id']; ?>" tabindex="-1" aria-labelledby="modalBerkasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBerkasLabel">Detail Berkas Pendukung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="col-lg">
                    <small class="m-0 p-0 text-muted"><i><?= $histori['jenis_surat']; ?></i></small>
                    <iframe src="<?= base_url('assets/file/berkas-pendukung/') . $histori['berkas_pendukung']; ?>" height="400" width="100%"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
        </div>
    <?php endforeach; ?>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->