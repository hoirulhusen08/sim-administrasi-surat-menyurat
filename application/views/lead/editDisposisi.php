<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <h5><a style="text-decoration: none;" href="<?= base_url('lead/listDisposisi'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>

    <!-- Disposisi -->
    <form method="post" action="">
        <div class="card p-3 mb-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="kode_disposisi">Kode Disposisi</label>
                        <input type="text" name="kode_disposisi" class="form-control <?= (form_error('kode_disposisi') ? 'is-invalid' : '') ?>" id="kode_disposisi" value="<?= $disposisi_surat['kode_disposisi'] ?>" readonly>
                        <?= form_error('kode_disposisi', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="tujuan">Tujuan</label>
                        <input type="text" name="tujuan" class="form-control <?= (form_error('tujuan') ? 'is-invalid' : '') ?>" id="tujuan" value="<?= $disposisi_surat['tujuan'] ?>" placeholder="Ditujukan kepada siapa...">
                        <?= form_error('tujuan', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="departemen">Departemen</label>
                                <input type="text" name="departemen" class="form-control <?= (form_error('departemen') ? 'is-invalid' : '') ?>" id="departemen" value="<?= $disposisi_surat['departemen'] ?>" placeholder="Untuk departemen apa...">
                                <?= form_error('departemen', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="batas_waktu">Batas Waktu</label>
                                <input type="date" name="batas_waktu" class="form-control <?= (form_error('batas_waktu') ? 'is-invalid' : '') ?>" id="batas_waktu" value="<?= $disposisi_surat['batas_waktu'] ?>" placeholder="Batas waktu pelaksanaan...">
                                <?= form_error('batas_waktu', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tindakan">Tindakan</label>
                        <textarea name="tindakan" class="form-control <?= (form_error('tindakan') ? 'is-invalid' : '') ?>" id="tindakan" rows="2" placeholder="Tindakan yang harus dilakukan..."> <?= $disposisi_surat['tindakan'] ?> </textarea>
                        <?= form_error('tindakan', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan <small>(Tak Wajib)</small></label>
                        <textarea name="catatan" class="form-control <?= (form_error('catatan') ? 'is-invalid' : '') ?>" id="catatan" rows="4" placeholder="Catatan penting disini..."> <?= $disposisi_surat['catatan'] ?> </textarea>
                        <?= form_error('catatan', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary float-right"><i class="bi bi-send"></i> Ubah Data</button>
                </div>
            </div>
        </div>
    </form>
    <!-- End Disposisi -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->