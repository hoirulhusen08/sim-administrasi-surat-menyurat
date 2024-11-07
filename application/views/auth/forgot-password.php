<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><i class="bi bi-person-fill-lock"></i> Apakah lupa password ?</h1>
                                </div>

                                <?= $this->session->flashdata('message'); ?>

                                <form class="user" method="post" action="<?= base_url('auth/forgotPassword'); ?>">
                                    <div class="form-group">
                                        <input type="text" name="forgot_password" class="form-control form-control-user" id="forgot_password" placeholder="Masukan alamat email..." value="<?= set_value('forgot_password'); ?>">
                                        <?= form_error('forgot_password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-loginPage btn-user btn-block">
                                        Atur Ulang Password
                                    </button>
                                </form>
                                <hr>
                                <div class="link-loginPage text-center">
                                    <a class="small" href="<?= base_url('auth'); ?>">Kembali ke halaman login</a>
                                </div>
                                <div class="link-loginPage text-center">
                                    <a class="small" href="<?= base_url('/'); ?>"><i class="bi bi-arrow-return-left"></i> Kembali ke beranda</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>