<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Homepage -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link" href="<?= base_url('/'); ?>" target="_blank" title="Beranda">
                        <i class="fas fa-globe fa-fw"></i>
                    </a>
                </li>

                <!-- Nav Item - Messages -->
                <?php if($this->session->userdata('role_id') == 3 || $this->session->userdata('role_id') == 'staff') : ?>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Pesan Masuk">
                        <i class="fas fa-envelope fa-fw"></i>
                        <?php if (isset($count) && $count > 0) : ?>
                            <span class="badge badge-danger badge-counter"><?= $count; ?></span>
                        <?php else : ?>
                            <span class="badge badge-danger badge-counter" style="display: none;">0</span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Notifikasi Pengajuan Surat
                        </h6>
                        <?php if (isset($notifications) && !empty($notifications)) : ?>
                            <?php foreach ($notifications as $notification) : ?>
                                <a class="dropdown-item d-flex align-items-center" href="<?= base_url('submission/viewSubmissionLetter?id=') . $notification['id']; ?>">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="<?= base_url('assets/img/profile/') . htmlspecialchars($notification['image']); ?>" alt="Image">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate"><?= htmlspecialchars($notification['nama_pengaju']); ?>, mengajukan permohonan surat.</div>
                                        <div class="small text-gray-500"><?= date('d F Y', $notification['date_created']); ?></div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <!-- <a class="dropdown-item text-center small text-gray-500" href="#">Tidak ada notifikasi baru</a> -->
                        <?php endif; ?>
                        <!-- "Lihat detail..." link added dynamically in JavaScript -->
                    </div>
                </li>
                <?php endif; ?>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('user'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profil Saya
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Keluar
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->