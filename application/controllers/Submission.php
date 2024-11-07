<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submission extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    // ======================= DAFTAR PERMOHONAN SURAT ============================
    public function listLetter()
    {
        $data['title'] = 'Pengajuan Surat';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $this->db->select('pengajuan_surat.*, users.name AS nama_user');
        $this->db->from('pengajuan_surat');
        $this->db->join('users', 'users.id = pengajuan_surat.id_user');
        $this->db->order_by('pengajuan_surat.id', 'DESC');

        $query = $this->db->get();
        $data['pengajuan_surat'] = $query->result();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('submission/listLetter', $data);
        $this->load->view('templates/footer', $data);
    }

    public function viewSubmissionLetter()
    {
        $data['title'] = 'Detail Permohonan Surat';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $id = $this->input->get('id'); // Mengambil id dari URL

        $this->db->select('pengajuan_surat.*, users.name AS nama_user');
        $this->db->from('pengajuan_surat');
        $this->db->join('users', 'users.id = pengajuan_surat.id_user');
        $this->db->where('pengajuan_surat.id', $id); // Filter berdasarkan id

        $query = $this->db->get();
        $data['pengajuan_surat'] = $query->row(); // Menggunakan row() karena hanya ingin satu baris data

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('submission/viewSubmissionLetter', $data);
        $this->load->view('templates/footer', $data);

        // Update ketika dilihat
        $id_pengajuan = $this->input->get('id');
        $this->db->where('id', $id_pengajuan);
        $query = $this->db->get('pengajuan_surat');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            if ($row->dilihat == 0) {
                // Update status dan dilihat saat pertama kali dilihat
                $data = [
                    'status' => 1,
                    'dilihat' => 1
                ];
            } else {
                // Hanya update dilihat jika sudah pernah dilihat sebelumnya
                $data = [
                    'dilihat' => 1
                ];
            }

            $this->db->where('id', $id_pengajuan);
            $this->db->update('pengajuan_surat', $data);

            // Outputkan pesan jika perlu
            if ($this->db->affected_rows() > 0) {
                // echo "Status updated successfully.";
            } else {
                // echo "No changes made.";
            }
        } else {
            echo "Record not found.";
        }
    }

    public function get_notifications() {
        $this->db->select('pengajuan_surat.id, users.name AS nama_pengaju, users.image, pengajuan_surat.date_created');
        $this->db->from('pengajuan_surat');
        $this->db->join('users', 'pengajuan_surat.id_user = users.id');
        $this->db->where('pengajuan_surat.dilihat', 0);
        $query = $this->db->get();
        $notifications = $query->result_array();
        
        // Hitung jumlah notifikasi
        $count = count($notifications);
        
        // Kirim data sebagai JSON
        $response = [
            'count' => $count,
            'notifications' => $notifications
        ];
        
        echo json_encode($response);
    }               

    // Update status oleh Staff
    public function updateStatusPengajuan()
    {
            $id = $this->input->get('id');
            $status = $this->input->post('status');
            $catatan_penolakan = $this->input->post('catatan_penolakan');

            $data = [
                'status' => $status,
                'catatan_penolakan' => $catatan_penolakan,
            ];

            $this->db->where('id', $id);
            $this->db->update('pengajuan_surat', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil...</strong> status telah diubah!
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

            redirect('submission/listLetter');
    }

}
