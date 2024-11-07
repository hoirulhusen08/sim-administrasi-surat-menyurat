<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row mb-5">
        <div class="col-lg-7">

            <!-- Form Edit -->
            <?= form_open_multipart('user/editUser'); ?>
            <h5><a style="text-decoration: none;" href="<?= base_url('user'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>
            <div class="card p-3 pt-4">
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="email" value="<?= $user['email']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" value="<?= $user['name']; ?>" placeholder="Nama lengkap...">
                        <?= form_error('name', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="npm_nbm" class="col-sm-2 col-form-label"><?php if ($this->session->userdata('role_id') == 2) { echo "NPM"; } else { echo "NBM"; } ?></label>
                    <div class="col-sm-10">
                        <input type="number" name="npm_nbm" class="form-control" id="npm_nbm" value="<?= $user['npm_nbm']; ?>" placeholder="Isikan disini...">
                        <?= form_error('npm_nbm', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_lahir" class="col-sm-2 col-form-label">Tempat & Tgl. Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" name="tgl_lahir" class="form-control" id="tgl_lahir" placeholder="Cnth : Kotabumi, 26 Agustus 2000" value="<?= $user['tgl_lahir']; ?>">
                        <?= form_error('tgl_lahir', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-10">
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Isikan alamat lengkap..."><?= $user['alamat']; ?></textarea>
                        <?= form_error('alamat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>

                <!-- Tampil hanya jika Role Mahasiswa -->
                <?php if($this->session->userdata('role_id') == 2) : ?>
                    <div class="form-group row">
                        <label for="judul_mhs" class="col-sm-2 col-form-label">Judul TA Mahasiswa</label>
                        <div class="col-sm-10">
                            <textarea name="judul_mhs" id="judul_mhs" class="form-control" rows="3" placeholder="Isikan judul tugas akhir..."><?= $user['judul_mhs']; ?></textarea>
                            <?= form_error('judul_mhs', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-group row">
                    <div class="col-sm-2 mb-2">Gambar</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail mb-3">
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
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Ubah Profil</button>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->