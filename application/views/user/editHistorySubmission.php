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

    <h5 class="mt-4"><a style="text-decoration: none;" href="<?= base_url('user/submissionHistory'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>

    <!-- Content -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <p class="m-0">Data Pengajuan Surat : <strong><?= $pengajuan_surat['jenis_surat'] ?></strong></p>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('user/editHistorySubmission?id=') . $this->input->get('id'); ?>" enctype="multipart/form-data">
                <div class="row justify-content-between">
                    <div class="col-lg-7">
                        <div class="form-group">
                            <select name="jenis_surat" id="jenis_surat" class="form-control <?= (form_error('jenis_surat') ? 'is-invalid' : '') ?>" onchange="updateSifat()">
                                <option value="">-- Pilih Jenis Surat --</option>
                                <?php foreach ($jenis_surat as $row) : ?>
                                    <option id="nilaiJenisSurat" value="<?= $row['jenis'] ?>" <?= set_select('jenis_surat', $row['jenis'], ($pengajuan_surat['jenis_surat'] == $row['jenis'])); ?>>
                                        <?= $row['jenis'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('jenis_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <select name="sifat" id="sifat" class="form-control <?= (form_error('sifat') ? 'is-invalid' : '') ?>">
                                <option value="">-- Pilih Sifat Surat --</option>
                                <option value="Penting" <?= set_select('sifat', 'Penting', ($pengajuan_surat['sifat'] == 'Penting')); ?>>Penting</option>
                                <option value="Biasa" <?= set_select('sifat', 'Biasa', ($pengajuan_surat['sifat'] == 'Biasa')); ?>>Biasa</option>
                            </select>
                            <?= form_error('sifat', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>

                        <!-- <div class="form-group">
                            <textarea name="keterangan" rows="5" id="keterangan" class="form-control <?= (form_error('keterangan') ? 'is-invalid' : '') ?>" placeholder="Keterangan pengajuan..."><?= $pengajuan_surat['keterangan'] ?></textarea>
                            <?= form_error('keterangan', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div> -->

                        <div class="row mb-4" id="fileUploadContainer">
                            <div class="col-lg-10">
                                <div class="custom-file">
                                    <input type="file" name="berkas_pendukung" accept=".jpeg,.jpg,.png" class="custom-file-input" id="berkas_pendukung">
                                    <label class="custom-file-label" for="berkas_pendukung">Berkas Pendukung Baru...</label>
                                    <small class="text-muted">*Tidak wajib diisi. (Format harus JPEG, JPG atau PNG dengan ukuran maks. 5MB)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($pengajuan_surat['berkas_pendukung'])) : ?>
                        <div class="col-lg-5 preview-file">
                            <small class="head-title d-block">Preview Berkas Pendukung Lama</small>
                            <iframe src="<?= base_url('assets/file/berkas-pendukung/') . $pengajuan_surat['berkas_pendukung']; ?>" height="400" width="100%"></iframe>
                        </div>
                    <?php else : ?>
                        <div class="col-lg-5 preview-file">
                            <small class="head-title d-block">Preview Berkas Pendukung Lama</small>
                            <p class="text-center mt-3">Anda belum mengunggah file <strong>Berkas Pendukung</strong>. <br> <small>(File akan muncul dibagian ini).</small></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Perbarui Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Sifat Surat Otomatis -->
<script>
    function updateSifat() {
        const jenisSurat = document.getElementById('jenis_surat').value;
        const sifatSelect = document.getElementById('sifat');

        // Reset nilai sifat
        sifatSelect.value = '';

        switch (jenisSurat) {
            case 'KET. (Surat Keterangan)':
                sifatSelect.value = 'Biasa';
                break;
            case 'KEP. (Surat Keputusan Dosen Pembimbing Akademik)':
                sifatSelect.value = 'Penting';
                break;
            case 'IZN. (Surat Izin Pra-Penelitian)':
                sifatSelect.value = 'Biasa';
                break;
            case 'IZN. (Surat Izin Penelitian)':
                sifatSelect.value = 'Biasa';
                break;
            case 'KEP. (Surat Keputusan Penunjukan Sebagai Pembimbing Skripsi)':
                sifatSelect.value = 'Penting';
                break;
            case 'KEP. (Surat Keputusan Penunjukan Sebagai Pembahas SEMHAS)':
                sifatSelect.value = 'Penting';
                break;
            case 'KEP. (Surat Keputusan Dosen Penanggung Jawab dan Pengampu Mata Kuliah)':
                sifatSelect.value = 'Penting';
                break;
            case 'KEP. (Surat Keputusan Panitia dan Pengawas Ujian Akhir)':
                sifatSelect.value = 'Penting';
                break;
            case 'URD. (Surat Undangan Rapat Dosen)':
                sifatSelect.value = 'Biasa';
                break;
            case 'PPG. (Surat Permohonan Peminjaman Gedung)':
                sifatSelect.value = 'Biasa';
                break;
            default:
                sifatSelect.value = '';
                break;
        }
    }
</script>

<!-- Form Inputan Berkas Pendukung -->
<script>
    document.getElementById("jenis_surat").addEventListener("change", function() {
        let jenisSuratKet = document.getElementById("nilaiJenisSurat").selected;
        let fileUploadContainer = document.getElementById("fileUploadContainer");

        if (jenisSuratKet === true) {
            fileUploadContainer.style.display = "block";
        } else {
            fileUploadContainer.style.display = "none";
        }
    });
</script>