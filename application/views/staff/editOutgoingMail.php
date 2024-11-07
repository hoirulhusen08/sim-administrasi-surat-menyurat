<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <h5 class="mt-4"><a style="text-decoration: none;" href="<?= base_url('staff/outgoingMail'); ?>"><i class="bi bi-arrow-left-circle-fill"></i> <small>Kembali</small></a></h5>

    <form method="post" action="<?= base_url('staff/editOutgoingMail?id=') . $this->input->get('id'); ?>" enctype="multipart/form-data">
        <div class="card shadow p-5 mb-5">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Jenis dan Klasifikasi Surat -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="jenis_surat_edit"><span style="color: red;">* </span>Jenis Surat <small>(Wajib diisi)</small></label>
                                <select name="jenis_surat" id="jenis_surat_edit" class="form-control select2 <?= (form_error('jenis_surat') ? 'is-invalid' : '') ?>">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($jenis_surat as $row) : ?>
                                        <option value="<?= $row['id'] ?>" <?= set_select('jenis_surat', $row['id'], $lihat_surat_keluar['id_jenis'] == $row['id']); ?>>
                                            <?= $row['jenis'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('jenis_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="id_klasifikasi_edit"><span style="color: red;">* </span>Klasifikasi Surat <small>(Wajib diisi)</small></label>
                                <select name="id_klasifikasi" id="id_klasifikasi_edit" class="form-control select2 <?= (form_error('id_klasifikasi') ? 'is-invalid' : '') ?>">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($klasifikasi_surat as $ks) : ?>
                                        <option value="<?= $ks['id']; ?>" <?= set_select('id_klasifikasi', $ks['id'], $lihat_surat_keluar['id_klasifikasi'] == $ks['id']); ?>>
                                            <?= $ks['nama']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_klasifikasi', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Jenis dan Klasifikasi Surat -->
                    <div class="form-group">
                        <label for="nomor_surat_edit"><span style="color: red;">* </span>Nomor Surat <small>(Wajib diisi)</small></label>
                        <input type="text" name="nomor_surat" class="form-control <?= (form_error('nomor_surat') ? 'is-invalid' : '') ?>" id="nomor_surat_edit" value="<?= $lihat_surat_keluar['nomor_surat']; ?>" placeholder="Nomor surat..." readonly>
                        <?= form_error('nomor_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <?php if ($lihat_surat_keluar['tgl_pelaksanaan'] != '0000-00-00') : ?>
                        <div class="form-group">
                            <label for="tgl_pelaksanaan_edit"><span style="color: red;">* </span>Tanggal Pelaksanaan <small>(Wajib diisi)</small></label>
                            <input type="date" name="tgl_pelaksanaan" value="<?= $lihat_surat_keluar['tgl_pelaksanaan']; ?>" class="form-control <?= (form_error('tgl_pelaksanaan') ? 'is-invalid' : '') ?>" id="tgl_pelaksanaan_edit">
                            <?= form_error('tgl_pelaksanaan', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($lihat_surat_keluar['penerima_surat'])) : ?>
                        <div class="form-group">
                            <label for="penerima_surat_edit"><span style="color: red;">* </span>Penerima Surat <small>(Wajib diisi)</small></label>
                            <input type="text" name="penerima_surat" class="form-control <?= (form_error('penerima_surat') ? 'is-invalid' : '') ?>" id="penerima_surat_edit" value="<?= $lihat_surat_keluar['penerima_surat']; ?>" placeholder="Penerima surat...">
                            <?= form_error('penerima_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($lihat_surat_keluar['alamat_tujuan'])) : ?>
                        <div class="form-group">
                            <label for="alamat_tujuan_edit"><span style="color: red;">* </span>Alamat Tujuan <small>(Wajib diisi)</small></label>
                            <input type="text" name="alamat_tujuan" class="form-control <?= (form_error('alamat_tujuan') ? 'is-invalid' : '') ?>" id="alamat_tujuan_edit" value="<?= $lihat_surat_keluar['alamat_tujuan']; ?>" placeholder="Kabupaten, Provinsi (Cnth : Kotabumi, Lampung Utara)">
                            <?= form_error('alamat_tujuan', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-6">
                    <?php if (!empty($lihat_surat_keluar['perihal'])) : ?>
                        <div class="form-group">
                            <label for="perihal_edit"><span style="color: red;">* </span>Perihal <small>(Wajib diisi)</small></label>
                            <input type="text" name="perihal" class="form-control <?= (form_error('perihal') ? 'is-invalid' : '') ?>" id="perihal_edit" value="<?= $lihat_surat_keluar['perihal']; ?>" placeholder="Perihal surat...">
                            <?= form_error('perihal', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($lihat_surat_keluar['lampiran'])) : ?>
                        <div class="form-group">
                            <label for="lampiran_edit"><span style="color: red;">* </span>Lampiran <small>(Wajib diisi)</small></label>
                            <input type="text" name="lampiran" class="form-control <?= (form_error('lampiran') ? 'is-invalid' : '') ?>" id="lampiran_edit" value="<?= $lihat_surat_keluar['lampiran']; ?>" placeholder="Lampiran surat...">
                            <?= form_error('lampiran', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($lihat_surat_keluar['tentang_surat'])) : ?>
                        <div class="form-group">
                            <label for="tentang_surat_edit"><span style="color: red;">* </span>Tentang Surat <small>(Wajib diisi)</small></label>
                            <input type="text" name="tentang_surat" class="form-control <?= (form_error('tentang_surat') ? 'is-invalid' : '') ?>" id="tentang_surat_edit" value="<?= $lihat_surat_keluar['tentang_surat']; ?>" placeholder="Tentang surat...">
                            <?= form_error('tentang_surat', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($lihat_surat_keluar['id_user'])) : ?>
                        <div class="form-group">
                            <label for="id_mahasiswa_edit"><span style="color: red;">* </span>Nama Mahasiswa <small>(Wajib diisi)</small></label>
                            <select name="id_mahasiswa" id="id_mahasiswa_edit" class="form-control select2 <?= (form_error('id_mahasiswa') ? 'is-invalid' : '') ?>">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($mahasiswa as $mhs) : ?>
                                    <option value="<?= $mhs['id']; ?>" <?= set_select('id_mahasiswa', $mhs['id'], $lihat_surat_keluar['id_user'] == $mhs['id']); ?>>
                                        <?= $mhs['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id_mahasiswa', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($lihat_surat_keluar['npm'])) : ?>
                        <div class="form-group">
                            <label for="npm_edit"><span style="color: red;">* </span>NPM Mahasiswa <small>(Wajib diisi)</small></label>
                            <input type="text" name="npm" class="form-control <?= (form_error('npm') ? 'is-invalid' : '') ?>" id="npm_edit" value="<?= $lihat_surat_keluar['npm']; ?>" placeholder="NPM mahasiswa...">
                            <?= form_error('npm', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($lihat_surat_keluar['semester'])) : ?>
                        <div class="form-group">
                            <label for="semester_edit"><span style="color: red;">* </span>Untuk Semester <small>(Wajib diisi)</small></label>
                            <select name="semester" id="semester_edit" class="form-control select2 <?= (form_error('semester') ? 'is-invalid' : '') ?>">
                                <option value="">-- Pilih --</option>
                                <option value="Ganjil" <?= set_select('semester', 'Ganjil', $lihat_surat_keluar['semester'] == 'Ganjil'); ?>>Ganjil</option>
                                <option value="Genap" <?= set_select('semester', 'Genap', $lihat_surat_keluar['semester'] == 'Genap'); ?>>Genap</option>
                                <option value="Ganjil-Genap" <?= set_select('semester', 'Ganjil-Genap', $lihat_surat_keluar['semester'] == 'Ganjil-Genap'); ?>>Ganjil-Genap</option>
                            </select>
                            <?= form_error('semester', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($lihat_surat_keluar['tahun_akademik'])) : ?>
                        <div class="form-group">
                            <?php
                            // Mendapatkan tahun saat ini
                            $tahunSaatIni = date('Y');

                            // Membangun opsi select dengan rentang 8 tahun dan opsi "-- Pilih --"
                            $opsiTahun = '<option value="">-- Pilih --</option>';
                            for ($i = $tahunSaatIni - 4; $i <= $tahunSaatIni + 2; $i++) {
                                $tahunBerikut = $i + 1;
                                $opsiTahun .= '<option value="' . $i . '/' . $tahunBerikut . '"' . set_select('tahun_akademik', $i . '/' . $tahunBerikut, $lihat_surat_keluar['tahun_akademik'] == $i . '/' . $tahunBerikut) . '>' . $i . '/' . $tahunBerikut . '</option>';
                            }
                            ?>
                            <label for="tahun_akademik_edit"><span style="color: red;">* </span>Tahun Akademik <small>(Wajib diisi)</small></label>
                            <select name="tahun_akademik" id="tahun_akademik_edit" class="form-control select2 <?= (form_error('tahun_akademik') ? 'is-invalid' : '') ?>">
                                <?= $opsiTahun ?>
                            </select>
                            <?= form_error('tahun_akademik', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    <?php endif; ?>
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
                        <textarea name="isi_surat" class="form-control ckeditor-custom <?= (form_error('isi_surat') ? 'is-invalid' : '') ?>" id="isi_surat_keluar" rows="8"><?= $lihat_surat_keluar['isi_surat']; ?></textarea>
                    </div>
                </div>
            </div>
            <!-- End Surat / Pesan -->

            <!-- Catatan Kaki -->
            <div class="row mt-3">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="isi_catatan_kaki">
                            Isi Catatan Kaki <small>(Jika dibutuhkan)</small>
                            <?= form_error('catatan_kaki', '<small class="text-danger pl-1">', '</small>'); ?>
                        </label>
                        <textarea name="catatan_kaki" class="form-control ckeditor-custom <?= (form_error('catatan_kaki') ? 'is-invalid' : '') ?>" id="isi_catatan_kaki" rows="8"><?= $lihat_surat_keluar['catatan_kaki']; ?></textarea>
                    </div>
                </div>
            </div>
            <!-- End Catatan Kaki -->

            <!-- Lampiran -->
            <div class="row mt-3">
                <div class="col-lg">
                    <div class="form-group">
                        <label for="isi_lampiran">
                            Isi Lampiran <small>(Jika dibutuhkan)</small>
                            <?= form_error('isi_lampiran', '<small class="text-danger pl-1">', '</small>'); ?>
                        </label>
                        <textarea name="isi_lampiran" class="form-control ckeditor-custom <?= (form_error('isi_lampiran') ? 'is-invalid' : '') ?>" id="isi_lampiran" rows="8"><?= $lihat_surat_keluar['isi_lampiran']; ?></textarea>
                    </div>
                </div>
            </div>
            <!-- End Lampiran -->

            <div class="row mt-4">
                <div class="col text-right">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Perbarui Data</button>
                </div>
            </div>

        </div>
    </form>

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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->