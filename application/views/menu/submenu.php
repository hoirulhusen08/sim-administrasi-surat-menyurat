<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>Upss...</strong> ada kesalahan saat input data!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?= $this->session->flashdata('message'); ?>

    <!-- Datatables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addNewSubmenu"><i class="bi bi-folder-plus"></i> Tambah Submenu Baru</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Menu</th>
                            <th>URL</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($subMenus as $subMenu) : ?>
                            <tr>
                                <td><?= $i++ . "."; ?></td>
                                <td><a href="<?= base_url('') . $subMenu['url']; ?>"><?= $subMenu['title']; ?></a></td>
                                <td><?= $subMenu['menu']; ?></td>
                                <td><?= $subMenu['url']; ?></td>
                                <td><i class="<?= $subMenu['icon']; ?>"></i> <?= $subMenu['icon']; ?></td>
                                <td>
                                    <?php if ($subMenu['is_active'] == 1) : ?>
                                        <p class="badge badge-success" title="Aktif"><i class="bi bi-check-circle-fill"></i> On</p>
                                    <?php elseif ($subMenu['is_active'] == 0) : ?>
                                        <p class="badge badge-danger" title="Tidak Aktif"><i class="bi bi-x-circle-fill"></i> Off</p>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary mb-1" data-toggle="modal" data-target="#editSubmenu<?= $subMenu['id']; ?>"><i class="bi bi-pencil-square"></i> Ubah</a>
                                    <a href="<?= base_url('menu/deleteSubmenu/' . $subMenu['id']); ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash3-fill"></i> Hapus</a>
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

<!-- MODAL ADD NEW SUB-MENU -->
<div class="modal fade" id="addNewSubmenu" tabindex="-1" aria-labelledby="addNewSubmenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewSubmenuLabel">Tambah Submenu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('menu/subMenu'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control <?= (form_error('title') ? 'is-invalid' : '') ?>" id="title" placeholder="Nama submenu..." value="<?= set_value('title'); ?>">
                        <?= form_error('title', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control <?= (form_error('menu_id') ? 'is-invalid' : '') ?>">
                            <option value="">-- Pilih Menu --</option>
                            <?php foreach ($menus as $menu) : ?>
                                <option value="<?= $menu['id']; ?>" <?= set_select('menu_id', $menu['id']); ?>>
                                    <?= $menu['menu']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('menu_id', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" name="url" class="form-control <?= (form_error('url') ? 'is-invalid' : '') ?>" id="url" placeholder="URL submenu..." value="<?= set_value('url'); ?>">
                        <?= form_error('url', '<small class="text-danger pl-1">', '</small>'); ?>
                        <small class="pl-1">Skema URL : <strong>controller/method</strong>. Contoh URL : <strong>admin/editUser</strong></small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="icon" class="form-control <?= (form_error('icon') ? 'is-invalid' : '') ?>" id="icon" placeholder="Icon submenu..." value="<?= set_value('icon'); ?>">
                        <?= form_error('icon', '<small class="text-danger pl-1">', '</small>'); ?>
                        <small class="pl-1">Gunakan Icon dari <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons ini.</a> Contoh : <strong>bi bi-whatsapp</strong></small>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0"> <!-- Nilai default saat checkbox tidak dicentang -->
                            <input type="checkbox" name="is_active" class="form-check-input" value="1" id="is_active" <?= set_checkbox('is_active', '1', TRUE) ?>>
                            <label for="is_active" class="form-check-label">Aktifkan ?</label>
                        </div>
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

<!-- MODAL EDIT SUB-MENU -->
<?php $no = 0; ?>
<?php foreach ($subMenus as $subMenu) : $no++; ?>
    <div class="modal fade" id="editSubmenu<?= $subMenu['id']; ?>" tabindex="-1" aria-labelledby="editSubmenuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubmenuLabel">Edit Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('menu/editSubmenu'); ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $subMenu['id']; ?>">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" id="title" placeholder="Nama submenu..." value="<?= $subMenu['title']; ?>">
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">-- Pilih Menu --</option>
                                <?php foreach ($menus as $menu) : ?>
                                    <option value="<?= $menu['id']; ?>" <?= set_select('menu_id', $menu['id'], $subMenu['menu_id'] == $menu['id']); ?>>
                                        <?= $menu['menu']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="url" class="form-control" id="url" placeholder="URL submenu..." value="<?= $subMenu['url']; ?>">
                            <small class="pl-1">Skema URL : <strong>controller/method</strong>. Contoh URL : <strong>admin/editUser</strong></small>
                        </div>
                        <div class="form-group">
                            <input type="text" name="icon" class="form-control" id="icon" placeholder="Icon submenu..." value="<?= $subMenu['icon']; ?>">
                            <small class="pl-1">Gunakan Icon dari <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons ini.</a> Contoh : <strong>bi bi-whatsapp</strong></small>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <?php
                                // Mendapatkan nilai is_active dari database
                                $is_active = $subMenu['is_active']; // Sesuaikan dengan nama kolom dalam tabel submenu

                                // Menampilkan checkbox dengan nilai default dari database
                                $is_checked = ($is_active == 1) ? TRUE : FALSE;
                                ?>
                                <input type="hidden" name="is_active" value="0"> <!-- Nilai default saat checkbox tidak dicentang -->
                                <input type="checkbox" name="is_active" class="form-check-input" value="1" id="is_active" <?= set_checkbox('is_active', '1', $is_checked) ?>>
                                <label for="is_active" class="form-check-label">Aktifkan ?</label>
                            </div>
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