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

    <!-- Content -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('report'); ?>">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="jenis_surat"><span style="color: red;">* </span>Jenis Surat</label>
                            <select name="jenis_surat" id="jenis_surat" class="form-control <?= (form_error('jenis_surat') ? 'is-invalid' : '') ?>">
                                <option value="">-- Pilih --</option>
                                <option value="Surat Masuk" <?= ($jenis_surat == 'Surat Masuk' ? 'selected' : '') ?>>Surat Masuk</option>
                                <option value="Surat Keluar" <?= ($jenis_surat == 'Surat Keluar' ? 'selected' : '') ?>>Surat Keluar</option>
                            </select>
                            <?= form_error('jenis_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="from_date"><span style="color: red;">* </span>Dari Tanggal</label>
                            <input type="date" name="from_date" class="form-control <?= (form_error('from_date') ? 'is-invalid' : '') ?>" id="from_date" value="<?= $from_date ?>">
                            <?= form_error('from_date', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="to_date"><span style="color: red;">* </span>Sampai Tanggal</label>
                            <input type="date" name="to_date" class="form-control <?= (form_error('to_date') ? 'is-invalid' : '') ?>" id="to_date" value="<?= $to_date ?>">
                            <?= form_error('to_date', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-lg-2 align-self-end">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </form>

            <hr class="mb-5">

            <!-- Tabel untuk menampilkan hasil pencarian -->
            <?php if(!empty($results)) : ?>
            <!-- <div class="row" style="position:absolute;z-index:9999;left:200px;">
                <div class="col-lg-12">
                    <a href="<?= base_url('lead/printAllReport?jenis_surat=' . urlencode($jenis_surat) . '&from_date=' . urlencode($from_date) . '&to_date=' . urlencode($to_date)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-printer-fill"></i> Cetak Semua</a>
                </div>
            </div> -->
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Jenis Surat</th>
                            <th>No. Surat</th>
                            <th>Tgl. Dibuat</th>
                            <th>
                                <?php if (!empty($results) && $results[0]['jenis_surat'] == "Surat Masuk") : ?>
                                    Penerima
                                <?php else : ?>
                                    Tujuan
                                <?php endif; ?>
                            </th>
                            <th>Perihal</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari database akan ditampilkan di sini -->
                        <?php foreach ($results as $index => $result): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $result['jenis_surat'] ?></td>
                                <td><?= $result['nomor_surat'] ?></td>
                                <td><?= date('d F Y', $result['date_created']) ?></td>
                                <?php if($result['jenis_surat'] == 'Surat Keluar') : ?>
                                    <td><?= $result['alamat_tujuan'] ?></td>
                                <?php else : ?>
                                    <td><?= $result['penerima_surat'] ?></td>
                                <?php endif; ?>
                                <td><?= $result['perihal'] ?></td>
                                <!-- <td><a href="<?= base_url('lead/printReport?id=') . $result['id'] . '&jenis_surat=' . urlencode($result['jenis_surat']); ?>" class="btn btn-sm btn-info"><i class="bi bi-printer-fill"></i> Cetak</a></td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Content -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->