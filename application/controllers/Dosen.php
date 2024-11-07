<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        // Memuat helper
        $this->load->helper('convert_date_hijriyah');
    }

    public function incomingMail()
    {
        $data['title'] = 'Unduh Surat Masuk';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $this->db->select('surat_masuk.*, klasifikasi_surat.nama AS nama_klasifikasi');
        $this->db->from('surat_masuk');
        $this->db->join('klasifikasi_surat', 'surat_masuk.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->order_by('surat_masuk.date_created', 'DESC');
        $this->db->where('status', 5);
        $data['surat_masuk'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/incomingMail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function downloadIncomingMailPDF()
    {
        $id = $this->input->get('id'); // Dapatkan id dari URL

        $this->db->select('
            disposisi_surat.catatan AS disposisi_catatan, 
            surat_masuk.catatan AS surat_catatan, 
            disposisi_surat.*, 
            surat_masuk.*, 
            klasifikasi_surat.nama
        ');
        $this->db->from('disposisi_surat');
        $this->db->join('surat_masuk', 'disposisi_surat.id_surat = surat_masuk.id', 'left');
        $this->db->join('klasifikasi_surat', 'surat_masuk.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->where('disposisi_surat.id_surat', $id);
        $data['disposisi_surat'] = $this->db->get()->row_array();

        $data['setting'] = $this->db->get('setting')->row_array();

        $html = $this->load->view('dosen/downloadIncomingMailPDF', $data, true);

        // Nama for save PDF
        $filename = "Disposisi-" . $data['disposisi_surat']['nomor_surat'] . "-" . '(' . date('d-F-Y') . ')' . ".pdf";

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 3,
            // 'margin_right' => 0,
            // 'margin_bottom' => 0,
            // 'margin_left' => 0,
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }

    public function outgoingMail()
    {
        $data['title'] = 'Unduh Surat Keluar';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        // Mendapatkan role_id pengguna yang login
        $role_id = $this->session->userdata('role_id'); // Sesuaikan jika menggunakan metode lain untuk mendapatkan role_id

        // Memeriksa kondisi role_id
        if ($role_id == 7 || $role_id == 'Dosen') {
            $id_user = $this->session->userdata('user_id');
            // Jika role_id adalah 7 atau 'Dosen'
            $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis, jenis_surat.id AS id_jenis_surat');
            $this->db->from('surat_keluar');
            $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
            $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
            $this->db->order_by('surat_keluar.date_created', 'DESC');
            $this->db->where('status', 4);
            $this->db->where('jenis_surat.kategori', 'Dosen'); // Menambahkan kondisi kategori 'Dosen'
            $this->db->where('id_tujuan_dosen', $id_user); // Menambahkan kondisi id_tujuan_dosen
        } else {
            // Jika role_id adalah 'Staf FTIK' atau yang lainnya
            $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis, jenis_surat.id AS id_jenis_surat');
            $this->db->from('surat_keluar');
            $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
            $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
            $this->db->order_by('surat_keluar.date_created', 'DESC');
            $this->db->where('status', 4);
            // Kondisi tambahan untuk 'Staf FTIK' atau yang lain dapat ditambahkan di sini jika diperlukan
        }

        $data['surat_keluar'] = $this->db->get()->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/outgoingMail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function downloadOutgoingMailPDF1()
    {
        $id = $this->input->get('id'); // Dapatkan id dari URL

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis, jenis_surat.id AS id_jenis_surat');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->where('surat_keluar.id', $id);
        $data['surat_keluar'] = $this->db->get()->row_array();

        $data['setting'] = $this->db->get('setting')->row_array();

        $html = $this->load->view('dosen/downloadOutgoingMailPDF1', $data, true);
        $attachmentPDF = $this->load->view('dosen/attachmentOutgoingMailPDF', $data, true);

        // Nama for save PDF
        $filename = "Surat-Keluar-" . $data['surat_keluar']['nomor_surat'] . "-" . '(' . date('d-F-Y') . ')' . ".pdf";

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 3,
            // 'margin_right' => 0,
            // 'margin_bottom' => 0,
            // 'margin_left' => 0,
        ]);
        $mpdf->WriteHTML($html);

        // Jika lampiran ada isinya buat halaman baru
        if (!empty($data['surat_keluar']['isi_lampiran'])) {
            $mpdf->AddPage();
            $mpdf->SetMargins(15, 15, 15); // Left, Right, Top
            $mpdf->WriteHTML($attachmentPDF);
        }

        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }

    public function downloadOutgoingMailPDF2()
    {
        $id = $this->input->get('id'); // Dapatkan id dari URL

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis, jenis_surat.id AS id_jenis_surat');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->where('surat_keluar.id', $id);
        $data['surat_keluar'] = $this->db->get()->row_array();

        $data['setting'] = $this->db->get('setting')->row_array();

        $html = $this->load->view('dosen/downloadOutgoingMailPDF2', $data, true);
        $attachmentPDF = $this->load->view('dosen/attachmentOutgoingMailPDF', $data, true);

        // Nama for save PDF
        $filename = "Surat-Keluar-" . $data['surat_keluar']['nomor_surat'] . "-" . '(' . date('d-F-Y') . ')' . ".pdf";

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 3,
            // 'margin_right' => 0,
            // 'margin_bottom' => 0,
            // 'margin_left' => 0,
        ]);
        $mpdf->WriteHTML($html);

        // Jika lampiran ada isinya buat halaman baru
        if (!empty($data['surat_keluar']['isi_lampiran'])) {
            $mpdf->AddPage();
            $mpdf->SetMargins(15, 15, 15); // Left, Right, Top
            $mpdf->WriteHTML($attachmentPDF);
        }

        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }

    public function downloadOutgoingMailPDF3()
    {
        $id = $this->input->get('id'); // Dapatkan id dari URL

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis, jenis_surat.id AS id_jenis_surat');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->where('surat_keluar.id', $id);
        $data['surat_keluar'] = $this->db->get()->row_array();

        $data['setting'] = $this->db->get('setting')->row_array();

        $html = $this->load->view('dosen/downloadOutgoingMailPDF3', $data, true);
        $attachmentPDF = $this->load->view('dosen/attachmentOutgoingMailPDF', $data, true);

        // Nama for save PDF
        $filename = "Surat-Keluar-" . $data['surat_keluar']['nomor_surat'] . "-" . '(' . date('d-F-Y') . ')' . ".pdf";

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 3,
            // 'margin_right' => 0,
            // 'margin_bottom' => 0,
            // 'margin_left' => 0,
        ]);
        $mpdf->WriteHTML($html);

        // Jika lampiran ada isinya buat halaman baru
        if (!empty($data['surat_keluar']['isi_lampiran'])) {
            $mpdf->AddPage();
            $mpdf->SetMargins(15, 15, 15); // Left, Right, Top
            $mpdf->WriteHTML($attachmentPDF);
        }

        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }

    public function downloadOutgoingMailPDF4()
    {
        $id = $this->input->get('id'); // Dapatkan id dari URL

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis, jenis_surat.id AS id_jenis_surat');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->where('surat_keluar.id', $id);
        $data['surat_keluar'] = $this->db->get()->row_array();

        $data['setting'] = $this->db->get('setting')->row_array();

        $html = $this->load->view('dosen/downloadOutgoingMailPDF4', $data, true);
        $attachmentPDF = $this->load->view('dosen/attachmentOutgoingMailPDF', $data, true);

        // Nama for save PDF
        $filename = "Surat-Keluar-" . $data['surat_keluar']['nomor_surat'] . "-" . '(' . date('d-F-Y') . ')' . ".pdf";

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 3,
            // 'margin_right' => 0,
            // 'margin_bottom' => 0,
            // 'margin_left' => 0,
        ]);
        $mpdf->WriteHTML($html);

        // Jika lampiran ada isinya buat halaman baru
        if (!empty($data['surat_keluar']['isi_lampiran'])) {
            $mpdf->AddPage();
            $mpdf->SetMargins(15, 15, 15); // Left, Right, Top
            $mpdf->WriteHTML($attachmentPDF);
        }

        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }

    public function downloadOutgoingMailPDF7()
    {
        $id = $this->input->get('id'); // Dapatkan id dari URL

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis, jenis_surat.id AS id_jenis_surat');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->where('surat_keluar.id', $id);
        $data['surat_keluar'] = $this->db->get()->row_array();

        $data['setting'] = $this->db->get('setting')->row_array();

        $html = $this->load->view('dosen/downloadOutgoingMailPDF7', $data, true);
        $attachmentPDF = $this->load->view('dosen/attachmentOutgoingMailPDF', $data, true);

        // Nama for save PDF
        $filename = "Surat-Keluar-" . $data['surat_keluar']['nomor_surat'] . "-" . '(' . date('d-F-Y') . ')' . ".pdf";

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 3,
            // 'margin_right' => 0,
            // 'margin_bottom' => 0,
            // 'margin_left' => 0,
        ]);
        $mpdf->WriteHTML($html);

        // Jika lampiran ada isinya buat halaman baru
        if (!empty($data['surat_keluar']['isi_lampiran'])) {
            $mpdf->AddPage();
            $mpdf->SetMargins(15, 15, 15); // Left, Right, Top
            $mpdf->WriteHTML($attachmentPDF);
        }

        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }

    public function downloadOutgoingMailPDF8()
    {
        $id = $this->input->get('id'); // Dapatkan id dari URL

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis, jenis_surat.id AS id_jenis_surat');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->where('surat_keluar.id', $id);
        $data['surat_keluar'] = $this->db->get()->row_array();

        $data['setting'] = $this->db->get('setting')->row_array();

        $html = $this->load->view('dosen/downloadOutgoingMailPDF8', $data, true);
        $attachmentPDF = $this->load->view('dosen/attachmentOutgoingMailPDF', $data, true);

        // Nama for save PDF
        $filename = "Surat-Keluar-" . $data['surat_keluar']['nomor_surat'] . "-" . '(' . date('d-F-Y') . ')' . ".pdf";

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'legal',
            'margin_top' => 3,
            // 'margin_bottom' => 0,
            // 'margin_right' => 0,
            // 'margin_left' => 0,
        ]);
        $mpdf->WriteHTML($html);

        // Jika lampiran ada isinya buat halaman baru
        if (!empty($data['surat_keluar']['isi_lampiran'])) {
            $mpdf->AddPage();
            $mpdf->SetMargins(15, 15, 15); // Left, Right, Top
            $mpdf->WriteHTML($attachmentPDF);
        }

        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }

    public function downloadOutgoingMailPDF9()
    {
        $id = $this->input->get('id'); // Dapatkan id dari URL

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis, jenis_surat.id AS id_jenis_surat');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->where('surat_keluar.id', $id);
        $data['surat_keluar'] = $this->db->get()->row_array();

        $data['setting'] = $this->db->get('setting')->row_array();

        $html = $this->load->view('dosen/downloadOutgoingMailPDF9', $data, true);
        $attachmentPDF = $this->load->view('dosen/attachmentOutgoingMailPDF', $data, true);

        // Nama for save PDF
        $filename = "Surat-Keluar-" . $data['surat_keluar']['nomor_surat'] . "-" . '(' . date('d-F-Y') . ')' . ".pdf";

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 3,
            // 'margin_right' => 0,
            // 'margin_bottom' => 0,
            // 'margin_left' => 0,
        ]);
        $mpdf->WriteHTML($html);

        // Jika lampiran ada isinya buat halaman baru
        if (!empty($data['surat_keluar']['isi_lampiran'])) {
            $mpdf->AddPage();
            $mpdf->SetMargins(15, 15, 15); // Left, Right, Top
            $mpdf->WriteHTML($attachmentPDF);
        }

        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }

    public function downloadOutgoingMailPDF10()
    {
        $id = $this->input->get('id'); // Dapatkan id dari URL

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis, jenis_surat.id AS id_jenis_surat');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->where('surat_keluar.id', $id);
        $data['surat_keluar'] = $this->db->get()->row_array();

        $data['setting'] = $this->db->get('setting')->row_array();

        $html = $this->load->view('dosen/downloadOutgoingMailPDF10', $data, true);
        $attachmentPDF = $this->load->view('dosen/attachmentOutgoingMailPDF', $data, true);

        // Nama for save PDF
        $filename = "Surat-Keluar-" . $data['surat_keluar']['nomor_surat'] . "-" . '(' . date('d-F-Y') . ')' . ".pdf";

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 3,
            // 'margin_right' => 0,
            // 'margin_bottom' => 0,
            // 'margin_left' => 0,
        ]);
        $mpdf->WriteHTML($html);

        // Jika lampiran ada isinya buat halaman baru
        if (!empty($data['surat_keluar']['isi_lampiran'])) {
            $mpdf->AddPage();
            $mpdf->SetMargins(15, 15, 15); // Left, Right, Top
            $mpdf->WriteHTML($attachmentPDF);
        }

        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }
}
