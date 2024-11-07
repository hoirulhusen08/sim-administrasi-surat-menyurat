<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    // ========================== SURAT MASUK ==============================

    public function incomingMail()
    {
        $data['title'] = 'Surat Masuk';
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
        $this->load->view('staff/incomingMail', $data);
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

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/viewIncomingMail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addIncomingMail()
    {
        $data['title'] = 'Tambah Surat Masuk';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['klasifikasi_surat'] = $this->db->get('klasifikasi_surat')->result_array();

        // Rule validation
        $this->form_validation->set_rules('nomor_surat', 'No. Surat', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('tanggal_surat', 'Date', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('sumber_surat', 'Sumber', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('perihal', 'Perihal', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('lampiran', 'Lampiran', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('penerima_surat', 'Penerima', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('id_klasifikasi', 'Klasifikasi', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('isi_surat', 'Isi', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('staff/addIncomingMail', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $nomor_surat = $this->input->post('nomor_surat');
            $tanggal_surat = $this->input->post('tanggal_surat');
            $sumber_surat = $this->input->post('sumber_surat', true);
            $perihal = $this->input->post('perihal', true);
            $lampiran = $this->input->post('lampiran', true);
            $penerima_surat = $this->input->post('penerima_surat', true);
            $id_klasifikasi = $this->input->post('id_klasifikasi', true);
            $isi_surat = $this->input->post('isi_surat');

            $data = [
                'jenis_surat' => 'Surat Masuk',
                'nomor_surat' => $nomor_surat,
                'tanggal_surat' => $tanggal_surat,
                'sumber_surat' => $sumber_surat,
                'perihal' => $perihal,
                'lampiran' => $lampiran,
                'penerima_surat' => $penerima_surat,
                'id_klasifikasi' => $id_klasifikasi,
                'isi_surat' => $isi_surat,
                'status' => 0,
                'date_created' => time(),
            ];

            // Cek jika ada gambar yg diupload =============================
            $upload_file = $_FILES['file_surat_masuk']['name'];
            $file_size = $_FILES['file_surat_masuk']['size'];

            if ($upload_file) {
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = '5076';
                $config['upload_path']      = './assets/file/surat-masuk/';

                $this->load->library('upload', $config);

                if ($file_size > 5076000) { // 5 MB dalam bytes
                    // Jika ukuran file melebihi batas yang ditentukan
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Gagal...</strong> Ukuran file yang Anda unggah terlalu besar. Maksimum 5 MB!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('staff/addIncomingMail');
                }

                if ($this->upload->do_upload('file_surat_masuk')) {
                    $data['file_surat_masuk'] = $this->upload->data('file_name');
                } else {
                    // Jika tipe file upload tidak sesuai
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Gagal...</strong> Jenis file yang Anda coba unggah tidak diperbolehkan.!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('staff/addIncomingMail');
                }
            } else {
                // Jika file kosong, set error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>Gagal...</strong> File tidak boleh kosong!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('staff/addIncomingMail');
            }
            // End upload file =======================================

            $this->db->insert('surat_masuk', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil...</strong> menambahkan data surat masuk!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            } else {
                // Jika tidak ada baris yang terpengaruh, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal...</strong> data gagal ditambah, ada kesalahan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            }

            redirect('staff/incomingMail');
        }
    }

    public function editIncomingMail()
    {
        $data['title'] = 'Ubah Surat Masuk';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['klasifikasi_surat'] = $this->db->get('klasifikasi_surat')->result_array();

        $id = $this->input->get('id');
        $data['surat_masuk'] = $this->db->get_where('surat_masuk', ['id' => $id])->row_array();

        if ($data['surat_masuk']['status'] >= 4) {
            // Tampilkan pesan kesalahan
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error...</strong> surat yg telah disetujui atau terdisposisi tidak bisa diubah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('staff/incomingMail');
        } else {

            // Rule validation
            $this->form_validation->set_rules('nomor_surat', 'No. Surat', 'required|trim', [
                'required' => 'Kolom ini tidak boleh kosong.'
            ]);
            $this->form_validation->set_rules('tanggal_surat', 'Date', 'required|trim', [
                'required' => 'Kolom ini tidak boleh kosong.'
            ]);
            $this->form_validation->set_rules('sumber_surat', 'Sumber', 'required|trim', [
                'required' => 'Kolom ini tidak boleh kosong.'
            ]);
            $this->form_validation->set_rules('perihal', 'Perihal', 'required|trim', [
                'required' => 'Kolom ini tidak boleh kosong.'
            ]);
            $this->form_validation->set_rules('lampiran', 'Lampiran', 'required|trim', [
                'required' => 'Kolom ini tidak boleh kosong.'
            ]);
            $this->form_validation->set_rules('penerima_surat', 'Penerima', 'required|trim', [
                'required' => 'Kolom ini tidak boleh kosong.'
            ]);
            $this->form_validation->set_rules('id_klasifikasi', 'Klasifikasi', 'required|trim', [
                'required' => 'Kolom ini tidak boleh kosong.'
            ]);
            $this->form_validation->set_rules('isi_surat', 'Isi', 'required|trim', [
                'required' => 'Kolom ini tidak boleh kosong.'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('staff/editIncomingMail', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $id = $this->input->get('id');
                $nomor_surat = $this->input->post('nomor_surat');
                $tanggal_surat = $this->input->post('tanggal_surat');
                $sumber_surat = $this->input->post('sumber_surat', true);
                $perihal = $this->input->post('perihal', true);
                $lampiran = $this->input->post('lampiran', true);
                $penerima_surat = $this->input->post('penerima_surat', true);
                $id_klasifikasi = $this->input->post('id_klasifikasi', true);
                $isi_surat = $this->input->post('isi_surat');

                $data = [
                    'nomor_surat' => $nomor_surat,
                    'tanggal_surat' => $tanggal_surat,
                    'sumber_surat' => $sumber_surat,
                    'perihal' => $perihal,
                    'lampiran' => $lampiran,
                    'penerima_surat' => $penerima_surat,
                    'id_klasifikasi' => $id_klasifikasi,
                    'isi_surat' => $isi_surat,
                    'status' => 0,
                    'ttd' => 0,
                ];

                // Cek jika ada file yg diupload
                $upload_file = $_FILES['file_surat_masuk']['name'];

                if ($upload_file) {
                    $config['allowed_types']    = 'pdf';
                    $config['max_size']         = '5076';
                    $config['upload_path']      = './assets/file/surat-masuk/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('file_surat_masuk')) {
                        $old_file = $data['surat_masuk']['file_surat_masuk'];

                        if ($old_file) {
                            unlink(FCPATH . 'assets/file/surat-masuk/' . $old_file);
                        }

                        $new_file = $this->upload->data('file_name');
                        $this->db->set('file_surat_masuk', $new_file);
                    } else {
                        // Jika tipe file upload tidak sesuai
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Gagal...</strong> Jenis file yang Anda coba unggah tidak diperbolehkan.!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                        redirect('staff/incomingMail');
                    }
                }
                // End upload file

                $this->db->where('id', $id);
                $this->db->update('surat_masuk', $data);

                if ($this->db->affected_rows() > 0) {
                    // Jika berhasil, set pesan sukses
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil...</strong> data surat masuk telah diubah!
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

                redirect('staff/incomingMail');
            }
        }
    }

    public function deleteIncomingMail()
    {
        // Mengambil data surat masuk berdasarkan ID
        $id = $this->input->get('id');
        $surat_masuk = $this->db->where('id', $id)->get('surat_masuk')->row_array();

        var_dump($surat_masuk->status);

        if ($surat_masuk['status'] >= 4) {
            // Tampilkan pesan kesalahan
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error...</strong> surat yg telah disetujui atau terdisposisi tidak bisa dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('staff/incomingMail');
        } else {
            // Pastikan data surat ditemukan
            if ($surat_masuk) {
                $file = $surat_masuk['file_surat_masuk'];

                // unline file dari direktori
                if ($file) {
                    unlink(FCPATH . 'assets/file/surat-masuk/' . $file);
                }

                // Lakukan penghapusan data dari tabel
                $this->db->where('id', $id);
                $this->db->delete('surat_masuk');

                // Periksa apakah penghapusan berhasil
                if ($this->db->affected_rows() > 0) {
                    // Jika berhasil, set pesan sukses
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil...</strong> data surat masuk berhasil dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                } else {
                    // Jika tidak ada baris yang terpengaruh, set pesan error
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Upss...</strong> data surat masuk gagal dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                }
            } else {
                // Jika data user tidak ditemukan, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upss...</strong> data surat masuk tidak ditemukan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            }

            // Redirect ke halaman yang sesuai
            redirect('staff/incomingMail');
        }
    }

    // ========================== SURAT KELUAR ==============================

    public function outgoingMail()
    {
        $data['title'] = 'Surat Keluar';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->order_by('surat_keluar.date_created', 'DESC'); // Mengurutkan berdasarkan date_created secara descending
        $data['surat_keluar'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/outgoingMail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function get_template_by_jenis_surat() {
        $idJenisSurat = $this->input->post('jenis_surat');
        
        // Validasi ID jenis surat
        if (!$idJenisSurat) {
            echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
            return;
        }
        
        // Ambil template dari database berdasarkan ID jenis surat
        $this->db->select('template');
        $this->db->from('jenis_surat');
        $this->db->where('id', $idJenisSurat);
        $result = $this->db->get()->row_array();
        
        // Pastikan data tersedia sebelum menggunakan
        $template = isset($result['template']) ? $result['template'] : '';
        
        // Kembalikan data sebagai JSON
        echo json_encode(['status' => 'success', 'template' => $template]);
    }    

    public function addOutgoingMail()
    {
        $data['title'] = 'Tambah Surat Keluar';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['klasifikasi_surat'] = $this->db->get('klasifikasi_surat')->result_array();
        $data['jenis_surat'] = $this->db->get('jenis_surat')->result_array();
        $data['mahasiswa'] = $this->db->get_where('users', ['role_id' => 2])->result_array();
        $data['dosen'] = $this->db->get_where('users', ['role_id' => 7])->result_array();

        // ========= SKEMA CREATE KODE SURAT LAMA =========
        // Lakukan query untuk mengambil nomor terakhir dari tabel
        $query = $this->db->query('SELECT MAX(id) AS last_id FROM surat_keluar');
        $row = $query->row();
        $no_urut_surat = $row->last_id;

        // Pastikan untuk menangani kasus ketika tabel kosong
        if ($no_urut_surat === NULL) {
            $no_urut_surat = 0;
        }

        // Susun skema nomor surat
        // $data['nomor_surat'] = '...' . '/...' . '/II.3.AU' . '/FTIK' . '/F' . '/' . date('Y');
        $data['nomor_surat'] = $no_urut_surat + 1 . '/' . '/II.3.AU' . '/FTIK' . '/F' . '/' . date('Y');


        // Rule validation
        $this->form_validation->set_rules('id_klasifikasi', 'Klasifikasi', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('jenis_surat', 'Jenis', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('isi_surat', 'Isi', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('staff/addOutgoingMail', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_klasifikasi = $this->input->post('id_klasifikasi');
            if ($id_klasifikasi === "Biasa") {
                $id_klasifikasi = 1;
            } else {
                $id_klasifikasi = 2;
            }

            $id_jenis = $this->input->post('jenis_surat');
            $nomor_surat = $this->input->post('nomor_surat');
            $tgl_pelaksanaan = $this->input->post('tgl_pelaksanaan');
            $penerima_surat = $this->input->post('penerima_surat', true);
            $alamat_tujuan = $this->input->post('alamat_tujuan', true);
            $perihal = $this->input->post('perihal', true);
            $lampiran = $this->input->post('lampiran', true);
            $tentang_surat = $this->input->post('tentang_surat', true);
            $to_dosen = $this->input->post('to_dosen', true);
            $id_mahasiswa = $this->input->post('id_mahasiswa', true);
            $npm = $this->input->post('npm', true);
            $semester = $this->input->post('semester');
            $tahun_akademik = $this->input->post('tahun_akademik');
            $catatan_kaki = $this->input->post('catatan_kaki', true);
            $isi_lampiran = $this->input->post('isi_lampiran', true);
            $isi_surat = $this->input->post('isi_surat');

            // Jika ditujukan untuk mahasiswa
            if (!empty($this->input->post('id_mahasiswa'))) {
                // Manipulasi nama mahasiswa berdasarkan id select mahasiswa
                $this->db->where_in('id', [$id_mahasiswa]);
                $user_data = $this->db->get_where('users', ['role_id' => 2])->row_array();
                $nama_mahasiswa = $user_data['name'];
            } else {
                $nama_mahasiswa = '';
            }

            $data = [
                'id_klasifikasi' => $id_klasifikasi,
                'id_jenis' => $id_jenis,
                'jenis_surat' => 'Surat Keluar',
                'nomor_surat' => $nomor_surat,
                'tgl_pelaksanaan' => $tgl_pelaksanaan,
                'penerima_surat' => $penerima_surat,
                'alamat_tujuan' => $alamat_tujuan,
                'perihal' => $perihal,
                'lampiran' => $lampiran,
                'tentang_surat' => $tentang_surat,
                'id_tujuan_dosen' => $to_dosen,
                'id_user' => $id_mahasiswa,
                'nama_mahasiswa' => $nama_mahasiswa,
                'npm' => $npm,
                'semester' => $semester,
                'tahun_akademik' => $tahun_akademik,
                'isi_surat' => $isi_surat,
                'catatan_kaki' => $catatan_kaki,
                'isi_lampiran' => $isi_lampiran,
                'status' => 0,
                'tindak_lanjut' => '',
                'catatan' => '',
                'ttd' => 0,
                'date_created' => time(),
            ];

            $this->db->insert('surat_keluar', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil...</strong> menambahkan data surat keluar!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            } else {
                // Jika tidak ada baris yang terpengaruh, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal...</strong> data gagal ditambah, ada kesalahan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            }

            redirect('staff/outgoingMail');
        }
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

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/viewOutgoingMail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editOutgoingMail()
    {
        $data['title'] = 'Ubah Data Surat Keluar';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $id = $this->input->get('id');

        $this->db->select('surat_keluar.*, klasifikasi_surat.nama AS nama_klasifikasi, jenis_surat.jenis');
        $this->db->from('surat_keluar');
        $this->db->join('klasifikasi_surat', 'surat_keluar.id_klasifikasi = klasifikasi_surat.id', 'left');
        $this->db->join('jenis_surat', 'surat_keluar.id_jenis = jenis_surat.id', 'left');
        $this->db->where('surat_keluar.id', $id); // Filter by id
        $data['lihat_surat_keluar'] = $this->db->get()->row_array();

        $data['klasifikasi_surat'] = $this->db->get('klasifikasi_surat')->result_array();
        $data['jenis_surat'] = $this->db->get('jenis_surat')->result_array();
        $data['mahasiswa'] = $this->db->get_where('users', ['role_id' => 2])->result_array();

        // Rule validation
        $this->form_validation->set_rules('id_klasifikasi', 'Klasifikasi', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('jenis_surat', 'Jenis', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('isi_surat', 'Isi', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('staff/editOutgoingMail', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_klasifikasi = $this->input->post('id_klasifikasi');
            $id_jenis = $this->input->post('jenis_surat');
            $nomor_surat = $this->input->post('nomor_surat');
            $tgl_pelaksanaan = $this->input->post('tgl_pelaksanaan');
            $penerima_surat = $this->input->post('penerima_surat', true);
            $alamat_tujuan = $this->input->post('alamat_tujuan', true);
            $perihal = $this->input->post('perihal', true);
            $lampiran = $this->input->post('lampiran', true);
            $tentang_surat = $this->input->post('tentang_surat', true);
            $id_mahasiswa = $this->input->post('id_mahasiswa', true);
            $npm = $this->input->post('npm', true);
            $semester = $this->input->post('semester');
            $tahun_akademik = $this->input->post('tahun_akademik');
            $catatan_kaki = $this->input->post('catatan_kaki', true);
            $isi_lampiran = $this->input->post('isi_lampiran', true);
            $isi_surat = $this->input->post('isi_surat');

            // Manipulasi nama mahasiswa berdasarkan id select mahasiswa
            $this->db->where_in('id', [$id_mahasiswa]);
            $user_data = $this->db->get_where('users', ['role_id' => 2])->row_array();
            $nama_mahasiswa = $user_data['name'];

            $data = [
                'id_klasifikasi' => $id_klasifikasi,
                'id_jenis' => $id_jenis,
                'nomor_surat' => $nomor_surat,
                'tgl_pelaksanaan' => $tgl_pelaksanaan,
                'penerima_surat' => $penerima_surat,
                'alamat_tujuan' => $alamat_tujuan,
                'perihal' => $perihal,
                'lampiran' => $lampiran,
                'tentang_surat' => $tentang_surat,
                'id_user' => $id_mahasiswa,
                'nama_mahasiswa' => $nama_mahasiswa,
                'npm' => $npm,
                'semester' => $semester,
                'tahun_akademik' => $tahun_akademik,
                'isi_surat' => $isi_surat,
                'catatan_kaki' => $catatan_kaki,
                'isi_lampiran' => $isi_lampiran,
                'status' => 0,
                'ttd' => 0,
            ];

            $this->db->where('id', $id);
            $this->db->update('surat_keluar', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil...</strong> memperbarui data surat keluar!
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

            redirect('staff/outgoingMail');
        }
    }

    public function deleteOutgoingMail()
    {
        // Mengambil data surat masuk berdasarkan ID
        $id = $this->input->get('id');
        $surat_keluar = $this->db->where('id', $id)->get('surat_keluar')->row_array();

        if ($surat_keluar['status'] >= 4) {
            // Tampilkan pesan kesalahan
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error...</strong> surat yg telah disetujui tidak bisa dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('staff/outgoingMail');
        } else {
            // Pastikan data surat ditemukan
            if ($surat_keluar) {
                // Lakukan penghapusan data dari tabel
                $this->db->where('id', $id);
                $this->db->delete('surat_keluar');

                // Periksa apakah penghapusan berhasil
                if ($this->db->affected_rows() > 0) {
                    // Jika berhasil, set pesan sukses
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil...</strong> surat keluar telah dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                } else {
                    // Jika tidak ada baris yang terpengaruh, set pesan error
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Upss...</strong> surat keluar gagal dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                }
            } else {
                // Jika data user tidak ditemukan, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upss...</strong> data surat keluar tidak ditemukan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            }

            // Redirect ke halaman yang sesuai
            redirect('staff/outgoingMail');
        }
    }

    // =================== ARCHIVE SURAT ============================

    public function archiveMail()
    {
        $data['title'] = 'Pengarsipan Surat';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        // Pencarian Arsip
        $search = $this->input->post('search'); // Ambil data pencarian dari POST
        $arsip_surat = $this->db->like('judul_surat', $search) // Mencari di judul_surat
                                ->or_like('no_surat', $search) // Juga mencari di isi_surat
                                ->get('arsip_surat') // Ganti 'nama_tabel' dengan nama tabel yang sesuai
                                ->result();
        $data['arsip_surat'] = $arsip_surat;

        if (empty($arsip_surat)) {
            $data['pesan'] = 'Tidak ada hasil yang ditemukan untuk pencarian "' . '<b>' . $search . '</b>' . '"';
        }

        // Filter jenis surat
        // Ambil data filter dari POST
        $jenis_surat = $this->input->post('filter_jenis_surat');
        // Filter data berdasarkan jenis surat
        if (!empty($jenis_surat)) {
            $this->db->where('jenis_surat', $jenis_surat);
            
            // Ambil semua data dari tabel 'arsip_surat' dengan urutan DESC berdasarkan kolom 'id'
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('arsip_surat');
            $data['arsip_surat'] = $query->result(); // Mengembalikan hasil dalam bentuk array objek
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/archiveMail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addArchive()
    {
        $data['title'] = 'Tambah Pengarsipan';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        // Membuat skema kode pengajuan
        $query = $this->db->query('SELECT MAX(id) AS last_id FROM arsip_surat');
        $row = $query->row();
        $id_arsip_surat = $row->last_id;
        // Pastikan untuk menangani kasus ketika tabel kosong
        if ($id_arsip_surat === NULL) {
            $id_arsip_surat = 0;
        }
        // Rangkai skema kode pengajuan
        $data['kode_arsip'] = "ARS-" . date('dmY') . "-" . $id_arsip_surat;

        // Rule validation
        $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('judul_surat', 'Judul Surat', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('ringkasan_surat', 'Ringkasan Surat', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('staff/addArchive', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $kode_arsip = $this->input->post('kode_arsip');
            $jenis_surat = $this->input->post('jenis_surat');
            $no_surat = $this->input->post('no_surat');
            $judul_surat = $this->input->post('judul_surat');
            $ringkasan_surat = $this->input->post('ringkasan_surat');

            $data = [
                'kode_arsip' => $kode_arsip,
                'jenis_surat' => $jenis_surat,
                'no_surat' => $no_surat,
                'judul_surat' => $judul_surat,
                'ringkasan_surat' => $ringkasan_surat,
                'date_created' => time(),
            ];

            // Cek jika ada gambar yg diupload =============================
            $upload_file = $_FILES['file']['name'];
            $file_size = $_FILES['file']['size'];

            if ($upload_file) {
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = '5076';
                $config['upload_path']      = './assets/file/arsip/';

                $this->load->library('upload', $config);

                if ($file_size > 5076000) { // 5 MB dalam bytes
                    // Jika ukuran file melebihi batas yang ditentukan
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Gagal...</strong> Ukuran file yang Anda unggah terlalu besar. Maksimum 5 MB!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('staff/addArchive');
                }

                if ($this->upload->do_upload('file')) {
                    $data['file'] = $this->upload->data('file_name');
                } else {
                    // Jika tipe file upload tidak sesuai
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Gagal...</strong> Jenis file yang Anda coba unggah tidak diperbolehkan.!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('staff/addArchive');
                }
            } else {
                // Jika file kosong, set error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>Gagal...</strong> File tidak boleh kosong!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('staff/addArchive');
            }
            // End upload file =======================================

            $this->db->insert('arsip_surat', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil...</strong> menambahkan data Arsip!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            } else {
                // Jika tidak ada baris yang terpengaruh, set pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal...</strong> data gagal ditambah, ada kesalahan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            }

            redirect('staff/archiveMail');
        }
    }

    public function editArchive()
    {
        $data['title'] = 'Edit Arsip Surat';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $id = $this->input->get('id');
        $data['arsip_surat'] = $this->db->get_where('arsip_surat', ['id' => $id])->row_array();

        // Rule validation
        $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('judul_surat', 'Judul Surat', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('ringkasan_surat', 'Ringkasan Surat', 'required|trim', [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('staff/editArchive', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id = $this->input->get('id');
            $jenis_surat = $this->input->post('jenis_surat');
            $no_surat = $this->input->post('no_surat');
            $judul_surat = $this->input->post('judul_surat');
            $ringkasan_surat = $this->input->post('ringkasan_surat');

            $data = [
                'jenis_surat' => $jenis_surat,
                'no_surat' => $no_surat,
                'judul_surat' => $judul_surat,
                'ringkasan_surat' => $ringkasan_surat,
            ];

            // Cek jika ada file yg diupload
            $upload_file = $_FILES['file']['name'];

            if ($upload_file) {
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = '5076';
                $config['upload_path']      = './assets/file/arsip/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $old_file = $data['arsip_surat']['file'];

                    if ($old_file) {
                        $deleted = unlink(FCPATH . 'assets/file/arsip/' . $old_file);
                        if (!$deleted) {
                            // Handle error, perhaps log it
                            log_message('error', 'Failed to delete file: ' . $old_file);
                        }
                    }

                    $new_file = $this->upload->data('file_name');
                    $this->db->set('file', $new_file);
                } else {
                    // Jika tipe file upload tidak sesuai
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Gagal...</strong> Jenis file yang Anda coba unggah tidak diperbolehkan.!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('staff/archiveMail');
                }
            }
            // End upload file

            $this->db->where('id', $id);
            $this->db->update('arsip_surat', $data);

            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil...</strong> data surat masuk telah diubah!
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

            redirect('staff/archiveMail');
        }
    }

    public function detailArchive()
    {
        $data['title'] = 'Detail Surat';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $id = $this->input->get('id');
        $data['arsip_surat'] = $this->db->get_where('arsip_surat', ['id' => $id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/detailArchive', $data);
        $this->load->view('templates/footer', $data);
    }

    public function deleteArchive()
    {
        // Mengambil data berdasarkan ID
        $id = $this->input->get('id');
        $arsip_surat = $this->db->where('id', $id)->get('arsip_surat')->row_array();

        // Pastikan data surat ditemukan
        if ($arsip_surat) {
            // Jika ada file hapus
            $file_arsip = $arsip_surat['file'];
            if ($file_arsip) {
                // Hapus gambar dari direktori
                unlink(FCPATH . 'assets/file/arsip/' . $file_arsip);
            }

            // Lakukan penghapusan data dari tabel
            $this->db->where('id', $id);
            $this->db->delete('arsip_surat');

            // Periksa apakah penghapusan berhasil
            if ($this->db->affected_rows() > 0) {
                // Jika berhasil, set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil...</strong> data arsip telah dihapus!
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
        redirect('staff/archiveMail');
    }

}
