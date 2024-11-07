<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>



    <form class="d-inline" method="post" action="<?= base_url('admin/settings') ?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="card p-3 pt-4">
                    <h5 class="mb-3"><strong>Pengaturan Umum Web :</strong></h5>
                    <hr class="mt-0">
                    <input type="hidden" name="id" value="<?= $setting['id']; ?>">
                    <div class="form-group">
                        <label for="web_title">Nama Website</label>
                        <input type="text" name="web_title" class="form-control <?= (form_error('web_title') ? 'is-invalid' : '') ?>" id="web_title" placeholder="Judul website..." value="<?= $setting['web_title']; ?>">
                        <?= form_error('web_title', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="tagline">Selogan Website</label>
                        <input type="text" name="tagline" class="form-control <?= (form_error('tagline') ? 'is-invalid' : '') ?>" id="tagline" placeholder="Tagline website..." value="<?= $setting['tagline']; ?>">
                        <?= form_error('tagline', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="caption">Keterangan Website</label>
                        <textarea class="form-control <?= (form_error('caption') ? 'is-invalid' : '') ?>" name="caption" id="caption" rows="2" placeholder="Info web paragraf 1"><?= $setting['caption']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="info_web_p1">Tentang Website <small>(Paragraf 1)</small></label>
                        <textarea class="form-control <?= (form_error('info_web_p1') ? 'is-invalid' : '') ?>" name="info_web_p1" id="info_web_p1" rows="5" placeholder="Info web paragraf 1"><?= $setting['info_web_p1']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="info_web_p2">Tentang Website <small>(Paragraf 2)</small></label>
                        <textarea class="form-control <?= (form_error('info_web_p2') ? 'is-invalid' : '') ?>" name="info_web_p2" id="info_web_p2" rows="5" placeholder="Info web paragraf 2"><?= $setting['info_web_p2']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="footer">Nama Footer Website</label>
                        <input type="text" name="footer" class="form-control <?= (form_error('footer') ? 'is-invalid' : '') ?>" id="footer" placeholder="Footer website..." value="<?= $setting['footer']; ?>">
                        <?= form_error('footer', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img src="<?= base_url('assets/img/setting/') . $setting['image_workflow']; ?>" class="img-thumbnail mb-2">
                                </div>
                                <div class="col-sm-7">
                                    <div class="custom-file">
                                        <input type="file" name="image_workflow" class="custom-file-input" id="image_workflow">
                                        <label class="custom-file-label" for="image_workflow">Gambar alur kerja...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-3">
                <div class="card p-3 pt-4">
                    <h5 class="mb-3"><strong>Pengaturan Instansi :</strong></h5>
                    <hr class="mt-0">
                    <div class="form-group">
                        <label for="institution_name">Nama Instansi</label>
                        <input type="text" name="institution_name" class="form-control <?= (form_error('institution_name') ? 'is-invalid' : '') ?>" id="institution_name" placeholder="Nama instansi..." value="<?= $setting['institution_name']; ?>">
                        <?= form_error('institution_name', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="lead_name">Nama Pimpinan</label>
                        <input type="text" name="lead_name" class="form-control <?= (form_error('lead_name') ? 'is-invalid' : '') ?>" id="lead_name" placeholder="Pimpinan..." value="<?= $setting['lead_name']; ?>">
                        <?= form_error('lead_name', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nktam">NBM Pimpinan</label>
                        <input type="number" name="nktam" class="form-control <?= (form_error('nktam') ? 'is-invalid' : '') ?>" id="nktam" placeholder="NBM pimpinan..." value="<?= $setting['nktam']; ?>">
                        <?= form_error('nktam', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="faculty_name">Nama Fakultas</label>
                        <input type="text" name="faculty_name" class="form-control <?= (form_error('faculty_name') ? 'is-invalid' : '') ?>" id="faculty_name" placeholder="Nama fakutlas..." value="<?= $setting['faculty_name']; ?>">
                        <?= form_error('faculty_name', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="prodi_name">Nama Prodi</label>
                        <input type="text" name="prodi_name" class="form-control <?= (form_error('prodi_name') ? 'is-invalid' : '') ?>" id="prodi_name" placeholder="Nama prodi..." value="<?= $setting['prodi_name']; ?>">
                        <?= form_error('prodi_name', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat Instansi</label>
                        <textarea class="form-control <?= (form_error('address') ? 'is-invalid' : '') ?>" name="address" id="address" rows="4" placeholder="Alamat lengkap instansi..."><?= $setting['address']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="url_maps">Alamat URL Google Maps</label>
                        <textarea class="form-control <?= (form_error('url_maps') ? 'is-invalid' : '') ?>" name="url_maps" id="url_maps" rows="4" placeholder="Alamat URL Google Maps..."><?= $setting['url_maps']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="web">Web Official</label>
                        <input type="text" name="web" class="form-control <?= (form_error('web') ? 'is-invalid' : '') ?>" id="web" placeholder="URL web official..." value="<?= $setting['web']; ?>">
                        <?= form_error('web', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Instansi</label>
                        <input type="text" name="email" class="form-control <?= (form_error('email') ? 'is-invalid' : '') ?>" id="email" placeholder="Email instansi..." value="<?= $setting['email']; ?>">
                        <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="telp_or_fax">Telp/Fax</label>
                        <input type="text" name="telp_or_fax" class="form-control <?= (form_error('telp_or_fax') ? 'is-invalid' : '') ?>" id="telp_or_fax" placeholder="Isi Telp/Fax" value="<?= $setting['telp_or_fax']; ?>">
                        <?= form_error('telp_or_fax', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="whatsapp">WhatsApp Instansi</label>
                        <input type="number" name="whatsapp" class="form-control <?= (form_error('whatsapp') ? 'is-invalid' : '') ?>" id="whatsapp" placeholder="WhatsApp, gunakan format (628xxxxxxxxxx)" value="<?= $setting['whatsapp']; ?>">
                        <?= form_error('whatsapp', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="<?= base_url('assets/img/setting/') . $setting['logo']; ?>" class="img-thumbnail mb-2">
                                </div>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" accept=".png" name="logo" class="custom-file-input" id="logo">
                                        <label class="custom-file-label" for="logo">Logo instansi...</label>
                                        <small class="float-right mt-1"><i class="bi bi-info-circle"></i> Format gambar harus PNG.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat_ttd">Alamat Tanda Tangan</label>
                        <input type="text" name="alamat_ttd" class="form-control <?= (form_error('alamat_ttd') ? 'is-invalid' : '') ?>" id="alamat_ttd" placeholder="Alamat di TTD" value="<?= $setting['alamat_ttd']; ?>">
                        <?= form_error('alamat_ttd', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="<?= base_url('assets/img/setting/') . $setting['ttd_image']; ?>" class="img-thumbnail mb-2">
                                </div>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" accept=".png" name="ttd_image" class="custom-file-input" id="ttd_image">
                                        <label class="custom-file-label" for="ttd_image">Gambar TTD Pimpinan...</label>
                                        <small class="float-right mt-1"><i class="bi bi-info-circle"></i> Format gambar harus PNG.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3 mb-5 ml-3"><i class="bi bi-send"></i> Simpan Pengaturan</button>
        </div>
    </form>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->