<!-- Sidebar -->
<ul class="navbar-nav bg-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3"> Panel
            <?php
            if ($this->session->userdata('role_id') == 1) {
                echo "Admin";
            } else if ($this->session->userdata('role_id') == 2) {
                echo "Mahasiswa";
            } else if ($this->session->userdata('role_id') == 3) {
                echo "Staf FTIK";
            } else if ($this->session->userdata('role_id') == 4) {
                echo "Kepala Kantor";
            } else if ($this->session->userdata('role_id') == 5) {
                echo "Wakil Dekan";
            } else if ($this->session->userdata('role_id') == 6) {
                echo "Dekan";
            } else if ($this->session->userdata('role_id') == 7) {
                echo "Dosen";
            } else {
                echo "Tamu";
            }
            ?>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- QUERY MENU -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menus`.`id`, `menu`
                    FROM `user_menus` JOIN `user_access_menus`
                    ON `user_menus`.`id` = `user_access_menus`.`menu_id`
                    WHERE `user_access_menus`.`role_id` = $role_id
                    ORDER BY `user_access_menus`.`menu_id` ASC
                    ";
    $menus = $this->db->query($queryMenu)->result_array();
    ?>

    <!-- LOOPING MENU -->
    <?php foreach ($menus as $menu) : ?>
        <div class="sidebar-heading">
            <?php if($menu['menu'] == "Dosen") : ?>
                Unduh Surat
            <?php else : ?>
                <?= $menu['menu']; ?>
            <?php endif; ?>
        </div>

        <!-- SIAPKAN SUB-MENU sesuai MENU -->
        <?php
        $menuId = $menu['id'];
        $querySubMenu = "SELECT * FROM `user_sub_menus`
                            WHERE `menu_id` = $menuId
                            AND `is_active` = 1
            ";
        $subMenus = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php foreach ($subMenus as $subMenu) : ?>
            <?php if ($title == $subMenu['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-1 pt-2" href="<?= base_url($subMenu['url']); ?>">
                    <i class="<?= $subMenu['icon']; ?>"></i>
                    <span><?= $subMenu['title']; ?></span></a>
                </li>
            <?php endforeach; ?>

            <hr class="sidebar-divider mt-2">

        <?php endforeach; ?>

                <?php if ($role_id == 2) : ?>
                    <li class="nav-item <?= (uri_string() == 'user/submissionHistory') ? 'active' : ''; ?>">
                        <a class="nav-link mb-3 pt-1" href="<?= base_url('user/submissionHistory'); ?>">
                        <i class="bi bi-clock-history"></i>
                        <span>Histori Pengajuan</span></a>
                    </li>
                <?php endif; ?>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->