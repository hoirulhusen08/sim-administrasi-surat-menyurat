<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-6 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><i class="bi bi-unlock-fill"></i> Buat Akun Sekarang!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/register'); ?>">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Nama lengkap..." value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control form-control-user" id="email" placeholder="Email yang aktif..." value="<?= set_value('email'); ?>">
                                <small type="button" class="text-muted pl-3" data-toggle="tooltip" data-placement="top" title="Pastikan email yang digunakan aktif, untuk proses aktivasi nantinya!"><i class="bi bi-info-circle-fill"></i> Info penting</small>
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password..." value="<?= set_value('password'); ?>">
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password2" class="form-control form-control-user" id="password2" placeholder="Ulangi password..." value="<?= set_value('password2'); ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-loginPage btn-user btn-block">
                                Daftarkan Akun
                            </button>
                            <div class="row text-center mt-3">
                                <label><small><input type="checkbox" checked disabled> Dengan mengklik <strong>Daftar</strong>, Anda menyetujui <a href="#" data-toggle="modal" data-target="#termsModal">Ketentuan</a> dan <a href="#" data-toggle="modal" data-target="#privacyPolicyModal">Kebijakan Privasi</a> kami. Semua data anda kami jaga kerahasiaanya.</small></label>
                            </div>
                        </form>
                        <hr>
                        <div class="link-loginPage text-center">
                            <a class="small" href="<?= base_url('auth/forgotPassword'); ?>">Lupa Password?</a>
                        </div>
                        <div class="link-loginPage text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Sudah punya akun? Masuk!</a>
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