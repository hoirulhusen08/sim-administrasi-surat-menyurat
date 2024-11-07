<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?= date('Y'); ?> - <?= $setting['footer']; ?> | All Right Reserved</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin akan keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Keluar" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Keluar</a>
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

<!-- LightBox -->
<script src="<?= base_url('assets/'); ?>js/lightbox.min.js"></script>

<!-- Select2 -->
<script src="<?= base_url('assets/'); ?>js/select2.min.js"></script>

<script>
    // Tooltip Bootstrap
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    // Accordion Collapse
    $('.collapse').collapse()

    // Select2 or Input Select with Search (Tanpa Modal)
    $(document).ready(function() {
        $('.select2').select2({
            // placeholder: '-- Pilih --',
            theme: 'bootstrap4',
        });
    });

    // Get Notif pengajuan surat
    $(document).ready(function() {
        function updateNotification() {
            $.ajax({
                url: '<?= base_url('submission/get_notifications'); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response); // Debugging line
                    if (response && typeof response.count === 'number') {
                        var count = response.count;
                        var notifications = response.notifications;

                        // Update badge dengan jumlah notifikasi
                        if (count > 0) {
                            $('.badge-counter').text(count).show();
                        } else {
                            $('.badge-counter').hide();
                        }

                        // Clear previous notifications
                        $('.dropdown-list').find('.dropdown-item:not(:last-child)').remove();

                        // Append new notifications
                        if (notifications.length > 0) {
                            notifications.forEach(function(notification) {
                                // Convert Unix timestamp to Date object
                                var date = new Date(notification.date_created * 1000);

                                // Format date
                                var options = { day: '2-digit', month: 'long', year: 'numeric' };
                                var formattedDate = new Intl.DateTimeFormat('id-ID', options).format(date);

                                // URL base
                                var baseUrl = '<?= base_url('submission/viewSubmissionLetter?id=') ?>';

                                // Create notification item
                                var notificationItem = `
                                    <a class="dropdown-item d-flex align-items-center" href="${baseUrl}${notification.id}">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="<?= base_url('assets/img/profile/') ?>${notification.image}" alt="Image">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">${notification.nama_pengaju}, mengajukan permohonan surat.</div>
                                            <div class="small text-gray-500">${formattedDate}</div>
                                        </div>
                                    </a>
                                `;
                                $('.dropdown-list').append(notificationItem);
                            });
                        } else {
                            $('.dropdown-list').append('<a class="dropdown-item text-center small text-gray-500" href="#">Tidak ada notifikasi baru</a>');
                        }

                        // Append "Lihat detail..." link at the end
                        $('.dropdown-list').append('<a class="dropdown-item text-center small text-gray-500" href="<?= base_url('submission/listLetter'); ?>">Lihat semua data...</a>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        // Load notification data on page load
        updateNotification();
    });

    // Disable form select jenis surat pada edit surat keluar / lalu enable saat form disubmit
    $(document).ready(function() {
        $('#jenis_surat_edit').prop('disabled', true); // Menonaktifkan interaksi pengguna

        // Menambahkan event listener untuk submit form
        $('form').submit(function() {
            // Mengaktifkan select secara temporer
            $('#jenis_surat_edit').prop('disabled', false);
        });
    });

    // Isi auto tahun akademik
    $(document).ready(function() {
        // Mendapatkan tahun saat ini
        let tahunSaatIni = new Date().getFullYear();

        // Membangun opsi select dengan rentang 8 tahun dan opsi "-- Pilih --"
        let opsiTahun = '<option value="">-- Pilih --</option>';
        for (let i = tahunSaatIni - 4; i <= tahunSaatIni + 2; i++) {
            let tahunBerikut = i + 1;
            opsiTahun += '<option value="' + i + '/' + tahunBerikut + '">' + i + '/' + tahunBerikut + '</option>';
        }

        // Mengisi select dengan opsi yang dibangun
        $('#tahun_akademik').html(opsiTahun);
    });

    // Hide and Show field berdasarkan jenis surat
    function resetInputForm() {
        // Sembunyikan semua input
        $('#NomorSurat').hide();
        $('#TanggalPelaksanaan').hide();
        $('#PenerimaSurat').hide();
        $('#AlamatTujuan').hide();
        $('#PerihalSurat').hide();
        $('#LampiranSurat').hide();
        $('#TentangSurat').hide();
        $('#idToDosen').hide();
        $('#IdMahasiswa').hide();
        $('#NpmMahasiswa').hide();
        $('#SemesterSurat').hide();
        $('#TahunAkademik').hide();
    }
    $(document).ready(function() {
        // Awal hilangkan inputan
        resetInputForm();

        $('#jenis_surat').change(function() {
            let jenisSurat = $(this).val();

            // ==== Ubah nomor surat sesuai jenis surat yang dipilih | 3/INI_YG_DIUBAH/II.3.AU/FTIK/F/2024 ====
            const jenisSuratText = document.getElementById('jenis_surat').options[document.getElementById('jenis_surat').selectedIndex].text;
            const firstThreeChars = jenisSuratText.match(/^.{3}/)[0];
            // Dapatkan nilai input nomor surat saat ini
            let currentNomorSurat = $('#nomor_surat').val();
            // Pisahkan skema nomor surat menjadi bagian-bagian
            let skemaParts = currentNomorSurat.split('/');
            // Ubah bagian kedua skema nomor surat dengan 3 karakter awal
            skemaParts[1] = firstThreeChars;
            // Gabungkan kembali bagian-bagian skema nomor surat
            let updatedNomorSurat = skemaParts.join('/');
            // Tampilkan nomor surat yang diperbarui di input text
            $('#nomor_surat').val(updatedNomorSurat);

            // Tampilkan input berdasarkan jenis surat
            if (jenisSurat === '1') {
                $('#TentangSurat').show();
                $('#tentang_surat').attr('required', true);
                $('#NomorSurat').show();
                $('#nomor_surat').attr('required', true);
                $('#IdMahasiswa').show();
                $('#id_mahasiswa').attr('required', true);
                $('#NpmMahasiswa').show();
                $('#npm').attr('required', true);

                // Sembunyikan sisa input
                $('#TanggalPelaksanaan').hide();
                $('#tgl_pelaksanaan').removeAttr('required');
                $('#PenerimaSurat').hide();
                $('#penerima_surat').removeAttr('required');
                $('#AlamatTujuan').hide();
                $('#alamat_tujuan').removeAttr('required');
                $('#PerihalSurat').hide();
                $('#perihal').removeAttr('required');
                $('#LampiranSurat').hide();
                $('#lampiran').removeAttr('required');
                $('#SemesterSurat').hide();
                $('#semester').removeAttr('required');
                $('#TahunAkademik').hide();
                $('#tahun_akademin').removeAttr('required');
                $('#idToDosen').hide();
                $('#to_dosen').removeAttr('required');
            } else if (jenisSurat === '2') {
                $('#TentangSurat').show();
                $('#tentang_surat').attr('required', true);
                $('#NomorSurat').show();
                $('#nomor_surat').attr('required', true);
                $('#SemesterSurat').show();
                $('#semester').attr('required', true);
                $('#TahunAkademik').show();
                $('#tahun_akademik').attr('required', true);
                $('#IdMahasiswa').show();
                $('#id_mahasiswa').attr('required');
                $('#NpmMahasiswa').show();
                $('#npm').attr('required');
                $('#idToDosen').show();
                $('#to_dosen').attr('required', true);

                // Sembunyikan sisa input
                $('#TanggalPelaksanaan').hide();
                $('#tgl_pelaksanaan').removeAttr('required');
                $('#PenerimaSurat').hide();
                $('#penerima_surat').removeAttr('required');
                $('#AlamatTujuan').hide();
                $('#alamat_tujuan').removeAttr('required');
                $('#PerihalSurat').hide();
                $('#perihal').removeAttr('required');
                $('#LampiranSurat').hide();
                $('#lampiran').removeAttr('required');
                // $('#IdMahasiswa').hide();
                // $('#id_mahasiswa').removeAttr('required');
                // $('#NpmMahasiswa').hide();
                // $('#npm').removeAttr('required');
            } else if (jenisSurat === '3') {
                $('#NomorSurat').show();
                $('#nomor_surat').attr('required', true);
                $('#LampiranSurat').show();
                $('#lampiran').attr('required', true);
                $('#PerihalSurat').show();
                $('#perihal').attr('required', true);
                $('#PenerimaSurat').show();
                $('#penerima_surat').attr('required', true);
                $('#AlamatTujuan').show();
                $('#alamat_surat').attr('required', true);
                $('#IdMahasiswa').show();
                $('#id_mahasiswa').attr('required', true);
                $('#NpmMahasiswa').show();
                $('#npm').attr('required', true);

                // Sembunyikan sisa input
                $('#TanggalPelaksanaan').hide();
                $('#tgl_pelaksanaan').removeAttr('required');
                $('#TentangSurat').hide();
                $('#tentang_surat').removeAttr('required');
                $('#SemesterSurat').hide();
                $('#semester').removeAttr('required');
                $('#TahunAkademik').hide();
                $('#tahun_akademik').removeAttr('required');
                $('#idToDosen').hide();
                $('#to_dosen').removeAttr('required');
            } else if (jenisSurat === '4') {
                $('#NomorSurat').show();
                $('#nomor_surat').attr('required', true);
                $('#LampiranSurat').show();
                $('#lampiran').attr('required', true);
                $('#PerihalSurat').show();
                $('#perihal').attr('required', true);
                $('#PenerimaSurat').show();
                $('#penerima_surat').attr('required', true);
                $('#AlamatTujuan').show();
                $('#alamat_tujuan').attr('required', true);
                $('#IdMahasiswa').show();
                $('#id_mahasiswa').attr('required', true);
                $('#NpmMahasiswa').show();
                $('#npm').attr('required', true);

                // Sembunyikan sisa input
                $('#TanggalPelaksanaan').hide();
                $('#tgl_pelaksanaan').removeAttr('required');
                // $('#PenerimaSurat').hide();
                $('#penerima_surat').removeAttr('required');
                $('#TentangSurat').hide();
                $('#tentang_surat').removeAttr('required');
                $('#SemesterSurat').hide();
                $('#semester').removeAttr('required');
                $('#TahunAkademik').hide();
                $('#tahun_akademik').removeAttr('required');
                $('#idToDosen').hide();
                $('#to_dosen').removeAttr('required');
            } else if (jenisSurat === '5') {
                $('#NomorSurat').show();
                $('#nomor_surat').attr('required', true);
                $('#TentangSurat').show();
                $('#tentang_surat').attr('required', true);

                // Sembunyikan sisa input
                $('#TanggalPelaksanaan').hide();
                $('#tgl_pelaksanaan').removeAttr('required');
                $('#PenerimaSurat').hide();
                $('#penerima_surat').removeAttr('required');
                $('#AlamatTujuan').hide();
                $('#alamat_tujuan').removeAttr('required');
                $('#PerihalSurat').hide();
                $('#perihal').removeAttr('required');
                $('#LampiranSurat').hide();
                $('#lampiran').removeAttr('required');
                $('#IdMahasiswa').hide();
                $('#id_mahasiswa').removeAttr('required');
                $('#NpmMahasiswa').hide();
                $('#npm').removeAttr('required');
                $('#SemesterSurat').hide();
                $('#semester').removeAttr('required');
                $('#TahunAkademik').hide();
                $('#tahun_akademik').removeAttr('required');
                $('#idToDosen').hide();
                $('#to_dosen').removeAttr('required');
            } else if (jenisSurat === '6') {
                $('#NomorSurat').show();
                $('#nomor_surat').attr('required', true);
                $('#LampiranSurat').show();
                $('#lampiran_surat').attr('required', true);
                $('#PerihalSurat').show();
                $('#perihal').attr('required', true);
                $('#PenerimaSurat').show();
                $('#penerima_surat').attr('required', true);
                $('#AlamatTujuan').show();
                $('#alamat_tujuan').attr('required', true);
                $('#TanggalPelaksanaan').show();
                $('#tgl_pelaksanaan').attr('required', true);

                // Sembunyikan sisa input
                $('#TentangSurat').hide();
                $('#tentang_surat').removeAttr('required');
                $('#IdMahasiswa').hide();
                $('#id_mahasiswa').removeAttr('required');
                $('#NpmMahasiswa').hide();
                $('#npm').removeAttr('required');
                $('#SemesterSurat').hide();
                $('#semester').removeAttr('required');
                $('#TahunAkademik').hide();
                $('#tahun_akademik').removeAttr('required');
                $('#idToDosen').hide();
                $('#to_dosen').removeAttr('required');
            } else if (jenisSurat === '7') {
                $('#NomorSurat').show();
                $('#nomor_surat').attr('required', true);
                $('#TentangSurat').show();
                $('#tentang_surat').attr('required', true);
                $('#SemesterSurat').show();
                $('#semester').attr('required', true);
                $('#TahunAkademik').show();
                $('#tahun_akademik').attr('required', true);
                $('#idToDosen').show();
                $('#to_dosen').attr('required', true);

                // Sembunyikan sisa input
                $('#TanggalPelaksanaan').hide();
                $('#tgl_pelaksanaan').removeAttr('required');
                $('#PenerimaSurat').hide();
                $('#penerima_surat').removeAttr('required');
                $('#AlamatTujuan').hide();
                $('#alamat_tujuan').removeAttr('required');
                $('#PerihalSurat').hide();
                $('#perihal').removeAttr('required');
                $('#LampiranSurat').hide();
                $('#lampiran').removeAttr('required');
                $('#IdMahasiswa').hide();
                $('#id_mahasiswa').removeAttr('required');
                $('#NpmMahasiswa').hide();
                $('#npm').removeAttr('required');
            } else if (jenisSurat === '8') {
                $('#NomorSurat').show();
                $('#nomor_surat').attr('required', true);
                $('#TentangSurat').show();
                $('#tentang_surat').attr('required', true);
                $('#SemesterSurat').show();
                $('#semester').attr('required', true);
                $('#TahunAkademik').show();
                $('#tahun_akademik').attr('required', true);
                $('#idToDosen').show();
                $('#to_dosen').attr('required', true);

                // Sembunyikan sisa input
                $('#TanggalPelaksanaan').hide();
                $('#tgl_pelaksanaan').removeAttr('required');
                $('#PenerimaSurat').hide();
                $('#penerima_surat').removeAttr('required');
                $('#AlamatTujuan').hide();
                $('#alamat_tujuan').removeAttr('required');
                $('#PerihalSurat').hide();
                $('#perihal').removeAttr('required');
                $('#LampiranSurat').hide();
                $('#lampiran').removeAttr('required');
                $('#IdMahasiswa').hide();
                $('#id_mahasiswa').removeAttr('required');
                $('#NpmMahasiswa').hide();
                $('#npm').removeAttr('required');
            } else if (jenisSurat === '9') {
                $('#NomorSurat').show();
                $('#nomor_surat').attr('required', true);
                $('#LampiranSurat').show();
                $('#lampiran').attr('required', true);
                $('#PerihalSurat').show();
                $('#perihal').attr('required', true);
                $('#PenerimaSurat').show();
                $('#penerima_surat').attr('required', true);
                $('#AlamatTujuan').show();
                $('#alamat_tujuan').attr('required', true);
                $('#TanggalPelaksanaan').show();
                $('#tgl_pelaksanaan').attr('required', true);

                // Sembunyikan sisa input
                $('#TentangSurat').hide();
                $('#tentang_surat').removeAttr('required');
                $('#IdMahasiswa').hide();
                $('#id_mahasiswa').removeAttr('required');
                $('#NpmMahasiswa').hide();
                $('#npm').removeAttr('required');
                $('#SemesterSurat').hide();
                $('#semester').removeAttr('required');
                $('#TahunAkademik').hide();
                $('#tahun_akademik').removeAttr('required');
            } else if (jenisSurat === '10') {
                $('#NomorSurat').show();
                $('#nomor_surat').attr('required', true);
                $('#LampiranSurat').show();
                $('#lampiran').attr('required', true);
                $('#PerihalSurat').show();
                $('#perihal').attr('required', true);
                $('#PenerimaSurat').show();
                $('#penerima_surat').attr('required', true);
                $('#AlamatTujuan').show();
                $('#alamat_tujuan').attr('required', true);
                $('#TanggalPelaksanaan').show();
                $('#tgl_pelaksanaan').attr('required', true);

                // Sembunyikan sisa input
                $('#TentangSurat').hide();
                $('#tentang_surat').removeAttr('required');
                $('#IdMahasiswa').hide();
                $('#id_mahasiswa').removeAttr('required');
                $('#NpmMahasiswa').hide();
                $('#npm').removeAttr('required');
                $('#SemesterSurat').hide();
                $('#semester').removeAttr('required');
                $('#TahunAkademik').hide();
                $('#tahun_akademik').removeAttr('required');
            } else {
                // Sembunyikan semua input
                resetInputForm();
            }
        });
    });
</script>

<!-- Generate Password Default -->
<script>
    // ============================== ADD USER ==============================
    // Add Password
    function generateDefaultPasswordAddUser() {
        // Select elements with unique id based on index
        let passwordInput = document.getElementById("generatePasswordDefaultAddUser");
        let password2Input = document.getElementById("generatePasswordDefaultAddUser2");

        // Set the default password value to "12345678"
        let defaultPassword = "<?= $_ENV['GENERATE_PASSWORD_DEFAULT']; ?>";
        passwordInput.value = defaultPassword;
        password2Input.value = defaultPassword;
    }

    // Reset Password
    function resetPasswordAddUser() {
        let passwordInput = document.getElementById("generatePasswordDefaultAddUser");
        let password2Input = document.getElementById("generatePasswordDefaultAddUser2");

        // Set the password value to empty string
        passwordInput.value = "";
        password2Input.value = "";
    }

    // ============================== EDIT USER ==============================
    // Add Password
    function generateDefaultPasswordEditUser(index) {
        // Select elements with unique id based on index
        let passwordInput = document.getElementById("generatePasswordDefaultUbahUser" + index);
        let password2Input = document.getElementById("generatePasswordDefaultUbahUser2" + index);

        // Set the default password value to "12345678"
        let defaultPassword = "<?= $_ENV['GENERATE_PASSWORD_DEFAULT']; ?>";
        passwordInput.value = defaultPassword;
        password2Input.value = defaultPassword;
    }

    // Reset Password
    function resetPasswordEditUser(index) {
        let passwordInput = document.getElementById("generatePasswordDefaultUbahUser" + index);
        let password2Input = document.getElementById("generatePasswordDefaultUbahUser2" + index);

        // Set the password value to empty string
        passwordInput.value = "";
        password2Input.value = "";
    }
</script>

<!-- Show the Password tobe text -->
<script>
    // ============================ SHOW PASSWORD IN ADD USER =================================
    function togglePasswordVisibility(checkboxId, inputId1, inputId2) {
        let checkbox = document.getElementById(checkboxId);
        let passwordInput1 = document.getElementById(inputId1);
        let passwordInput2 = document.getElementById(inputId2);

        // Toggle password visibility based on checkbox state
        if (checkbox.checked) {
            passwordInput1.type = "text";
            passwordInput2.type = "text";
        } else {
            passwordInput1.type = "password";
            passwordInput2.type = "password";
        }
    }

    // ============================ SHOW PASSWORD IN EDIT USER =================================
    function togglePasswordVisibilityEditUser(checkboxId, inputId1, inputId2) {
        let checkbox = document.getElementById(checkboxId);
        let passwordInput1 = document.getElementById(inputId1);
        let passwordInput2 = document.getElementById(inputId2);

        // Toggle password visibility based on checkbox state
        if (checkbox.checked) {
            passwordInput1.type = "text";
            passwordInput2.type = "text";
        } else {
            passwordInput1.type = "password";
            passwordInput2.type = "password";
        }
    }

    // Function to reset password inputs to empty
    function resetPasswordEditUser(inputId1, inputId2) {
        let passwordInput1 = document.getElementById(inputId1);
        let passwordInput2 = document.getElementById(inputId2);

        // Reset password inputs to empty
        passwordInput1.value = "";
        passwordInput2.value = "";
    }
</script>

<!-- File Upload Drag & Drop -->
<script>
    const dropArea = document.getElementById('drop-area');
    const inputFile = document.getElementById('input-file');
    const imageView = document.getElementById('file-preview');
    // Tambahkan elemen untuk menampilkan nama file
    const fileNameView = document.getElementById('file-name');

    // Function untuk menampilkan nama file
    function displayFileName() {
        const file = inputFile.files[0];
        fileNameView.textContent = file.name;
    }

    // Function untuk menampilkan preview gambar
    function uploadImage(file) {
        const fileType = file.type;
        if (fileType.startsWith('image/')) {
            const imgLink = URL.createObjectURL(file);
            imageView.style.backgroundImage = `url(${imgLink})`;
        } else if (fileType === 'application/pdf') {
            // Tampilkan preview PDF menggunakan tag iframe
            const pdfLink = URL.createObjectURL(file);
            imageView.innerHTML = `<iframe src="${pdfLink}" width="100%" height="100%"></iframe>`;
        }
    }

    // Function untuk mereset area drop setelah file diunggah
    function resetDropArea() {
        dropArea.classList.remove('dragover');
    }

    // Event listener untuk change event pada input file
    inputFile.addEventListener("change", function() {
        const file = inputFile.files[0];
        uploadImage(file);
        displayFileName(); // Panggil fungsi displayFileName saat file dipilih
        resetDropArea();
    });

    // Event listener untuk dragover event pada dropArea
    dropArea.addEventListener("dragover", function(e) {
        e.preventDefault();
        dropArea.classList.add('dragover');
    });

    // Event listener untuk dragleave event pada dropArea
    dropArea.addEventListener("dragleave", function(e) {
        e.preventDefault();
        dropArea.classList.remove('dragover');
    });

    // Event listener untuk drop event pada dropArea
    dropArea.addEventListener("drop", function(e) {
        e.preventDefault();
        dropArea.classList.remove('dragover');
        inputFile.files = e.dataTransfer.files;
        const file = inputFile.files[0];
        uploadImage(file);
        displayFileName(); // Panggil fungsi displayFileName saat file di-drop
        resetDropArea();
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

<!-- Change Access Role User with AJAX -->
<script>
    $('.form-check-role-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeAccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleAccess/'); ?>" + roleId;
            }
        });
    });
</script>

<script>
    // Disable Button Delete User
    // Menambahkan kode JavaScript untuk menonaktifkan tombol jika peran adalah Administrator
    document.addEventListener("DOMContentLoaded", function() {
        let notDeleteButtonAdmin = document.getElementById("notDeleteButtonAdmin");
        if (notDeleteButtonAdmin) {
            notDeleteButtonAdmin.addEventListener("click", function(event) {
                event.preventDefault();
                alert("Anda tidak bisa menghapus peran Administrator.");
            });
        }
    });

    // Disable Button Edit
    // Melarang edit surat masuk yang telah disetujui dan terdisposisi
    document.addEventListener("DOMContentLoaded", function() {
        let notUpdateMailApprove = document.getElementById("notUpdateMailApprove");
        if (notUpdateMailApprove) {
            notUpdateMailApprove.addEventListener("click", function(event) {
                event.preventDefault();
                alert("Anda tidak bisa mengubah surat yang telah Disetujui atau Terdisposisi.");
            });
        }
    });

    // Disable Button Delete Surat
    // Melarang hapus surat masuk yang telah disetujui dan terdisposisi
    document.addEventListener("DOMContentLoaded", function() {
        let notDeleteMailApprove = document.getElementById("notDeleteMailApprove");
        if (notDeleteMailApprove) {
            notDeleteMailApprove.addEventListener("click", function(event) {
                event.preventDefault();
                alert("Anda tidak bisa menghapus surat yang telah Disetujui atau Terdisposisi.");
            });
        }
    });

    // Disable Button Delete Surat
    // Melarang hapus surat keluar yang telah disetujui
    document.addEventListener("DOMContentLoaded", function() {
        let notDeletedOutgoingMailApproved = document.getElementById("notDeletedOutgoingMailApproved");
        if (notDeletedOutgoingMailApproved) {
            notDeletedOutgoingMailApproved.addEventListener("click", function(event) {
                event.preventDefault();
                alert("Anda tidak bisa menghapus surat yang telah Disetujui.");
            });
        }
    });
</script>

</body>

</html>