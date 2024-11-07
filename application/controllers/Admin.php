<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dasbor';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        // Counter Tabel form show in Dashboard Page
        // Hitung total user
        $data['users_count'] = $this->db->count_all('users');
        // Hitung total surat masuk
        $data['surat_masuk_count'] = $this->db->count_all('surat_masuk');
        // Hitung total surat keluar
        $data['surat_keluar_count'] = $this->db->count_all('surat_keluar');
        // Hitung total arsip surat
        $data['arsip_surat_count'] = $this->db->count_all('arsip_surat');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    // ============================= ROLE ACCESS ======================================

    public function role()
    {
        $data['title'] = 'Peran';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['roles'] = $this->db->order_by('id', 'DESC')->get('users_role')->result_array();

        // Rules validation
        $this->form_validation->set_rules('role', 'Role', 'required|trim|min_length[3]', [
            'required' => 'Inputan Peran tidak boleh kosong.',
            'min_length' => 'Nama Peran minimal 3 karakter.'
        ]);

        // Add New Role
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('users_role', ['role' => $this->input->post('role')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Okay...</strong> peran baru berhasil ditambahkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

            redirect('admin/role');
        }
    }

    public function editRole()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');

        $data = ['role' => $role];

        $this->db->where('id', $id);
        $this->db->update('users_role', $data);

        if ($this->db->affected_rows() > 0) {
            // Jika berhasil, set pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Okay...</strong> peran berhasil diperbarui!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        } else {
            // Jika tidak ada baris yang terpengaruh, set pesan error
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upss...</strong> peran gagal diperbarui!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }

        redirect('admin/role');
    }

    public function deleteRole($id)
    {
        // Periksa apakah role adalah "Administrator" atau memiliki id "1"
        $role = $this->db->get_where('users_role', ['id' => $id])->row_array();
        if ($role['role'] === 'Administrator' || $id == 1) {
            // Jika ya, tampilkan pesan bahwa role tidak bisa dihapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error...</strong> Peran Administrator tidak bisa dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        } else {
            // Lakukan penghapusan data dari tabel
            $this->db->where('id', $id);
            $this->db->delete('users_role');

            // Periksa apakah penghapusan berhasil
            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Okay...</strong> Peran berhasil dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            }
        }

        // Redirect ke halaman yang sesuai
        redirect('admin/role');
    }


    // ============================= ROLE ACCESS ======================================

    public function roleAccess($role_id)
    {
        $data['title'] = 'Peran';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['role'] = $this->db->get_where('users_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menus'] = $this->db->get('user_menus')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roleAccess', $data);
        $this->load->view('templates/footer', $data);
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menus', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menus', $data);
        } else {
            $this->db->delete('user_access_menus', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <strong>Okay...</strong> perubahan berhasil!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    }

    // =============================== FOR ALL USER ===============================
    public function manageAllUser()
    {
        $data['title'] = 'Manajemen Pengguna';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['roles'] = $this->db->get('users_role')->result_array();

        // Join tabel users dan users_role
        $this->db->select('users.*, users_role.role');
        $this->db->from('users');
        $this->db->join('users_role', 'users.role_id = users_role.id', 'left');
        $this->db->order_by('users.id', 'DESC');
        $data['users'] = $this->db->get()->result_array();

        // Rules validation
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Kolom nama wajib diisi.',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'required' => 'Kolom email wajib diisi.',
            'valid_email' => 'Bukan email yang benar.',
            'is_unique' => 'Email sudah terdaftar di database.',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'required' => 'Kolom password wajib diisi.',
            'min_length' => 'Panjang password minimal 8 karakter.',
            'matches' => 'Password tidak sesuai dengan konfirmasi password.',
        ]);
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|min_length[8]|matches[password]', [
            'required' => 'Kolom konfirmasi password wajib diisi.',
            'min_length' => 'Panjang konfirmasi password minimal 8 karakter.',
            'matches' => 'Konfirmasi password tidak sesuai dengan password.',
        ]);
        $this->form_validation->set_rules('role', 'Role', 'required', [
            'required' => 'Kolom peran wajib diisi.',
        ]);

        if ($this->form_validation->run() == false) {
            // Simpan nama file yang diunggah pengguna ke dalam sesi jika validasi gagal
            if (validation_errors()) {
                $this->session->set_userdata('uploaded_image', $this->input->post('image'));
            }

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manageAllUser', $data);
            $this->load->view('templates/footer', $data);
        } else {

            // ========= SKEMA CREATE KODE USER =========
            // Lakukan query untuk mengambil nomor terakhir dari tabel
            $query = $this->db->query('SELECT MAX(id) AS last_id FROM users');
            $row = $query->row();
            $user_code = $row->last_id;

            // Pastikan untuk menangani kasus ketika tabel kosong
            if ($user_code === NULL) {
                $user_code = 0;
            }

            $kode_user = 'ID' . '1' . date('Y') . '01' . $user_code;

            $data = [
                'kode_user' => $kode_user,
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role'),
                'is_active' => 1,
                'date_created' => time()
            ];

            // Cek jika ada gambar yg diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $data['image'] = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $data['image'] = 'default.jpg';
            }

            // Insert data pengguna
            $this->db->insert('users', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Okay...</strong> pengguna baru berhasil ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');

            redirect('admin/manageAllUser');
        }
    }

    public function editGeneralUser()
    {
        $user['user'] = $this->db->get_where('users', ['id' => $this->input->post('id')])->row_array();

        // Rule validation
        $this->form_validation->set_rules('password', 'Password', 'min_length[8]|trim|matches[confirm_pass_edit_user]', [
            'min_length' => 'Password minimal 8 karakter.',
            'matches' => 'Password tidak sama dengan konfirmasi password.'
        ]);
        $this->form_validation->set_rules('confirm_pass_edit_user', 'Confirm Password', 'min_length[8]|trim|matches[password]', [
            'min_length' => 'Konfirmasi password minimal 8 karakter.',
            'matches' => 'Konfirmasi password tidak sama dengan password.'
        ]);

        if ($this->form_validation->run() == false) {
            // Simpan pesan validasi form ke dalam session
            $this->session->set_flashdata('validation_errors', validation_errors());
            redirect('admin/manageAllUser');
        } else {
            $id = $this->input->post('id');
            $is_active = $this->input->post('is_active');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $role_id = $this->input->post('role_id');
            $password = $this->input->post('password');

            // Cek jika password diubah
            if (!empty($password)) {
                if (password_verify($password, $user['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Upss...</strong> password baru sama dengan password lama!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('admin/manageAllUser');
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                }
            } else {
                // Gunakan password lama jika tidak ada perubahan
                $password = $user['user']['password'];
            }

            // Cek jika ada gambar yg diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $user['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            // End upload image

            $data = [
                'is_active' => $is_active,
                'name' => $name,
                'email' => $email,
                'role_id' => $role_id,
                'password' => $password,
            ];

            $this->db->where('id', $id);
            $this->db->update('users', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Okay...</strong> data pengguna berhasil diperbarui!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            } else {
                // Jika tidak ada baris yang terpengaruh, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upss...</strong> kesalahan dalam memperbarui data pengguna!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            }

            redirect('admin/manageAllUser');
        }
    }

    public function deleteGeneralUser($id)
    {
        // Mengambil data user berdasarkan ID
        $user = $this->db->where('id', $id)->get('users')->row_array();

        // Pastikan data user ditemukan
        if ($user) {
            // Periksa apakah role adalah "Administrator" atau memiliki id "1"
            if ($user['role_id'] == 1) {
                // Jika ya, tampilkan pesan bahwa role tidak bisa dihapus
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error...</strong> Peran Administrator tidak bisa dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            } else {
                $image = $user['image'];

                // Periksa apakah gambar bukan default.jpg sebelum menghapusnya
                if ($image != 'default.jpg') {
                    // Hapus gambar dari direktori
                    unlink(FCPATH . 'assets/img/profile/' . $image);
                }

                // Lakukan penghapusan data dari tabel
                $this->db->where('id', $id);
                $this->db->delete('users');

                // Periksa apakah penghapusan berhasil
                if ($this->db->affected_rows() > 0) {
                    // Jika berhasil, set pesan sukses
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Okay...</strong> pengguna berhasil dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
                } else {
                    // Jika tidak ada baris yang terpengaruh, set pesan error
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upss...</strong> pengguna gagal dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
                }
            }
        } else {
            // Jika data user tidak ditemukan, set pesan error
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Upss...</strong> Pengguna tidak ditemukan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        }

        // Redirect ke halaman yang sesuai
        redirect('admin/manageAllUser');
    }

    // ============================= SETTINGS WEB ======================================
    public function settings()
    {
        $data['title'] = 'Pengaturan Web';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        // Rule validation
        $this->form_validation->set_rules('web_title', 'Web Title', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('tagline', 'Tagline', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('caption', 'Caption', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('info_web_p1', 'Info', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('info_web_p2', 'Info', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('footer', 'Footer', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('institution_name', 'Institution Name', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('lead_name', 'Lead Name', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('nktam', 'NKTAM', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('faculty_name', 'Faculty Name', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('prodi_name', 'Prodi Name', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('address', 'Address', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('url_maps', 'URL Maps', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Kolom ini wajib diisi.',
            'valid_email' => 'Bukan email yang benar.',
        ]);
        $this->form_validation->set_rules('alamat_ttd', 'Alamat TTD', 'required|trim', [
            'required' => 'Kolom ini wajib diisi.',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/settings', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id = $this->input->post('id');
            $web_title = $this->input->post('web_title');
            $tagline = $this->input->post('tagline');
            $caption = $this->input->post('caption');
            $info_web_p1 = $this->input->post('info_web_p1');
            $info_web_p2 = $this->input->post('info_web_p2');
            $footer = $this->input->post('footer');
            $institution_name = $this->input->post('institution_name');
            $lead_name = $this->input->post('lead_name');
            $nktam = $this->input->post('nktam');
            $faculty_name = $this->input->post('faculty_name');
            $prodi_name = $this->input->post('prodi_name');
            $address = $this->input->post('address');
            $url_maps = $this->input->post('url_maps');
            $web = $this->input->post('web');
            $email = $this->input->post('email');
            $telp_or_fax = $this->input->post('telp_or_fax');
            $whatsapp = $this->input->post('whatsapp');
            $alamat_ttd = $this->input->post('alamat_ttd');

            // Cek jika ada gambar yg diupload
            $image_workflow = $_FILES['image_workflow']['name'];

            if ($image_workflow) {
                $config['allowed_types']    = 'gif|jpg|png';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/img/setting/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image_workflow')) {
                    $old_image_workflow = $data['setting']['image_workflow'];
                    if ($old_image_workflow != 'default-workflow.png') {
                        unlink(FCPATH . 'assets/img/setting/' . $old_image_workflow);
                    }

                    $new_image_workflow = $this->upload->data('file_name');
                    $this->db->set('image_workflow', $new_image_workflow);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            // End upload image

            // Cek jika ada Logo yg diupload
            $logo = $_FILES['logo']['name'];

            if ($logo) {
                $config['allowed_types']    = 'png';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/img/setting/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo')) {
                    $old_logo = $data['setting']['logo'];
                    if ($old_logo != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/setting/' . $old_logo);
                    }

                    $new_logo = $this->upload->data('file_name');
                    $this->db->set('logo', $new_logo);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            // End upload Logo

            // Cek jika ada Gambar TTD yg diupload
            $ttd_image = $_FILES['ttd_image']['name'];

            if ($ttd_image) {
                $config['allowed_types']    = 'png';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/img/setting/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('ttd_image')) {
                    $old_ttd_image = $data['setting']['ttd_image'];
                    if ($old_ttd_image != 'default-ttd.png') {
                        unlink(FCPATH . 'assets/img/setting/' . $old_ttd_image);
                    }

                    $new_ttd_image = $this->upload->data('file_name');
                    $this->db->set('ttd_image', $new_ttd_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            // End upload Gambar TTD

            $data = [
                'web_title' => $web_title,
                'tagline' => $tagline,
                'caption' => $caption,
                'info_web_p1' => $info_web_p1,
                'info_web_p2' => $info_web_p2,
                'footer' => $footer,
                'institution_name' => $institution_name,
                'lead_name' => $lead_name,
                'nktam' => $nktam,
                'faculty_name' => $faculty_name,
                'prodi_name' => $prodi_name,
                'address' => $address,
                'url_maps' => $url_maps,
                'web' => $web,
                'email' => $email,
                'telp_or_fax' => $telp_or_fax,
                'whatsapp' => $whatsapp,
                'alamat_ttd' => $alamat_ttd,
            ];

            $this->db->where('id', $id);
            $this->db->update('setting', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Okay...</strong> data pengaturan berhasil diperbarui!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            } else {
                // Jika tidak ada baris yang terpengaruh, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upss...</strong> kesalahan dalam memperbarui data!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            }

            redirect('admin/settings');
        }
    }
}
