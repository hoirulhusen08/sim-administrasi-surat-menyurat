<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <h5 class="mt-4"><a style="text-decoration: none;" href="<?= base_url('staff/outgoingMail'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>

    <form method="post" action="<?= base_url('staff/addOutgoingMail'); ?>" enctype="multipart/form-data">
        <div class="card shadow p-5 mb-5">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Jenis dan Klasifikasi Surat -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="jenis_surat"><span style="color: red;">* </span>Jenis Surat <small>(Wajib diisi)</small></label>
                                <select name="jenis_surat" id="jenis_surat" class="form-control select2 <?= (form_error('jenis_surat') ? 'is-invalid' : '') ?>" onchange="updateKlasifikasi(); updateTentang();">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($jenis_surat as $row) : ?>
                                        <?php if(!empty($row['template'])) : ?>
                                            <option value="<?= $row['id'] ?>">
                                                <?= $row['jenis'] ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('jenis_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="id_klasifikasi"><span style="color: red;">* </span>Sifat Surat <small>(Wajib diisi)</small></label>
                                <!-- <select name="id_klasifikasi" id="id_klasifikasi" class="form-control <?= (form_error('id_klasifikasi') ? 'is-invalid' : '') ?>" readonly>
                                    <option value="">-- Pilih --</option>
                                    <option value="1">Biasa</option>
                                    <option value="2">Penting</option>
                                </select> -->
                                <input type="text" name="id_klasifikasi" id="id_klasifikasi" class="form-control <?= (form_error('id_klasifikasi') ? 'is-invalid' : '') ?>" readonly>
                                <?= form_error('id_klasifikasi', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Jenis dan Klasifikasi Surat -->

                    <!-- Sifat Surat Otomatis -->
                    <script>
                        function updateKlasifikasi() {
                            const jenisSurat = document.getElementById('jenis_surat').value;
                            const klasifikasiSurat = document.getElementById('id_klasifikasi');

                            // Reset nilai sifat
                            klasifikasiSurat.value = ''; // Biasa = 1, Penting = 2

                            switch (jenisSurat) {
                                case '1':
                                    klasifikasiSurat.value = 'Biasa';
                                    break;
                                case '2':
                                    klasifikasiSurat.value = 'Penting';
                                    break;
                                case '3':
                                    klasifikasiSurat.value = 'Biasa';
                                    break;
                                case '4':
                                    klasifikasiSurat.value = 'Biasa';
                                    break;
                                case '5':
                                    klasifikasiSurat.value = 'Penting';
                                    break;
                                case '6':
                                    klasifikasiSurat.value = 'Penting';
                                    break;
                                case '7':
                                    klasifikasiSurat.value = 'Penting';
                                    break;
                                case '8':
                                    klasifikasiSurat.value = 'Penting';
                                    break;
                                case '9':
                                    klasifikasiSurat.value = 'Biasa';
                                    break;
                                case '10':
                                    klasifikasiSurat.value = 'Biasa';
                                    break;
                                default:
                                    klasifikasiSurat.value = '';
                                    break;
                            }
                        }
                    </script>

                    <div class="form-group" id="NomorSurat">
                        <label for="nomor_surat"><span style="color: red;">* </span>Nomor Surat <small>(Wajib diisi)</small></label>
                        <input type="text" name="nomor_surat" class="form-control <?= (form_error('nomor_surat') ? 'is-invalid' : '') ?>" id="nomor_surat" value="<?= $nomor_surat; ?>" placeholder="Nomor surat...">
                        <?= form_error('nomor_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group" id="TanggalPelaksanaan">
                        <label for="tgl_pelaksanaan"><span style="color: red;">* </span>Tanggal Pelaksanaan <small>(Wajib diisi)</small></label>
                        <input type="date" name="tgl_pelaksanaan" value="<?= set_value('tgl_pelaksanaan'); ?>" class="form-control <?= (form_error('tgl_pelaksanaan') ? 'is-invalid' : '') ?>" id="tgl_pelaksanaan">
                        <?= form_error('tgl_pelaksanaan', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group" id="PenerimaSurat">
                        <label for="penerima_surat"><span style="color: red;">* </span>Penerima Surat <small>(Wajib diisi)</small></label>
                        <input type="text" name="penerima_surat" class="form-control <?= (form_error('penerima_surat') ? 'is-invalid' : '') ?>" id="penerima_surat" value="<?= set_value('penerima_surat'); ?>" placeholder="Penerima surat...">
                        <?= form_error('penerima_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group" id="AlamatTujuan">
                        <label for="alamat_tujuan"><span style="color: red;">* </span>Alamat Tujuan <small>(Wajib diisi)</small></label>
                        <input type="text" name="alamat_tujuan" class="form-control <?= (form_error('alamat_tujuan') ? 'is-invalid' : '') ?>" id="alamat_tujuan" value="<?= set_value('alamat_tujuan'); ?>" placeholder="Kabupaten, Provinsi (Cnth : Kotabumi, Lampung Utara)">
                        <?= form_error('alamat_tujuan', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group" id="PerihalSurat">
                        <label for="perihal"><span style="color: red;">* </span>Perihal <small>(Wajib diisi)</small></label>
                        <input type="text" name="perihal" class="form-control <?= (form_error('perihal') ? 'is-invalid' : '') ?>" id="perihal" value="<?= set_value('perihal'); ?>" placeholder="Perihal surat...">
                        <?= form_error('perihal', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group" id="LampiranSurat">
                        <label for="lampiran"><span style="color: red;">* </span>Lampiran <small>(Wajib diisi)</small></label>
                        <input type="text" name="lampiran" class="form-control <?= (form_error('lampiran') ? 'is-invalid' : '') ?>" id="lampiran" value="<?= set_value('lampiran'); ?>" placeholder="Lampiran surat...">
                        <?= form_error('lampiran', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>


                    <div class="form-group" id="TentangSurat">
                        <label for="tentang_surat"><span style="color: red;">* </span>Tentang Surat <small>(Wajib diisi)</small></label>
                        <input type="text" name="tentang_surat" class="form-control <?= (form_error('tentang_surat') ? 'is-invalid' : '') ?>" id="tentang_surat" value="<?= set_value('tentang_surat'); ?>" placeholder="Tentang surat...">
                        <?= form_error('tentang_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>


                    <!-- Isi Tentang Otomatis berdasarkan jenis surat yang dipilih -->
                    <script>
                        function updateTentang() {
                            let jenisSurat = document.getElementById("jenis_surat");
                            let tentangSuratInput = document.getElementById("tentang_surat");
                            let perihalSuratInput = document.getElementById("perihal");

                            // Mendapatkan ID dari jenis surat yang dipilih
                            let selectedId = jenisSurat.value;

                            // Mengatur nilai berdasarkan ID
                            switch (selectedId) {
                                case "1":
                                    tentangSuratInput.value = "Surat Keterangan";
                                    break;
                                case "2":
                                    tentangSuratInput.value = "Penunjuk Sebagai Pembimbing Skripsi";
                                    break;
                                case "3":
                                    tentangSuratInput.value = "Izin Pra-Penelitian";
                                    perihalSuratInput.value = "Izin Pra-Penelitian";
                                    break;
                                case "4":
                                    tentangSuratInput.value = "Izin Penelitian";
                                    perihalSuratInput.value = "Izin Penelitian";
                                    break;
                                case "5":
                                    tentangSuratInput.value = "Penunjukan Sebagai Pembimbing Skripsi";
                                    break;
                                case "6":
                                    tentangSuratInput.value = "Penunjukan Sebagai Pembahas SEMHAS";
                                    break;
                                case "7":
                                    tentangSuratInput.value = "Dosen Penanggung Jawab dan Pengampu Mata Kuliah";
                                    break;
                                case "8":
                                    tentangSuratInput.value = "Panitia dan Pengawas Ujian Akhir";
                                    break;
                                case "9":
                                    tentangSuratInput.value = "Undangan Rapat Dosen";
                                    perihalSuratInput.value = "Undangan Rapat Dosen";
                                    break;
                                case "10":
                                    tentangSuratInput.value = "Permohonan Peminjaman Gedung";
                                    perihalSuratInput.value = "Permohonan Peminjaman Gedung";
                                    break;
                                default:
                                    tentangSuratInput.value = ""; // Kosongkan jika tidak ada ID yang cocok
                                    break;
                            }
                        }
                    </script>


                    <div class="form-group" id="idToDosen">
                        <label for="to_dosen"><span style="color: red;">* </span>Tujuan ke Dosen <small>(Wajib diisi)</small></label>
                        <select name="to_dosen" id="to_dosen" class="form-control select2 <?= (form_error('to_dosen') ? 'is-invalid' : '') ?>">
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($dosen as $dsn) : ?>
                                <option value="<?= $dsn['id']; ?>"><?= $dsn['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('to_dosen', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>


                    <div class="form-group" id="IdMahasiswa">
                        <label for="id_mahasiswa"><span style="color: red;">* </span>Nama Mahasiswa <small>(Wajib diisi)</small></label>
                        <select name="id_mahasiswa" id="id_mahasiswa" class="form-control select2 <?= (form_error('id_mahasiswa') ? 'is-invalid' : '') ?>">
                            <option value="">-- Pilih Mahasiswa --</option>
                            <?php foreach ($mahasiswa as $mhs) : ?>
                                <option value="<?= $mhs['id']; ?>" 
                                        data-npm="<?= $mhs['npm_nbm']; ?>" 
                                        data-tgl-lahir="<?= $mhs['tgl_lahir']; ?>" 
                                        data-alamat="<?= $mhs['alamat']; ?>"
                                        data-judul="<?= $mhs['judul_mhs']; ?>" 
                                        <?= set_select('id_mahasiswa', $mhs['id']); ?>>
                                    <?= $mhs['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('id_mahasiswa', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group" id="NpmMahasiswa">
                        <label for="npm"><span style="color: red;">* </span>NPM Mahasiswa <small>(Wajib diisi)</small></label>
                        <input type="text" name="npm" class="form-control <?= (form_error('npm') ? 'is-invalid' : '') ?>" id="npm" value="<?= set_value('npm'); ?>" placeholder="NPM mahasiswa..." readonly>
                        <?= form_error('npm', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>

                    <!-- Isi NPM secara otomatis berdasarkan mahasiswa yg dipilih -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Inisialisasi Select2
                            $('#id_mahasiswa').select2();

                            // Event listener untuk Select2
                            $('#id_mahasiswa').on('select2:select', function(e) {
                                var selectedData = e.params.data;
                                var npmValue = selectedData.element.getAttribute('data-npm');
                                document.getElementById('npm').value = npmValue ? npmValue : '';
                            });
                        });
                    </script>

                    <div class="form-group" id="SemesterSurat">
                        <label for="semester"><span style="color: red;">* </span>Untuk Semester <small>(Wajib diisi)</small></label>
                        <select name="semester" id="semester" class="form-control select2 <?= (form_error('semester') ? 'is-invalid' : '') ?>">
                            <option value="">-- Pilih --</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                            <option value="Ganjil-Genap">Ganjil-Genap</option>
                        </select>
                        <?= form_error('semester', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group" id="TahunAkademik">
                        <label for="tahun_akademik"><span style="color: red;">* </span>Tahun Akademik <small>(Wajib diisi)</small></label>
                        <select name="tahun_akademik" id="tahun_akademik" class="form-control select2 <?= (form_error('tahun_akademik') ? 'is-invalid' : '') ?>">
                            <!-- Diisi auto oleh Script JS di footer -->
                        </select>
                        <?= form_error('tahun_akademik', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Isi Surat / Pesan -->
            <div class="row">
                <div class="col-lg">
                    <div class="form-group">
                        <label for="isi_surat_keluar">
                            <span style="color: red;">* </span>Isi Surat Keluar <small>(Wajib diisi)</small>
                            <?= form_error('isi_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                        </label>
                        
                        <!-- Accordion untuk informasi mahasiswa -->
                        <div class="accordion mb-2" id="accordionExample" style="display: none;">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="bi bi-info-square-fill"></i> Salin Informasi Mahasiswa <small class="text-muted">(Info)</small>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p id="idNamaMhs">Nama : <span class="copy-text" data-copy="#idNamaMhs"></span></p>
                                        <p id="idNpmMhs">NPM : <span class="copy-text" data-copy="#idNpmMhs"></span></p>
                                        <p id="idTglLahirMhs">Tanggal Lahir : <span class="copy-text" data-copy="#idTglLahirMhs"></span></p>
                                        <p id="idAlamatMhs">Alamat : <span class="copy-text" data-copy="#idAlamatMhs"></span></p>
                                        <p id="idJudulMhs">Judul TA : <span class="copy-text" data-copy="#idJudulMhs"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <textarea name="isi_surat" class="form-control ckeditor-custom <?= (form_error('isi_surat') ? 'is-invalid' : '') ?>" id="isi_surat_keluar" rows="8"></textarea>
                    </div>
                </div>
            </div>
            <!-- End Surat / Pesan -->


            <!-- Isi data otomatis, untuk data accordion informasi mahasiswa terkait -->
            <script>
                $(document).ready(function() {
                    // Inisialisasi Select2
                    $('#id_mahasiswa').select2();

                    // Event listener untuk Select2
                    $('#id_mahasiswa').on('select2:select', function(e) {
                        let selectedData = e.params.data;
                        let selectedOption = $(this).find('option[value="' + selectedData.id + '"]');

                        // Ambil data dari opsi yang dipilih
                        let npmValue = selectedOption.data('npm');
                        let tglLahir = selectedOption.data('tgl-lahir');
                        let alamat = selectedOption.data('alamat');
                        let judul = selectedOption.data('judul');

                        // Update informasi di accordion
                        $('#idNamaMhs').html('Nama : ' + selectedData.text);
                        $('#idNpmMhs').text('NPM : ' + npmValue);
                        $('#idTglLahirMhs').text('Tempat, Tanggal Lahir : ' + tglLahir);
                        $('#idAlamatMhs').text('Alamat : ' + alamat);
                        $('#idJudulMhs').text('Judul TA : ' + judul);

                        // Tampilkan accordion
                        $('#accordionExample').show();
                    });

                    // Event listener untuk menyembunyikan accordion jika tidak ada pilihan
                    $('#id_mahasiswa').on('select2:select select2:unselect', function(e) {
                        // Cek apakah masih ada pilihan yang terpilih
                        if ($(this).val().length === 0) {
                            $('#accordionExample').hide(); // Sembunyikan accordion
                        } else {
                            $('#accordionExample').show(); // Tampilkan accordion
                        }
                    });
                });
            </script>


            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Tambahkan Catatan Kaki? <small class="text-muted">(Optional)</small>
                        </button>
                    </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <!-- Catatan Kaki -->
                        <div class="row mt-3">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="isi_catatan_kaki">
                                        Isi Catatan Kaki <small>(Jika dibutuhkan)</small>
                                        <?= form_error('catatan_kaki', '<small class="text-danger pl-1">', '</small>'); ?>
                                    </label>
                                    <textarea name="catatan_kaki" class="form-control ckeditor-custom <?= (form_error('catatan_kaki') ? 'is-invalid' : '') ?>" id="isi_catatan_kaki" rows="8"><?= set_value('catatan_kaki'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- End Catatan Kaki -->
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Tambahkan Lampiran? <small class="text-muted">(Optional)</small>
                        </button>
                    </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <!-- Lampiran -->
                        <div class="row mt-3">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="isi_lampiran">
                                        Isi Lampiran <small>(Jika dibutuhkan)</small>
                                        <?= form_error('isi_lampiran', '<small class="text-danger pl-1">', '</small>'); ?>
                                    </label>
                                    <textarea name="isi_lampiran" class="form-control ckeditor-custom <?= (form_error('isi_lampiran') ? 'is-invalid' : '') ?>" id="isi_lampiran" rows="8"><?= set_value('isi_lampiran'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- End Lampiran -->
                    </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col text-right">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Simpan Data</button>
                </div>
            </div>

        </div>
    </form>

    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

    <script>
        // Inisiasi CKeditor
        CKEDITOR.replace('isi_surat_keluar', {
            removeButtons: 'Save,Form, Checkbox, Radio, TextField, Textarea, Select,NewPage,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,SImage,Source',
            filebrowserImageBrowseUrl: '<?= base_url('assets/vendor/ckeditor/kcfinder/browse.php'); ?>',
        });

        CKEDITOR.replace('isi_catatan_kaki', {
            removeButtons: 'Form, Checkbox, Radio, TextField, Textarea, Select,NewPage,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,SImage,Source,Sourcedialog,Save,ExportPdf,Preview,Print,Templates,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Anchor,toc,About,Language,CreateDiv,Image,CodeSnippet,Table,Iframe,Youtube,Styles,Smiley,Blockquote,ShowBlocks,Copy,Cut,Undo,Redo,Format,Maximize,Unlink,Link,Superscript,Subscript,RemoveFormat,CopyFormatting,TextColor,BGColor,BidiLtr,BidiRtl,SpecialChar,PageBreak,TransformTextToLowercase,TransformTextToUppercase,TransformTextCapitalize,pbckcode',
            height: 200
        });

        CKEDITOR.replace('isi_lampiran', {
            removeButtons: 'Save,Form, Checkbox, Radio, TextField, Textarea, Select,NewPage,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,SImage,Source',
            filebrowserImageBrowseUrl: '<?= base_url('assets/vendor/ckeditor/kcfinder/browse.php'); ?>',
        });
    </script>

    <script>
        $(document).ready(function() {
        $('#jenis_surat').change(function() {
            let jenisSuratId = $(this).val();
            // console.log("Jenis Surat ID:", jenisSuratId);

            if (jenisSuratId) {
                $.ajax({
                    url: '<?= base_url('staff/get_template_by_jenis_surat'); ?>',
                    type: 'POST',
                    data: { jenis_surat: jenisSuratId },
                    success: function(response) {
                        console.log("Server Response:", response);
                        let data = JSON.parse(response);

                        if (data.status === 'success') {
                            // Update hanya textarea yang relevan
                            if (typeof CKEDITOR !== 'undefined') {
                                if (CKEDITOR.instances['isi_surat_keluar']) {
                                    CKEDITOR.instances['isi_surat_keluar'].setData(data.template);
                                }
                            } else {
                                $('#isi_surat_keluar').val(data.template);
                            }
                        } else {
                            alert('Gagal mendapatkan template: ' + data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            } else {
                // Kosongkan textarea jika tidak ada jenis surat yang dipilih
                if (typeof CKEDITOR !== 'undefined') {
                    if (CKEDITOR.instances['isi_surat_keluar']) {
                        CKEDITOR.instances['isi_surat_keluar'].setData('');
                    }
                } else {
                    $('#isi_surat_keluar').val('');
                }
            }
        });
    });
    </script>

    <script>
        let namaPembuatSurat = document.getElementById('npm').value;
        console.log(namaPembuatSurat);
    </script>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->