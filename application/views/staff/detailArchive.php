<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Datatables -->
    <h5><a style="text-decoration: none;" href="<?= base_url('staff/archiveMail'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>
    <div class="card shadow view-surat-masuk mb-4 p-4">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Jenis Surat</th>
                                <th scope="col">Judul Surat</th>
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Tanggal Diarsipkan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $arsip_surat['jenis_surat']; ?></td>
                                <td><?= $arsip_surat['judul_surat']; ?></td>
                                <td><?= $arsip_surat['no_surat']; ?></td>
                                <td><?= date('d F Y', $arsip_surat['date_created']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr class="m-0 mb-4 p-0">

        <div class="row surat-masuk">
            <div class="col-lg-6 mb-4">
                <p class="head-title">Ringkasan Isi Surat</p>
                <p class="mt-3"><?= $arsip_surat['ringkasan_surat']; ?></p>
            </div>

            <!-- File Uploaded Surat Masuk -->
            <div class="col-lg-6 preview-file">
                <small class="head-title d-block">Preview Surat Terarsip</small>
                <iframe src="<?= base_url('assets/file/arsip/') . $arsip_surat['file']; ?>"></iframe>
            </div>
        </div>
    </div>
    <!-- End Datatables -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->