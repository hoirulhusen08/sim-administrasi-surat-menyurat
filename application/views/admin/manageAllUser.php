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

    <?php if ($this->session->flashdata('validation_errors')) : ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <?= $this->session->flashdata('validation_errors'); ?>
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
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addNewUser"><i class="bi bi-folder-plus"></i> Tambah Pengguna Baru</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Terdaftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $i++ . "."; ?></td>
                                <td>
                                    <a href="<?= base_url('assets/img/profile/') . $user['image']; ?>" data-lightbox="roadtrip" data-title="Photo <?= $user['name']; ?>">
                                        <img width="50" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                                    </a>
                                </td>
                                <td><?= $user['name']; ?></td>
                                <td><a href="mailto:<?= $user['email']; ?>"><?= $user['email']; ?></a></td>
                                <td>
                                    <?php if ($user['role'] == 'Administrator' || $user['role'] == "Admin") : ?>
                                        <span class="badge badge-success"><?= $user['role']; ?></span>
                                    <?php elseif ($user['role'] == "Mahasiswa") : ?>
                                        <span class="badge badge-secondary"><?= $user['role']; ?></span>
                                    <?php elseif ($user['role'] == "Staf FTIK") : ?>
                                        <span class="badge badge-primary"><?= $user['role']; ?></span>
                                    <?php elseif ($user['role'] == "Kepala Kantor") : ?>
                                        <span class="badge badge-danger"><?= $user['role']; ?></span>
                                    <?php elseif ($user['role'] == "Wakil Dekan" || $user['role'] == "Dekan") : ?>
                                        <span class="badge badge-warning"><?= $user['role']; ?></span>
                                    <?php elseif ($user['role'] == "Dosen") : ?>
                                        <span class="badge badge-info"><?= $user['role']; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d F Y', $user['date_created']); ?></td>
                                <td>
                                    <?php if ($user['is_active'] == 1) : ?>
                                        <span class="badge badge-success"><i class="bi bi-check-circle-fill"></i> On</span>
                                    <?php elseif ($user['is_active'] == 0) : ?>
                                        <span class="badge badge-danger"><i class="bi bi-x-circle-fill"></i> Off</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary mb-1" data-toggle="modal" data-target="#editGeneralUser<?= $user['id']; ?>"><i class="bi bi-pencil-square"></i> Ubah</a>

                                    <?php if ($user['role'] === 'Administrator' || $user['role'] === 'Admin') : ?>
                                        <a href="#" id="notDeleteButtonAdmin" style="cursor: not-allowed;" class="btn btn-sm btn-danger mb-1" onclick="return false;"><i class="bi bi-trash3-fill"></i> Hapus</a>
                                    <?php else : ?>
                                        <a href="<?= base_url('admin/deleteGeneralUser/' . $user['id']); ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash3-fill"></i> Hapus</a>
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

