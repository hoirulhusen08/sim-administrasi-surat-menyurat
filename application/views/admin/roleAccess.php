<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <h5 class="text-muted"><a style="text-decoration: none;" href="<?= base_url('admin/role'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a> | Sebagai : <?= $role['role']; ?></h5>

    <!-- Datatables -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menus as $menu) : ?>
                            <tr>
                                <td><?= $i++ . "."; ?></td>
                                <td><?= $menu['menu']; ?></td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input form-check-role-input" type="checkbox" <?= check_access($role['id'], $menu['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $menu['id']; ?>">
                                    </div>
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