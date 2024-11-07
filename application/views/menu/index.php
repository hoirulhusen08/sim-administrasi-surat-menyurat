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
            <h6 class="m-0 font-weight-bold">
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addNewMenu"><i class="bi bi-folder-plus"></i> Tambah Menu Baru</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menus as $menu) : ?>
                            <tr>
                                <td><?= $i++ . "."; ?></td>
                                <td><?= $menu['menu']; ?></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary mb-1" data-toggle="modal" data-target="#editMenu<?= $menu['id']; ?>"><i class="bi bi-pencil-square"></i> Ubah</a>
                                    <a href="<?= base_url('menu/deleteMenu/' . $menu['id']); ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash3-fill"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Datatables -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- MODAL ADD NEW MENU -->
<div class="modal fade" id="addNewMenu" tabindex="-1" aria-labelledby="addNewMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewMenuLabel">Tambah Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('menu'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="menu" class="form-control <?= (form_error('menu') ? 'is-invalid' : '') ?>" id="menu" placeholder="Nama menu..." value="<?= set_value('menu'); ?>">
                        <?= form_error('menu', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT MENU -->
<?php $no = 0; ?>
<?php foreach ($menus as $menu) : $no++; ?>
    <div class="modal fade" id="editMenu<?= $menu['id']; ?>" tabindex="-1" aria-labelledby="editMenuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMenuLabel">Perbarui Nama Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('menu/editMenu'); ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $menu['id']; ?>">
                            <input type="text" name="menu" class="form-control" id="menu" placeholder="Nama menu..." value="<?= $menu['menu']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>