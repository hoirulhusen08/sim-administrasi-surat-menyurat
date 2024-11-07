<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dekan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function incomingMail()
    {
        $data['title'] = 'TTD Surat Masuk';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $this->db->select('surat_masuk.*, klasifikasi_surat.nama AS nama_klasifikasi');
        $this->db->from('surat_masuk');
        $this->db->join('klasifikasi_surat', 'surat_masuk.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->order_by('surat_masuk.date_created', 'DESC'); // Mengurutkan berdasarkan date_created secara descending
        $data['surat_masuk'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dekan/incomingMail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function viewIncomingMail()
    {
        $data['title'] = 'Detail Surat Masuk';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $id = $this->input->get('id');

        $this->db->select('surat_masuk.*, klasifikasi_surat.nama AS nama_klasifikasi');
        $this->db->from('surat_masuk');
        $this->db->join('klasifikasi_surat', 'surat_masuk.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->where('surat_masuk.id', $id);
        $data['lihat_surat_masuk'] = $this->db->get()->row_array();

        // Rule validation
        $this->form_validation->set_rules('status', 'Status', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('dekan/viewIncomingMail', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id = $this->input->get('id');
            $status = $this->input->post('status');

            $data = [
                'status' => $status,
                'ttd' => 1,
            ];

            $this->db->where('id', $id);
            $this->db->update('surat_masuk', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil...</strong> data telah diperbarui!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            } else {
                // Jika tidak ada baris yang terpengaruh, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal...</strong> data gagal diperbarui, ada kesalahan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            }

            redirect('dekan/incomingMail');
        }
    }

    public function outgoingMail()
    {
        $data['title'] = 'TTD Surat Keluar';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->order_by('surat_keluar.date_created', 'DESC');
        $data['surat_keluar'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dekan/outgoingMail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function viewOutgoingMail()
    {
        $data['title'] = 'Detail Surat Keluar';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $id = $this->input->get('id');

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->where('surat_keluar.id', $id); // Filter by id
        $data['lihat_surat_keluar'] = $this->db->get()->row_array();

        // Rule validation
        $this->form_validation->set_rules('status', 'Status', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('dekan/viewOutgoingMail', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id = $this->input->get('id');
            $status = $this->input->post('status');

            $data = [
                'status' => $status,
                'ttd' => 1,
            ];

            $this->db->where('id', $id);
            $this->db->update('surat_keluar', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil...</strong> data telah diperbarui!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            } else {
                // Jika tidak ada baris yang terpengaruh, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal...</strong> data gagal diperbarui, ada kesalahan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            }

            redirect('dekan/outgoingMail');
        }
    }
}
