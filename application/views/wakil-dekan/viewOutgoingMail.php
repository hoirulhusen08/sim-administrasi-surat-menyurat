<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Datatables -->
    <h5><a style="text-decoration: none;" href="<?= base_url('wakildekan/outgoingMail'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>
    <div class="card shadow mb-5 p-4">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Jenis Surat</th>
                                <th scope="col">No. Surat</th>
                                <th scope="col">Tgl. Dibuat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Sifat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $lihat_surat_keluar['jenis']; ?></td>
                                <td><?= $lihat_surat_keluar['nomor_surat']; ?></td>
                                <td><?= date('d F Y', $lihat_surat_keluar['date_created']); ?></td>
                                <td>
                                    <!-- Status Surat -->
                                    <?php if ($lihat_surat_keluar['status'] == 0) : ?>
                                        <span class="badge badge-secondary">Belum Dicek</span>
                                    <?php elseif ($lihat_surat_keluar['status'] == 1) : ?>
                                        <span class="badge badge-danger"><i class="bi bi-pencil-square"></i> Dikembalikan (Revisi)</span>
                                    <?php elseif ($lihat_surat_keluar['status'] == 2) : ?>
                                        <span class="badge badge-info">Proses Dilanjutkan <i class="bi bi-arrow-right-circle-fill"></i></span>
                                    <?php elseif ($lihat_surat_keluar['status'] == 3) : ?>
                                        <span class="badge badge-success">Menunggu TTD</span>
                                    <?php elseif ($lihat_surat_keluar['status'] == 4) : ?>
                                        <span class="badge badge-success">Disetujui <i class="bi bi-check2-all"></i></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Klasifikasi Surat -->
                                    <?php if ($lihat_surat_keluar['nama_klasifikasi'] == 'Penting' || $lihat_surat_keluar['nama_klasifikasi'] == 'Segera') : ?>
                                        <span class="badge badge-danger"><i class="bi bi-info-circle-fill"></i> <?= $lihat_surat_keluar['nama_klasifikasi']; ?></span>
                                    <?php elseif ($lihat_surat_keluar['nama_klasifikasi'] == 'Penting dan Rahasia' || $lihat_surat_keluar['nama_klasifikasi'] == 'Penting Dan Rahasia') : ?>
                                        <span class="badge badge-info"><i class="bi bi-info-circle-fill"></i> <?= $lihat_surat_keluar['nama_klasifikasi']; ?></span>
                                    <?php elseif ($lihat_surat_keluar['nama_klasifikasi'] == 'Rahasia') : ?>
                                        <span class="badge badge-warning"><i class="bi bi-info-circle-fill"></i> <?= $lihat_surat_keluar['nama_klasifikasi']; ?></span>
                                    <?php else : ?>
                                        <span class="badge badge-secondary"><i class="bi bi-info-circle-fill"></i> <?= $lihat_surat_keluar['nama_klasifikasi']; ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr class="m-0 mb-4 p-0">

        <div class="row">
            <div class="col-lg-4">
                <?php if (!empty($lihat_surat_keluar['tentang_surat'])) : ?>
                    <p>Tentang Surat : <?= $lihat_surat_keluar['tentang_surat']; ?></p>
                <?php endif; ?>
                <?php if ($lihat_surat_keluar['tgl_pelaksanaan'] != '0000-00-00') : ?>
                    <p>Tanggal Pelaksanaan : <?= $lihat_surat_keluar['tgl_pelaksanaan']; ?></p>
                <?php endif; ?>
                <?php if (!empty($lihat_surat_keluar['perihal'])) : ?>
                    <p>Perihal : <?= $lihat_surat_keluar['perihal']; ?></p>
                <?php endif; ?>
                <?php if (!empty($lihat_surat_keluar['lampiran'])) : ?>
                    <p>Lampiran : <?= $lihat_surat_keluar['lampiran']; ?></p>
                <?php endif; ?>
                <?php if (!empty($lihat_surat_keluar['penerima_surat'])) : ?>
                    <p>Penerima Surat : <?= $lihat_surat_keluar['penerima_surat']; ?></p>
                <?php endif; ?>
                <?php if (!empty($lihat_surat_keluar['alamat_tujuan'])) : ?>
                    <p>Alamat Tujuan : <?= $lihat_surat_keluar['alamat_tujuan']; ?></p>
                <?php endif; ?>
                <?php if (!empty($lihat_surat_keluar['nama_mahasiswa'])) : ?>
                    <p>Nama Mahasiswa : <?= $lihat_surat_keluar['nama_mahasiswa']; ?></p>
                <?php endif; ?>
                <?php if (!empty($lihat_surat_keluar['npm'])) : ?>
                    <p>NPM Mahasiswa : <?= $lihat_surat_keluar['npm']; ?></p>
                <?php endif; ?>
                <?php if (!empty($lihat_surat_keluar['semester'])) : ?>
                    <p>Semester : <?= $lihat_surat_keluar['semester']; ?></p>
                <?php endif; ?>
                <?php if (!empty($lihat_surat_keluar['tahun_akademik'])) : ?>
                    <p>Tahun Akademik : <?= $lihat_surat_keluar['tahun_akademik']; ?></p>
                <?php endif; ?>
            </div>
            <div class="col-lg-8">
                <div class="alert alert-warning" role="alert">
                    <h5 class="text-uppercase font-weight-bold mb-4 mt-2">Lakukan Validasi Surat Disini :</h5>
                    <hr class="border-dark">
                    <form method="post" action="<?= base_url('wakildekan/viewOutgoingMail?id=') . $lihat_surat_keluar['id']; ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="status"><span style="color:red;">*</span> Status Surat <small>(Wajib diisi)</small></label>
                                    <select name="status" id="status" class="form-control <?= (form_error('status') ? 'is-invalid' : '') ?>" <?= ($lihat_surat_keluar['status'] >= 4) ? 'disabled' : ''; ?>>
                                        <option value="">-- Pilih Surat --</option>
                                        <option value="0" hidden>Belum Dicek</option>
                                        <option value="1">Kembalikan (Revisi)</option>
                                        <option value="2" hidden>Teruskan (Proses Dilanjutkan)</option>
                                        <option value="3">Teruskan (Minta TTD)</option>
                                        <option value="4" hidden>Beri Izin TTD (ACC)</option>
                                    </select>
                                    <?= form_error('status', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="tindak_lanjut">Tindakan Lanjut <small>(Tidak wajib)</small></label>
                                    <textarea rows="4" name="tindak_lanjut" class="form-control <?= (form_error('tindak_lanjut') ? 'is-invalid' : '') ?>" id="tindak_lanjut" placeholder="Tindak lanjut yang harus dilakukan..." <?= ($lihat_surat_keluar['status'] >= 4) ? 'disabled' : ''; ?>><?= set_value('tindak_lanjut'); ?></textarea>
                                    <?= form_error('tindak_lanjut', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Catatan Penting <small>(Tidak wajib)</small></label>
                                    <textarea rows="4" name="catatan" class="form-control <?= (form_error('catatan') ? 'is-invalid' : '') ?>" id="catatan" placeholder="Berikan catatan jika ada..." <?= ($lihat_surat_keluar['status'] >= 4) ? 'disabled' : ''; ?>><?= set_value('catatan'); ?></textarea>
                                    <?= form_error('catatan', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="alert alert-info" role="alert">
                                    <label class="m-0"><strong>Histori Tindak Lanjut sebelumnya :</strong></label>
                                    <p><?= $lihat_surat_keluar['tindak_lanjut']; ?></p>

                                    <label class="m-0"><strong>Histori Catatan sebelumnya :</strong></label>
                                    <p><?= $lihat_surat_keluar['catatan']; ?></p>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" <?= ($lihat_surat_keluar['status'] >= 4) ? 'disabled' : ''; ?>><i class="bi bi-send"></i> Kirim Validasi</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-7">
                <div class="alert alert-secondary" role="alert">
                    <h5 class="text-uppercase font-weight-bold mb-4 mt-2">Isi Surat Keluar :</h5>
                    <hr class="border-dark">
                    <p><?= $lihat_surat_keluar['isi_surat']; ?></p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="alert alert-secondary" role="alert">
                    <h5 class="text-uppercase font-weight-bold mb-4 mt-2">Catatan Kaki :</h5>
                    <hr class="border-dark">
                    <p><?= $lihat_surat_keluar['catatan_kaki']; ?></p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg">
                <div class="alert alert-secondary" role="alert">
                    <h5 class="text-uppercase font-weight-bold mb-4 mt-2">Lampiran Surat Keluar :</h5>
                    <hr class="border-dark">
                    <p><?= $lihat_surat_keluar['isi_lampiran']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Datatables -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->