<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar <?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <!-- Datatables -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Disposisi</th>
                            <th>No. Surat</th>
                            <th>Tujuan</th>
                            <th>Departemen</th>
                            <th>Sifat</th>
                            <th>Batas Waktu</th>
                            <th>Dibuat</th>
                            <th>Tindakan & Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($disposisi_surat as $ds) : ?>
                            <tr>
                                <td><?= $i++ . "."; ?></td>
                                <td><?= $ds['kode_disposisi']; ?></td>
                                <td>
                                    <?php if (!empty($ds['nomor_surat'])) : ?>
                                        <?= $ds['nomor_surat']; ?>
                                    <?php else : ?>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#pesanPeringatanNoSurat" title="Lihat">
                                            <span class="badge badge-warning"><i class="bi bi-exclamation-triangle-fill"></i> Warning</span>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td><?= $ds['tujuan']; ?></td>
                                <td><?= $ds['departemen']; ?></td>
                                <td>
                                    <?php if (!empty($ds['nama'])) : ?>
                                        <?= $ds['nama']; ?>
                                    <?php else : ?>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#pesanPeringatanKlasifikasiSurat" title="Lihat">
                                            <span class="badge badge-warning"><i class="bi bi-exclamation-triangle-fill"></i> Warning</span>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td><?= $ds['batas_waktu']; ?></td>
                                <td><?= date('d F Y', $ds['date_created']); ?></td>
                                <td class="text-center"><a href="javascript:void(0)" data-toggle="modal" data-target="#disposisiTindakanCatatanModal-<?= $ds['id']; ?>">Lihat</a></td>
                                <td>
                                    <a href="<?= base_url('lead/editDisposisi?id=') . $ds['id']; ?>" class="btn btn-sm btn-primary mb-1"><i class="bi bi-pencil-square"></i> Ubah</a>

                                    <a href="<?= base_url('lead/disposisiPDF?id=') . $ds['id']; ?>" class="btn btn-sm btn-danger mb-1"><i class="bi bi-file-earmark-pdf-fill"></i> Ekspor PDF</a>
                                </td>
                            </tr>

                            <!-- Modal Tindakan dan Catatan -->
                            <div class="modal fade" id="disposisiTindakanCatatanModal-<?= $ds['id']; ?>" tabindex="-1" aria-labelledby="disposisiTindakanCatatanModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="disposisiTindakanCatatanModalLabel">Pesan Tindakan dan Catatan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Tindakan :</strong> <?= $ds['tindakan']; ?></p>
                                            <p><strong>Catatan :</strong> <?= $ds['catatan']; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Datatables -->

    <!-- Modal Warning Nomor Surat Tidak Ditemukan -->
    <div class="modal fade" id="pesanPeringatanNoSurat" tabindex="-1" aria-labelledby="pesanPeringatanNoSuratLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pesanPeringatanNoSuratLabel">Pesan Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        <p><strong><i class="bi bi-exclamation-triangle-fill"></i> Upss...</strong> Nomor Surat tidak ditemukan, ada yang berusaha menghapus paksa Data Surat terkait dari Database!</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Warning Klasifikasi Surat Tidak Ditemukan -->
    <div class="modal fade" id="pesanPeringatanKlasifikasiSurat" tabindex="-1" aria-labelledby="pesanPeringatanKlasifikasiSuratLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pesanPeringatanKlasifikasiSuratLabel">Pesan Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        <p><strong><i class="bi bi-exclamation-triangle-fill"></i> Upss...</strong> Klasifikasi Surat atau Sifat Surat tidak ditemukan, ada yang berusaha menghapus paksa Data terkait dari Database!</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->