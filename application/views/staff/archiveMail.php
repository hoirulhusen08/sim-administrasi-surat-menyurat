<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="container-fluid">
        <!-- Baris untuk judul halaman dan form filter -->
        <div class="row align-items-center mb-2">
            <!-- Kolom untuk judul halaman -->
            <div class="col-lg-8">
                <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
            </div>
            <!-- Kolom untuk form filter -->
            <div class="col-lg-4">
                <form method="post" action="<?= base_url('staff/archiveMail'); ?>" class="mb-4 d-flex align-items-end">
                    <div class="form-group flex-grow-1 mr-2 mb-0">
                        <label for="filter_jenis_surat" class="mb-0">Filter Jenis Surat:</label>
                        <select name="filter_jenis_surat" id="filter_jenis_surat" class="form-control">
                            <option value="">Semua Jenis Surat</option>
                            <option value="Surat Masuk">Surat Masuk</option>
                            <option value="Surat Keluar">Surat Keluar</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>
    </div>



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
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold">
                    <a class="btn btn-primary" href="<?= base_url('staff/addArchive'); ?>"><i class="bi bi-folder-plus"></i> Tambah Arsip</a>
                </h6>
            </div>
            <div class="col-md-6">
                <form method="post" action="<?= base_url('staff/archiveMail'); ?>" class="d-flex">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Cari berdasarkan (Judul dan No. Surat)">
                    <!-- tambahkan tombol cari di sini jika diperlukan -->
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row archive-container">
                <?php foreach ($arsip_surat as $arsip) : ?>
                    <div class="col-md-3 mb-4">
                        <a href="<?= base_url('staff/detailArchive?id=' . $arsip->id); ?>" class="archive-item">
                            <div class="card card-archive text-center">
                                <span class="lable-archive"><small><?= date('d F Y', $arsip->date_created); ?></small></span>
                                <i class="bi bi-file-earmark-pdf mt-3"></i>
                                <small class="text-muted"><?= $arsip->no_surat; ?></small>
                                <p><strong><?= $arsip->judul_surat; ?></strong></p>
                            </div>
                        </a>

                        <a href="<?= base_url('staff/editArchive?id=' . $arsip->id); ?>" class="bg-primary text-white btn-edit-archive"><small><i class="bi bi-pencil-square"></i></small></a>

                        <a href="<?= base_url('staff/deleteArchive?id=' . $arsip->id); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="bg-danger text-white btn-edit-archive"><small><i class="bi bi-trash"></i></small></a>
                    </div>
                <?php endforeach; ?>

                <!-- Jika pencarian kosong -->
                <?php if (isset($pesan)) : ?>
                    <div class="col-lg-12 text-center" role="alert">
                        <?= $pesan; ?> <br>
                        <a href="<?= base_url('staff/archiveMail'); ?>" class="btn btn-sm btn-primary mt-2"><i class="bi bi-arrow-clockwise"></i> Kembali</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <!-- End Datatables -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->