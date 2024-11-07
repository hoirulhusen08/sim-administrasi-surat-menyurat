<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lead extends CI_Controller
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
        $data['title'] = 'Validasi Surat Masuk';
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
        $this->load->view('lead/incomingMail', $data);
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
        $this->form_validation->set_rules('tindak_lanjut', 'Tindak Lanjut', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('lead/viewIncomingMail', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id = $this->input->get('id');
            $status = $this->input->post('status');
            $tindak_lanjut = $this->input->post('tindak_lanjut');
            $catatan = $this->input->post('catatan');

            $data = [
                'status' => $status,
                'tindak_lanjut' => $tindak_lanjut,
                'catatan' => $catatan,
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

            redirect('lead/incomingMail');
        }
    }

    public function disposisiMail()
    {
        $data['title'] = 'Disposisikan Surat';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $id = $this->input->get('id'); // Dapatkan id dari URL

        $this->db->select('surat_masuk.*, klasifikasi_surat.nama AS nama_klasifikasi');
        $this->db->from('surat_masuk');
        $this->db->join('klasifikasi_surat', 'surat_masuk.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->where('surat_masuk.id', $id); // Tambahkan where clause untuk filter berdasarkan id
        $data['surat_masuk'] = $this->db->get()->row_array(); // Gunakan row_array() untuk mendapatkan 1 baris data

        // Dapatkan Kode User berdasarkan user yg sedang login
        $data['kode_user'] =  $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        // Lakukan query untuk mengambil nomor terakhir dari tabel
        $query = $this->db->query('SELECT MAX(id) AS last_id FROM disposisi_surat');
        $row = $query->row();
        $id_user_increment = $row->last_id;

        // Pastikan untuk menangani kasus ketika tabel kosong
        if ($id_user_increment === NULL) {
            $id_user_increment = 0;
        }

        $data['kode_disposisi'] = date('Ymd') . '-' . $data['kode_user']['kode_user'];
        // $data['kode_disposisi'] = date('Ymd') . '-' . $data['kode_user']['kode_user'] . '-' . $id_user_increment;

        // Rule validation
        $this->form_validation->set_rules('kode_disposisi', 'Kode Disposisi', 'required|is_unique[disposisi_surat.kode_disposisi]', [
            'required' => 'Kolom ini tidak boleh kosong.',
            'is_unique' => 'Kode Disposisi sudah ada, tidak boleh sama dengan yang ada di database.'
        ]);
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('departemen', 'Departemen', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('batas_waktu', 'Range', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('lead/disposisiMail', $data);
            $this->load->view('templates/footer', $data);
        } else {

            // Update field status Surat Masuk
            $status = $this->input->post('status');

            $data_status_surat = ['status' => $status];

            $this->db->where('id', $id);
            $this->db->update('surat_masuk', $data_status_surat);


            // Tambah data tabel disposisi
            $kode_disposisi = $this->input->post('kode_disposisi');
            $id_surat = $data['surat_masuk']['id'];
            $tujuan = $this->input->post('tujuan');
            $departemen = $this->input->post('departemen');
            $batas_waktu = $this->input->post('batas_waktu');
            $tindakan = $this->input->post('tindakan');
            $catatan = $this->input->post('catatan');
            $date_created = time();

            $data = [
                'kode_disposisi' => $kode_disposisi,
                'id_surat' => $id_surat,
                'tujuan' => $tujuan,
                'departemen' => $departemen,
                'batas_waktu' => $batas_waktu,
                'tindakan' => $tindakan,
                'catatan' => $catatan,
                'date_created' => $date_created,
            ];

            $this->db->insert('disposisi_surat', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil...</strong> surat telah didisposisikan!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
            } else {
                // Jika tidak ada baris yang terpengaruh, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal...</strong> surat gagal didisposisikan, ada kesalahan!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
            }

            redirect('lead/incomingMail');
        }
    }

    public function listDisposisi()
    {
        $data['title'] = 'Disposisi Surat';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $this->db->select('disposisi_surat.*, surat_masuk.nomor_surat, klasifikasi_surat.nama');
        $this->db->from('disposisi_surat');
        $this->db->join('surat_masuk', 'disposisi_surat.id_surat = surat_masuk.id', 'left');
        $this->db->join('klasifikasi_surat', 'surat_masuk.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->order_by('disposisi_surat.id', 'DESC');
        $data['disposisi_surat'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('lead/listDisposisi', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editDisposisi()
    {
        $data['title'] = 'Ubah Data Disposisi Surat';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $id = $this->input->get('id');
        $data['disposisi_surat'] = $this->db->get_where('disposisi_surat', ['id' => $id])->row_array();

        // Rule validation
        $this->form_validation->set_rules('kode_disposisi', 'Kode Disposisi', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.',
        ]);
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('departemen', 'Departemen', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('batas_waktu', 'Range', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('lead/editDisposisi', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id = $this->input->get('id'); // Dapatkan id dari URL

            $tujuan = $this->input->post('tujuan');
            $departemen = $this->input->post('departemen');
            $batas_waktu = $this->input->post('batas_waktu');
            $tindakan = $this->input->post('tindakan');
            $catatan = $this->input->post('catatan');

            $data = [
                'tujuan' => $tujuan,
                'departemen' => $departemen,
                'batas_waktu' => $batas_waktu,
                'tindakan' => $tindakan,
                'catatan' => $catatan,
            ];

            $this->db->where('id', $id);
            $this->db->update('disposisi_surat', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil...</strong> disposisi surat telah diperbarui!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
            } else {
                // Jika tidak ada baris yang terpengaruh, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal...</strong> disposisi surat gagal diperbarui, ada kesalahan!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
            }

            redirect('lead/listDisposisi');
        }
    }

    public function disposisiPDF()
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
        $this->db->where('disposisi_surat.id', $id); // Menambahkan where clause untuk filter berdasarkan id

        $data['disposisi_surat'] = $this->db->get()->row_array();
        
        $data['setting'] = $this->db->get('setting')->row_array();

        $html = $this->load->view('lead/singleDisposisiPDF', $data, true);

        // Nama for save PDF
        $filename = "Disposisi_" . $data['disposisi_surat']['nomor_surat'] . "_" . date('dFY') . ".pdf";

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
        $data['title'] = 'Validasi Surat Keluar';
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
        $this->load->view('lead/outgoingMail', $data);
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
        $this->form_validation->set_rules('tindak_lanjut', 'Tindak Lanjut', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('lead/viewOutgoingMail', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id = $this->input->get('id');
            $status = $this->input->post('status');
            $tindak_lanjut = $this->input->post('tindak_lanjut');
            $catatan = $this->input->post('catatan');

            $data = [
                'status' => $status,
                'tindak_lanjut' => $tindak_lanjut,
                'catatan' => $catatan,
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

            redirect('lead/outgoingMail');
        }
    }

    public function manageReport()
    {
        $data['title'] = 'Kelola Laporan';
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
        $this->load->view('lead/manageReport', $data);
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
        $html = $this->load->view('lead/printAllReport', $data, true);
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
        $html = $this->load->view('lead/printReport', $data, true);
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
