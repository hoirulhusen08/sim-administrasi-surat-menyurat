<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editUser()
    {
        $data['title'] = 'Ubah Profil';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        // Rule validation
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Inputan Nama harus diisi.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/editUser', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $npm_nbm = $this->input->post('npm_nbm');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $alamat = $this->input->post('alamat');
            $judul_mhs = $this->input->post('judul_mhs');

            // Cek jika ada gambar yg diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->set('npm_nbm', $npm_nbm);
            $this->db->set('tgl_lahir', $tgl_lahir);
            $this->db->set('alamat', $alamat);
            $this->db->set('judul_mhs', $judul_mhs);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>Yeay...</strong> profil berhasil diperbarui!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        // Rule validation
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim', [
            'required' => 'Password saat ini harus diisi.'
        ]);
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[8]|matches[new_password2]', [
            'required' => 'Password baru harus diisi.',
            'min_length' => 'Password minimal 8 karakter.',
            'matches' => 'Password tidak sesuai dengan konfirmasi password.',
        ]);
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[8]|matches[new_password1]', [
            'required' => 'Konfirmasi Password baru harus diisi.',
            'min_length' => 'Password minimal 8 karakter.',
            'matches' => 'Konfirmasi Password tidak sesuai dengan password.',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changePassword', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>Upss...</strong> password saat ini salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');

                redirect('user/changePassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Upss...</strong> password baru tidak boleh sama dengan password saat ini!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');

                    redirect('user/changePassword');
                } else {
                    // Password OK
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('users');

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <strong>Yeay...</strong> password telah diperbarui!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');

                    redirect('user/changePassword');
                }
            }
        }
    }


    // ====================== PENGAJUAN SURAT MAHASISWA ==============================

    public function submissionHistory()
    {
        $data['title'] = 'Histori Pengajuan';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $user_id = $this->session->userdata('user_id');
        $this->db->select('pengajuan_surat.*, users.name');
        $this->db->from('pengajuan_surat');
        $this->db->join('users', 'pengajuan_surat.id_user = users.id');
        $this->db->where('pengajuan_surat.id_user', $user_id); // Filter berdasarkan id_user dari session
        $this->db->order_by('pengajuan_surat.id', 'DESC'); // Menambahkan pengurutan DESC
        $data['histori_pengajuan'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/submissionHistory', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editHistorySubmission()
    {
        $data['title'] = 'Ubah Pengajuan Surat';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $id = $this->input->get('id');
        $data['jenis_surat'] = $this->db->get_where('jenis_surat', ['kategori' => 'Mahasiswa'])->result_array();
        $data['pengajuan_surat'] = $this->db->get_where('pengajuan_surat', ['id' => $id])->row_array();

        if ($data['pengajuan_surat']['status'] == 3) {
            // Tampilkan pesan kesalahan
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error...</strong> surat pengajuan yang telah READY tidak bisa diubah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('user/submissionHistory');
        } else {

            // Rule validation
            $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required|trim', [
                'required' => 'Kolom ini tidak boleh kosong.',
            ]);
            $this->form_validation->set_rules('sifat', 'Sifat Surat', 'required|trim', [
                'required' => 'Kolom ini tidak boleh kosong.',
            ]);
            // $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            //     'required' => 'Kolom ini tidak boleh kosong.',
            // ]);

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/editHistorySubmission', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $id = $this->input->get('id');
                $jenis_surat = $this->input->post('jenis_surat');
                $sifat = $this->input->post('sifat');
                // $keterangan = $this->input->post('keterangan');

                $data = [
                    'jenis_surat' => $jenis_surat,
                    'sifat' => $sifat,
                    'keterangan' => "-",
                    'status' => 0,
                    'dilihat' => 0,
                    'date_updated' => time(),
                ];

                // Cek jika ada file yg diupload
                $upload_file = $_FILES['berkas_pendukung']['name'];

                if ($upload_file) {
                    $config['allowed_types']    = 'jpeg|jpg|png';
                    $config['max_size']         = '5076';
                    $config['upload_path']      = './assets/file/berkas-pendukung/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('berkas_pendukung')) {
                        $old_file = $data['pengajuan_surat']['berkas_pendukung'];

                        if ($old_file) {
                            unlink(FCPATH . 'assets/file/berkas-pendukung/' . $old_file);
                        }

                        $new_file = $this->upload->data('file_name');
                        $this->db->set('berkas_pendukung', $new_file);
                    } else {
                        // Jika tipe file upload tidak sesuai
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Gagal...</strong> Jenis file yang Anda coba unggah tidak diperbolehkan.!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                        redirect('user/editHistorySubmission');
                    }
                }
                // End upload file

                $this->db->where('id', $id);
                $this->db->update('pengajuan_surat', $data);

                if ($this->db->affected_rows() > 0) {
                    // Jika berhasil, set pesan sukses
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil...</strong> data telah diubah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
                } else {
                    // Jika tidak ada baris yang terpengaruh, set pesan error
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal...</strong> data gagal diubah, ada kesalahan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
                }

                redirect('user/submissionHistory');
            }
        }
    }

    public function deleteHistorySubmission()
    {
        // Mengambil data surat masuk berdasarkan ID
        $id = $this->input->get('id');
        $pengajuan_surat = $this->db->where('id', $id)->get('pengajuan_surat')->row_array();

        if ($pengajuan_surat['status'] >= 3) {
            // Tampilkan pesan kesalahan
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error...</strong> surat pengajuan yg telah READY tidak bisa dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('user/submissionHistory');
        } else {
            // Pastikan data surat ditemukan
            if ($pengajuan_surat) {
                $file = $pengajuan_surat['berkas_pendukung'];

                // unline file dari direktori
                if ($file) {
                    unlink(FCPATH . 'assets/file/berkas-pendukung/' . $file);
                }

                // Lakukan penghapusan data dari tabel
                $this->db->where('id', $id);
                $this->db->delete('pengajuan_surat');

                // Periksa apakah penghapusan berhasil
                if ($this->db->affected_rows() > 0) {
                    // Jika berhasil, set pesan sukses
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil...</strong> data berhasil dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                } else {
                    // Jika tidak ada baris yang terpengaruh, set pesan error
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Upss...</strong> data gagal dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                }
            } else {
                // Jika data user tidak ditemukan, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upss...</strong> data tidak ditemukan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            }

            // Redirect ke halaman yang sesuai
            redirect('user/submissionHistory');
        }
    }
}
