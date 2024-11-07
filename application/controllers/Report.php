<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Lihat Laporan';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        // Ambil data dari form
        $jenis_surat = $this->input->post('jenis_surat');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        // Simpan data untuk digunakan dalam view
        $data['jenis_surat'] = $jenis_surat;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;

        $from_date_converted = strtotime($from_date);
        $to_date_converted = strtotime($to_date);

        // Query untuk filter data berdasarkan kriteria
        $this->db->select('*');
        if ($jenis_surat == 'Surat Masuk') {
            $this->db->from('surat_masuk');
        } elseif ($jenis_surat == 'Surat Keluar') {
            $this->db->from('surat_keluar');
        } else {
            // Default, ambil dari surat_masuk jika jenis surat tidak terdefinisi
            $this->db->from('surat_masuk');
            $this->db->where('id', 0); // Anda mungkin perlu memperbaiki ini sesuai kebutuhan
        }

        if (!empty($jenis_surat)) {
            $this->db->where('jenis_surat', $jenis_surat);
        }
        if (!empty($from_date_converted) && !empty($to_date_converted)) {
            $this->db->where('date_created >=', $from_date_converted);
            $this->db->where('date_created <=', $to_date_converted);
        }
        $query = $this->db->get();
        $data['results'] = $query->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('report/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function printAllReport()
    {
        // Ambil parameter dari URL
        $jenis_surat = $this->input->get('jenis_surat');
        $from_date = $this->input->get('from_date');
        $to_date = $this->input->get('to_date');

        $from_date_converted = strtotime($from_date);
        $to_date_converted = strtotime($to_date);

        $data['setting'] = $this->db->get('setting')->row_array();

        // Ambil data dari database
        $this->db->select('*');
        if ($jenis_surat == 'Surat Masuk') {
            $this->db->from('surat_masuk');
        } elseif ($jenis_surat == 'Surat Keluar') {
            $this->db->from('surat_keluar');
        } else {
            $this->db->from('surat_masuk');
            $this->db->where('id', 0); // Menampilkan data kosong jika jenis surat tidak dikenali
        }

        if (!empty($jenis_surat)) {
            $this->db->where('jenis_surat', $jenis_surat);
        }
        if (!empty($from_date_converted) && !empty($to_date_converted)) {
            $this->db->where('date_created >=', $from_date_converted);
            $this->db->where('date_created <=', $to_date_converted);
        }
        $query = $this->db->get();
        $data['results'] = $query->result_array();

        // Load view untuk diubah menjadi PDF
        $html = $this->load->view('report/printAllReport', $data, true);
        $filename = "Laporan_" . date('Ymd_His') . ".pdf";

        // Buat instance Mpdf
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 3,
            // 'margin_right' => 0,
            // 'margin_bottom' => 0,
            // 'margin_left' => 0,
        ]);

        // Set watermark teks
        $mpdf->SetWatermarkText('UMKO', 0.03); // 0.1 adalah transparansi (0.0 sampai 1.0)
        $mpdf->showWatermarkText = true;

        // Menulis HTML ke PDF
        $mpdf->WriteHTML($html);

        // Output PDF
        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }

    public function printReport()
    {
        // Ambil parameter dari URL
        $id = $this->input->get('id');
        $jenis_surat = $this->input->get('jenis_surat');

        // Tentukan tabel yang digunakan berdasarkan jenis surat
        $table = ($jenis_surat == 'Surat Masuk') ? 'surat_masuk' : 'surat_keluar';

        // Ambil data spesifik dari database dan join dengan tabel klasifikasi_surat
        $this->db->select($table . '.*, klasifikasi_surat.nama as nama_klasifikasi');
        $this->db->from($table);
        $this->db->join('klasifikasi_surat', $table . '.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->where($table . '.id', $id);
        $query = $this->db->get();
        $data['result'] = $query->row_array();

        if (!$data['result']) {
            show_404(); // Jika data tidak ditemukan
        }

        $data['setting'] = $this->db->get('setting')->row_array();

        // Load view untuk diubah menjadi PDF
        $html = $this->load->view('report/printReport', $data, true);
        $filename = "Laporan_" . date('Ymd_His') . ".pdf";

        // Buat instance Mpdf
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 3,
        ]);

        // Set watermark teks
        $mpdf->SetWatermarkText('UMKO', 0.03); // 0.1 adalah transparansi (0.0 sampai 1.0)
        $mpdf->showWatermarkText = true;

        // Menulis HTML ke PDF
        $mpdf->WriteHTML($html);

        // Output PDF
        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }

}
