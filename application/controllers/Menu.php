<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Manajemen Menu';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['menus'] = $this->db->order_by('id', 'DESC')->get('user_menus')->result_array();

        // Rules validation
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim|min_length[3]', [
            'required' => 'Inputan Menu tidak boleh kosong.',
            'min_length' => 'Nama Menu minimal 3 karakter.'
        ]);

        // Add new Menu
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('user_menus', ['menu' => $this->input->post('menu')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>YuUpss...</strong> menu baru berhasil ditambahkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

            redirect('menu');
        }
    }

    public function editMenu()
    {
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');

        $data = ['menu' => $menu];

        $this->db->where('id', $id);
        $this->db->update('user_menus', $data);

        if ($this->db->affected_rows() > 0) {
            // Jika berhasil, set pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>YuUps...</strong> nama menu berhasil diperbarui!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        } else {
            // Jika tidak ada baris yang terpengaruh, set pesan error
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upss...</strong> nama menu gagal diperbarui!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }

        redirect('menu');
    }

    public function deleteMenu($id)
    {
        // Lakukan penghapusan data dari tabel
        $this->db->where('id', $id);
        $this->db->delete('user_menus');

        // Periksa apakah penghapusan berhasil
        if ($this->db->affected_rows() > 0) {
            // Jika berhasil, set pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>YuUps...</strong> menu berhasil dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        } else {
            // Jika tidak ada baris yang terpengaruh, set pesan error
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upss...</strong> menu gagal dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }

        // Redirect ke halaman yang sesuai
        redirect('menu');
    }


    // ======================== SUB MENU CODE ================================
    public function subMenu()
    {
        $data['title'] = 'Manajemen Submenu';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $this->load->model('Menu_model', 'menu');

        $data['subMenus'] = $this->menu->getSubMenu();
        $data['menus'] = $this->db->get('user_menus')->result_array();

        // Rules validation
        $this->form_validation->set_rules('title', 'Title', 'required|trim|min_length[3]', [
            'required' => 'Inputan Nama Submenu harus diisi.',
            'min_length' => 'Nama Submenu minimal 3 karakter.',
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required|trim', [
            'required' => 'Inputan Nama Menu harus diisi.',
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required|trim', [
            'required' => 'Inputan URL Submenu harus diisi.',
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim', [
            'required' => 'Inputan Icon Submenu harus diisi.',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            ];

            $this->db->insert('user_sub_menus', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>YuUps...</strong> submenu berhasil ditambahkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

            redirect('menu/subMenu');
        }
    }

    public function editSubmenu()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $menu_id = $this->input->post('menu_id');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');

        $data = [
            'title' => $title,
            'menu_id' => $menu_id,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active,
        ];

        $this->db->where('id', $id);
        $this->db->update('user_sub_menus', $data);

        if ($this->db->affected_rows() > 0) {
            // Jika berhasil, set pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>YuUps...</strong> nama submenu berhasil diperbarui!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        } else {
            // Jika tidak ada baris yang terpengaruh, set pesan error
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upss...</strong> nama submenu gagal diperbarui!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }

        redirect('menu/subMenu');
    }

    public function deleteSubmenu($id)
    {
        // Lakukan penghapusan data dari tabel
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menus');

        // Periksa apakah penghapusan berhasil
        if ($this->db->affected_rows() > 0) {
            // Jika berhasil, set pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>YuUps...</strong> submenu berhasil dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        } else {
            // Jika tidak ada baris yang terpengaruh, set pesan error
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upss...</strong> submenu gagal dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }

        // Redirect ke halaman yang sesuai
        redirect('menu/subMenu');
    }
}
