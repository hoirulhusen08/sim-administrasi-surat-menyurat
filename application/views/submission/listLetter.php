<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= form_error(
        'menu',
        '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>',
        '</div>'
    ); ?>

    <?= $this->session->flashdata('message'); ?>

    <!-- Datatables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Atas Nama</th>
                            <th>Jenis Surat</th>
                            <th>Sifat</th>
                            <th>Status</th>
                            <th>Diminta</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pengajuan_surat as $pengajuan) : ?>
                            <!-- Tambahkan class 'bg-light' jika dilihat = 0 -->
                            <tr class="<?= $pengajuan->dilihat == 0 ? 'bg-light' : ''; ?>">
                                <td><?= $i++ . "."; ?></td>
                                <td><?= $pengajuan->nama_user; ?></td>
                                <td><?= $pengajuan->jenis_surat; ?></td>
                                <td>
                                    <?php if ($pengajuan->sifat == "Penting") : ?>
                                        <small class="badge badge-primary"><?= $pengajuan->sifat ?></small>
                                    <?php elseif ($pengajuan->sifat == "Mendesak") : ?>
                                        <small class="badge badge-danger"><?= $pengajuan->sifat ?></small>
                                    <?php else : ?>
                                        <small class="badge badge-secondary"><?= $pengajuan->sifat ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($pengajuan->status == 0) : ?>
                                        <small class="badge badge-secondary">Belum Dibaca</small>
                                    <?php elseif ($pengajuan->status == 1 && $pengajuan->dilihat == 1) : ?>
                                        <small class="badge badge-info"><i class="bi bi-check-all"></i> Sudah Dibaca</small>
                                    <?php elseif ($pengajuan->status == 2) : ?>
                                        <small class="badge badge-primary"><i class="bi bi-hourglass-split"></i> Sedang Diproses...</small>
                                    <?php elseif ($pengajuan->status == 3) : ?>
                                        <small class="badge badge-success"><i class="bi bi-check-circle-fill"></i> Selesai</small>
                                    <?php else : ?>
                                        <small class="badge badge-danger">Pengajuan Ditolak!</small>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d F Y', $pengajuan->date_created); ?></td>
                                <td>
                                    <a href="<?= base_url('submission/viewSubmissionLetter?id=') . $pengajuan->id; ?>" class="btn btn-sm btn-info mb-1 lihat-submission" data-id="<?= $pengajuan->id; ?>"><i class="bi bi-eye-fill"></i> Lihat</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Datatables -->

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<!-- SCRIPT Untuk Update ketika Dilihat pertama kali -->
<script>
array.forEach(element => {
	$(document).ready(function() {
	    $('.lihat-submission').click(function(e) {
	        e.preventDefault(); // Mencegah aksi default dari link
	
	        let id_pengajuan = $(this).data('id');
	
	        // Kirim request ke controller
	        $.post('<?php echo site_url('submission/viewSubmissionLetter?id=') ?>' + id_pengajuan, function(response) {
	            alert(response); // Tampilkan pesan dari controller
	            // Tambahkan logika tambahan jika diperlukan
	        });
	    });
	});
});
</script>
