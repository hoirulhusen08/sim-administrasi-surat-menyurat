<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <?= $this->session->flashdata('message'); ?>

            <form method="post" action="<?= base_url('user/changePassword') ?>">
                <h5><a style="text-decoration: none;" href="<?= base_url('user'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>
                <div class="card p-3 pt-4">
                    <div class="form-group">
                        <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Password saat ini...">
                        <?= form_error('current_password', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" name="new_password1" class="form-control" id="new_password1" placeholder="Password baru...">
                        <?= form_error('new_password1', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" name="new_password2" class="form-control" id="new_password2" placeholder="Ulangi password baru...">
                        <?= form_error('new_password2', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Ubah Password</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->