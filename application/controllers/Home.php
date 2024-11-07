<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['jenis_surat'] = $this->db->get_where('jenis_surat', ['kategori' => 'Mahasiswa'])->result_array();

        // Membuat skema kode pengajuan
        $query = $this->db->query('SELECT MAX(id) AS last_id FROM pengajuan_surat');
        $row = $query->row();
        $id_pengajuan_surat = $row->last_id;
        // Pastikan untuk menangani kasus ketika tabel kosong
        if ($id_pengajuan_surat === NULL) {
            $id_pengajuan_surat = 0;
        }
        // Rangkai skema kode pengajuan
        if (!empty($data['user']['kode_user'])) {
            $data['kode_pengajuan'] = "SP-" . $data['user']['kode_user'] . "-" . $id_pengajuan_surat;
        }

        // Rules validation
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
            $this->load->view('templates/homepage_header', $data);
            $this->load->view('homepage/index', $data);
            $this->load->view('templates/homepage_footer', $data);
        } else {
            // Retrieve user ID from session
            $id_user = $data['user']['id']; // Adjust 'id' according to your actual user ID column

            $kode_pengajuan = $this->input->post('kode_pengajuan');
            $jenis_surat = $this->input->post('jenis_surat');
            $sifat = $this->input->post('sifat');
            // $keterangan = $this->input->post('keterangan');

            $data = [
                'id_user' => $id_user,
                'kode_pengajuan' => $kode_pengajuan,
                'jenis_surat' => $jenis_surat,
                'sifat' => $sifat,
                'keterangan' => "-",
                'status' => 0,
                'date_created' => time(),
            ];

            // Cek jika ada gambar yg diupload =============================
            $upload_file = $_FILES['berkas_pendukung']['name'];
            $file_size = $_FILES['berkas_pendukung']['size'];

            if ($upload_file) {
                $config['allowed_types']    = 'jpeg|jpg|png|pdf';
                $config['max_size']         = '5076'; // in KB
                $config['upload_path']      = './assets/file/berkas-pendukung/';

                $this->load->library('upload', $config);

                if ($file_size > 5076000) { // 5 MB dalam bytes
                    // Jika ukuran file melebihi batas yang ditentukan
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>Gagal...</strong> Ukuran file yang Anda unggah terlalu besar. Maksimum 5 MB!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                    redirect('/');
                }

                if (!$this->upload->do_upload('berkas_pendukung')) {
                    // Jika terjadi kesalahan saat upload
                    $upload_error = $this->upload->display_errors('<p>', '</p>');
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>Gagal...</strong> ' . $upload_error . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                    redirect('/');
                } else {
                    // Jika upload berhasil
                    $upload_data = $this->upload->data();
                    $data['berkas_pendukung'] = $upload_data['file_name'];
                }
            }
            // End upload file =======================================

            $this->db->insert('pengajuan_surat', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil...</strong> pengajuan surat telah terkirim!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            } else {
                // Jika tidak ada baris yang terpengaruh, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal...</strong> permohonan surat gagal terkirim, ada kesalahan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            }

            redirect('/#pengajuan');
        }
    }
}
