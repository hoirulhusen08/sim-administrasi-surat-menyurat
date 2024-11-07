<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= form_error(
        'role',
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
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addNewRole"><i class="bi bi-folder-plus"></i> Tambah Peran Baru</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($roles as $role) : ?>
                            <tr>
                                <td><?= $i++ . "."; ?></td>
                                <td><?= $role['role']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/roleAccess/') . $role['id']; ?>" class="btn btn-sm btn-info mb-1"><i class="bi bi-pencil-square"></i> Akses</a>

                                    <a href="#" class="btn btn-sm btn-primary mb-1" data-toggle="modal" data-target="#editRole<?= $role['id']; ?>"><i class="bi bi-pencil-square"></i> Ubah</a>

                                    <?php if ($role['role'] === 'Administrator' || $role['role'] === 'Admin') : ?>
                                        <a href="#" id="notDeleteButtonAdmin" style="cursor: not-allowed;" class="btn btn-sm btn-danger" onclick="return false;"><i class="bi bi-trash3-fill"></i> Hapus</a>
                                    <?php else : ?>
                                        <a href="<?= base_url('admin/deleteRole/' . $role['id']); ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash3-fill"></i> Hapus</a>
                                    <?php endif; ?>
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
<div class="modal fade" id="addNewRole" tabindex="-1" aria-labelledby="addNewRoleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewRoleLabel">Tambah Peran Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/role'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="role" class="form-control <?= (form_error('role') ? 'is-invalid' : '') ?>" id="role" placeholder="Nama peran..." value="<?= set_value('role'); ?>">
                        <?= form_error('role', '<small class="text-danger pl-1">', '</small>'); ?>
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
<?php foreach ($roles as $role) : $no++; ?>
    <div class="modal fade" id="editRole<?= $role['id']; ?>" tabindex="-1" aria-labelledby="editRoleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleLabel">Perbarui Peran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('admin/editRole'); ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $role['id']; ?>">
                            <input type="text" name="role" class="form-control" id="role" placeholder="Nama peran..." value="<?= $role['role']; ?>">
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