<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $title; ?></h1>
    <p class="mb-4">Selamat datang, <strong><?= $user['name']; ?></strong></p>

    <div class="row text-center">
        <div class="col-md-3 mb-3">
            <a class="card-info-dashboard" href="<?= base_url('admin/manageAllUser'); ?>">
                <div class="card my-border">
                    <div class="card-body">
                        <h5 class="card-title display-4"><i class="bi bi-people-fill"></i></h5>
                        <p class="card-text">Pengguna <strong><?php echo $users_count; ?></strong></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a class="card-info-dashboard" href="javascript:void(0)" onclick="alert('Peran Admin tidak memiliki akses ke Data ini!\nFitur ini hanya menampilkan total dari Data terkait saja.')">
                <div class="card my-border">
                    <div class="card-body">
                        <h5 class="card-title display-4"><i class="bi bi-envelope-fill"></i></i></h5>
                        <p class="card-text">Surat Masuk <strong><?php echo $surat_masuk_count; ?></strong></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a class="card-info-dashboard" href="javascript:void(0)" onclick="alert('Peran Admin tidak memiliki akses ke Data ini!\nFitur ini hanya menampilkan total dari Data terkait saja.')">
                <div class="card my-border">
                    <div class="card-body">
                        <h5 class="card-title display-4"><i class="bi bi-envelope-paper-fill"></i></i></h5>
                        <p class="card-text">Surat Keluar <strong><?php echo $surat_keluar_count; ?></strong></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a class="card-info-dashboard" href="javascript:void(0)" onclick="alert('Peran Admin tidak memiliki akses ke Data ini!\nFitur ini hanya menampilkan total dari Data terkait saja.')">
                <div class="card my-border">
                    <div class="card-body">
                        <h5 class="card-title display-4"><i class="bi bi-archive-fill"></i></h5>
                        <p class="card-text">Arsip Surat <strong><?php echo $arsip_surat_count; ?></strong></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->