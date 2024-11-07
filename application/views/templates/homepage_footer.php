<!-- MODAL -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Yakin Akan Keluar ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Dengan klik tombol <strong>Keluar</strong> anda akan mengakhiri sesi Login saat ini!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>"><i class="bi bi-box-arrow-left"></i> Keluar</a>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div id="iconToTop" class="icon-to-top">
    <a href="#toTop"><i class="bi bi-arrow-up-circle-fill"></i></a>
</div>

<!-- <svg class="wave-footer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#0099ff" fill-opacity="1" d="M0,128L48,154.7C96,181,192,235,288,256C384,277,480,267,576,240C672,213,768,171,864,176C960,181,1056,235,1152,240C1248,245,1344,203,1392,181.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
</svg> -->

<div id="footer">
    <div class="container">
        <div class="row footer">
            <div class="col">
                <p class="text-center">Copyright &copy; <?= date('Y'); ?> - <?= $setting['footer']; ?> | All Rights Reserved.</p>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<!-- Scroll to Top -->
<script>
    window.addEventListener('scroll', function() {
        var iconToTop = document.getElementById('iconToTop');
        if (window.scrollY > window.innerHeight / 1) {
            // Jika pengguna telah melakukan scroll ke bawah setidaknya setengah tinggi jendela
            iconToTop.style.display = 'block';
        } else {
            // Jika belum, sembunyikan ikon
            iconToTop.style.display = 'none';
        }
    });
</script>

<!-- File Upload General -->
<script>
    // Preview gambar dan nama file saat browse
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);

        // Menampilkan pratinjau gambar
        if (this.files && this.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
</script>

</body>

</html>