<!-- MODAL ADD NEW USER -->
<div class="modal fade" id="addNewUser" tabindex="-1" aria-labelledby="addNewUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewUserLabel">Tambah Pengguna Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/manageAllUser'); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/img/profile/default.jpg'); ?>" id="image-preview" class="img-thumbnail mb-2">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Pilih gambar...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control <?= (form_error('name') ? 'is-invalid' : '') ?>" id="name" placeholder="Nama lengkap pengguna..." value="<?= set_value('name'); ?>">
                        <?= form_error('name', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control <?= (form_error('email') ? 'is-invalid' : '') ?>" id="email" placeholder="Email aktif pengguna..." value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <select name="role" id="role" class="form-control <?= (form_error('role') ? 'is-invalid' : '') ?>">
                            <option value="">-- Pilih Peran --</option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['id']; ?>" <?= set_select('role', $role['id']); ?>>
                                    <?= $role['role']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('role', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="card p-2" style="background-color: #efefef;">
                        <div class="form-group">
                            <input type="password" name="password" class="form-control <?= (form_error('password') ? 'is-invalid' : '') ?>" id="generatePasswordDefaultAddUser" placeholder="Password..." value="<?= set_value('password'); ?>">
                            <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password2" class="form-control <?= (form_error('password2') ? 'is-invalid' : '') ?>" id="generatePasswordDefaultAddUser2" placeholder="Konfirmasi Password..." value="<?= set_value('password2'); ?>">
                            <?= form_error('password2', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="togglePasswordCheckboxAddUser" onchange="togglePasswordVisibility('togglePasswordCheckboxAddUser', 'generatePasswordDefaultAddUser', 'generatePasswordDefaultAddUser2')">
                            <label for="togglePasswordCheckboxAddUser">Tampilkan Password</label>
                        </div>
                        <hr class="mb-2" style="margin-top: -10px;">
                        <small class="row justify-content-end mr-2"><a href="javascript:void(0)" onclick="return generateDefaultPasswordAddUser()">Buat Password Bawaan?</a>&nbsp; dari (12345678).</small>
                        <small class="row justify-content-end mr-2"><a href="javascript:void(0)" onclick="return resetPasswordAddUser()">Kosongkan Password Bawaan!</a></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Tambah Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT MENU -->
<?php $no = 0; ?>
<?php foreach ($users as $user) : $no++; ?>
    <div class="modal fade" id="editGeneralUser<?= $user['id']; ?>" tabindex="-1" aria-labelledby="editGeneralUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGeneralUserLabel">Perbarui Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('admin/editGeneralUser'); ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $user['id']; ?>">
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" id="image-preview" class="img-thumbnail mb-2">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Ganti gambar...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <?php
                                // Mendapatkan nilai is_active dari database
                                $is_active = $user['is_active']; // Sesuaikan dengan nama kolom dalam tabel submenu

                                // Menampilkan checkbox dengan nilai default dari database
                                $is_checked = ($is_active == 1) ? TRUE : FALSE;
                                ?>
                                <input type="hidden" name="is_active" value="0"> <!-- Nilai default saat checkbox tidak dicentang -->
                                <input type="checkbox" name="is_active" class="form-check-input" value="1" id="is_active" <?= set_checkbox('is_active', '1', $is_checked) ?>>
                                <label for="is_active" class="form-check-label">Aktifkan Pengguna ?</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama lengkap pengguna..." value="<?= $user['name']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email aktif pengguna..." value="<?= $user['email']; ?>" <?= ($user['id'] == 1) ? 'disabled' : ''; ?>>
                        </div>
                        <div class="form-group">
                            <select name="role_id" id="role_id" class="form-control" <?= ($user['id'] == 1) ? 'disabled' : ''; ?>>
                                <option value="">-- Pilih Peran --</option>
                                <?php foreach ($roles as $role) : ?>
                                    <option value="<?= $role['id']; ?>" <?= set_select('role_id', $role['id'], $user['role_id'] == $role['id']); ?>>
                                        <?= $role['role']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <hr>
                        <div class="card p-2" style="background-color: #efefef;">
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" id="generatePasswordDefaultUbahUser<?= $no; ?>" placeholder="Password baru...">
                            </div>
                            <div class="form-group">
                                <input type="password" name="confirm_pass_edit_user" class="form-control" id="generatePasswordDefaultUbahUser2<?= $no; ?>" placeholder="Konfirmasi password baru...">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="togglePasswordCheckbox<?= $no; ?>" onchange="togglePasswordVisibilityEditUser('togglePasswordCheckbox<?= $no; ?>', 'generatePasswordDefaultUbahUser<?= $no; ?>', 'generatePasswordDefaultUbahUser2<?= $no; ?>')">
                                <label for="togglePasswordCheckbox<?= $no; ?>">Tampilkan Password</label>
                            </div>
                            <hr class="mb-2" style="margin-top: -10px;">
                            <small class="row justify-content-end mr-2"><a href="javascript:void(0)" onclick="return generateDefaultPasswordEditUser(<?= $no; ?>)">Buat Password Bawaan?</a>&nbsp; dari (12345678).</small>
                            <small class="row justify-content-end mr-2"><a href="javascript:void(0)" onclick="return resetPasswordEditUser('generatePasswordDefaultUbahUser<?= $no; ?>', 'generatePasswordDefaultUbahUser2<?= $no; ?>')">Kosongkan Password Bawaan!</a></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Perbarui Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>