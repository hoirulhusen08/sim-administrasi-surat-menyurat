<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Datatables -->
    <h5><a style="text-decoration: none;" href="<?= base_url('submission/listLetter'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>
    <div class="card shadow view-surat-masuk mb-4 p-4">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Atas Nama</th>
                                <th scope="col">Jenis Surat</th>
                                <th scope="col">Sifat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Diminta</th>
                                <th scope="col">Diperbarui</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $pengajuan_surat->nama_user; ?></td>
                                <td><?= $pengajuan_surat->jenis_surat; ?></td>
                                <td>
                                    <?php if ($pengajuan_surat->sifat == "Penting") : ?>
                                        <small class="badge badge-primary"><?= $pengajuan_surat->sifat ?></small>
                                    <?php elseif ($pengajuan_surat->sifat == "Mendesak") : ?>
                                        <small class="badge badge-danger"><?= $pengajuan_surat->sifat ?></small>
                                    <?php else : ?>
                                        <small class="badge badge-secondary"><?= $pengajuan_surat->sifat ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($pengajuan_surat->status == 0) : ?>
                                        <small class="badge badge-secondary">Belum Dibaca</small>
                                    <?php elseif ($pengajuan_surat->status == 1 && $pengajuan_surat->dilihat == 1) : ?>
                                        <small class="badge badge-info"><i class="bi bi-check-all"></i> Sudah Dibaca</small>
                                    <?php elseif ($pengajuan_surat->status == 2) : ?>
                                        <small class="badge badge-primary"><i class="bi bi-hourglass-split"></i> Sedang Diproses...</small>
                                    <?php elseif ($pengajuan_surat->status == 3) : ?>
                                        <small class="badge badge-success"><i class="bi bi-check-circle-fill"></i> Selesai</small>
                                    <?php else : ?>
                                        <small class="badge badge-danger">Pengajuan Ditolak!</small>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d F Y', $pengajuan_surat->date_created); ?></td>
                                <td>
                                    <?php if (!empty($pengajuan_surat->date_updated)) : ?>
                                        <?= date('d F Y', $pengajuan_surat->date_updated); ?>
                                    <?php else : ?>
                                        <span>Belum pernah diperbarui</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr class="m-0 mb-4 p-0">

        <div class="row justify-content-between">
            <div class="col-lg-6 mb-4">
                <!-- <div class="card">
                    <div class="card-header">
                        <p class="m-0 p-0"><strong>Keterangan Pemohon Surat</strong></p>
                    </div>
                    <div class="card-body">
                        <p class="m-0 p-0"><?= $pengajuan_surat->keterangan; ?></p>
                    </div>
                </div>

                <hr class="mt-4 p-0"> -->

                <div class="row mt-4">
                    <div class="col-lg">
                        <form method="post" action="<?= base_url('submission/updateStatusPengajuan?id=') . $pengajuan_surat->id; ?>">
                            <div class="form-group">
                            <label for="status"><strong><span style="color:red;">*</span> Status Pengajuan Surat</strong></label>
                            <select name="status" id="status" class="form-control <?= (form_error('status') ? 'is-invalid' : '') ?>" required <?= ($pengajuan_surat->status == '3' ? 'disabled' : '') ?>>
                                <option value="">-- Ubah Status Surat --</option>
                                <option value="2" <?= set_select('status', '2', ($pengajuan_surat->status == '2')); ?>>Sedang Diproses</option>
                                <option value="3" <?= set_select('status', '3', ($pengajuan_surat->status == '3')); ?>>Proses Selesai</option>
                                <option value="4" <?= set_select('status', '4', ($pengajuan_surat->status == '4')); ?>>Pengajuan Ditolak</option>
                            </select>
                                <?= form_error('status', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>

                            <div class="form-group" id="catatanPenolakan">
                                <label for="catatan_penolakan"><strong>Catatan Penolakan</strong></label>
                                <textarea name="catatan_penolakan" rows="5" id="catatan_penolakan" class="form-control <?= (form_error('catatan_penolakan') ? 'is-invalid' : '') ?>" placeholder="Tulis catatan atas penolakan..."></textarea>
                                <?= form_error('catatan_penolakan', '<small class="text-danger pl-1">', '</small>'); ?>
                                <small class="text-muted"><strong>Histori Catatan :</strong> <?= $pengajuan_surat->catatan_penolakan; ?></small>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-sm btn-primary mt-3" <?= ($pengajuan_surat->status == '3' ? 'disabled' : '') ?>><i class="bi bi-send"></i> Update Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- File Uploaded Surat Masuk -->
            <?php if (!empty($pengajuan_surat->berkas_pendukung)) : ?>
                <div class="col-lg-6 preview-file">
                    <small class="head-title d-block">Preview Berkas Pendukung Pemohon Surat</small>
                    <iframe src="<?= base_url('assets/file/berkas-pendukung/') . $pengajuan_surat->berkas_pendukung; ?>" width="100%" height="300"></iframe>
                </div>
            <?php else : ?>
                <div class="col-lg-5" style="display: flex; flex-direction: column; align-items: center;">
                    <p class="text-center mt-3">Tidak ada file <strong>Berkas Pendukung</strong> yang diupload. <br> <small>(File akan muncul di bagian ini jika ada).</small></p>

                    <div class="row" style="align-self: center;">
                        <img src="<?= base_url('assets/img/search.png') ?>" alt="Image" style="width:70px;border:none;">
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <!-- End Datatables -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Hide or Uh-Hide textarea catatan_penolakan -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectStatus = document.getElementById('status');
        const catatanPenolakan = document.getElementById('catatanPenolakan');

        // Function to show or hide catatan penolakan based on select value
        function toggleCatatanPenolakan() {
            if (selectStatus.value === '4') {
                catatanPenolakan.style.display = 'block';
            } else {
                catatanPenolakan.style.display = 'none';
            }
        }

        // Initial check on page load
        toggleCatatanPenolakan();

        // Add event listener for select change
        selectStatus.addEventListener('change', function() {
            toggleCatatanPenolakan();
        });
    });
</script>
