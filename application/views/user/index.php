<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img class="img-thumbnail" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="Gambar">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><b><?= $user['name']; ?></b></h5>
                    <p class="card-text" style="margin-top:-13px;">
                        <?php 
                            if ($this->session->userdata('role_id') == 2) { 
                                echo "NPM : "; 
                            } else { 
                                echo "NBM : "; 
                            } 
                        ?>
                        <?php
                            if(!empty($user['npm_nbm'])) {
                                echo $user['npm_nbm'];
                            } else {
                                echo '<span style="color: #ccc;">Tidak tersedia</span> &nbsp;';
                                echo '<a href=" ' . base_url('user/editUser') . ' " title="Ubah Data"><i class="bi bi-pencil-square"></i></a>';
                            }
                        ?>
                    </p>

                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Tempat, Tgl. Lahir</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                    if (!empty($user['tgl_lahir'])) {
                                        echo $user['tgl_lahir'];
                                    } else {
                                        echo '<span style="color: #ccc;">Tanggal tidak tersedia</span> &nbsp;';
                                        echo '<a href=" ' . base_url('user/editUser') . ' " title="Ubah Data"><i class="bi bi-pencil-square"></i></a>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($user['alamat'])) {
                                        echo $user['alamat'];
                                    } else {
                                        echo '<span style="color: #ccc;">Alamat tidak tersedia</span> &nbsp;';
                                        echo '<a href=" ' . base_url('user/editUser') . ' " title="Ubah Data"><i class="bi bi-pencil-square"></i></a>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr style="margin-top:-12px;">
                    
                    <p class="card-text"><small class="text-muted">Email : <?= $user['email']; ?></small></p>
                    <p class="card-text" style="margin-top:-18px;"><small class="text-muted">Terdaftar sejak : <?= date('d F Y', $user['date_created']); ?></small></p>
                    <span class="card-text mr-2"><a href="<?= base_url('user/editUser'); ?>" class="badge badge-primary"><i class="bi bi-pencil-square"></i> Ubah Profil</a></span>
                    <span class="card-text mr-2"><a href="<?= base_url('user/changePassword'); ?>" class="badge badge-danger"><i class="bi bi-lock-fill"></i> Ubah Password</a></span>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->