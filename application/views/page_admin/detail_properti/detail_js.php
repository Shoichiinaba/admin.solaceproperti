<!-- modal -->
<!-- code modal untuk input promo -->
<div class="modal fade" id="buat-promo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Tambah Promo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="id-properti" value="<?=$this->uri->segment(3);?>" class="form-control" />
                </div>
                <div class="row g-2">
                    <div class="col-12 mt-3">
                        <textarea id="summernote" name="promo_description"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-primary">
                    Simpan
                    <span id="loading-spinner" class="spinner-border spinner-border-sm ms-2" style="display: none;"
                        role="status" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Promo -->
<div class="modal fade" id="edit-promo-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Edit Promo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-id-promo">
                <input type="hidden" id="edit-id-properti">
                <div class="form-group">
                    <textarea id="edit-nama-promo" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save-edit-promo" class="btn btn-primary">
                    Ubah
                    <span id="loading-spinner-edit" class="spinner-border spinner-border-sm ms-2" style="display: none;"
                        role="status" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- modal untuk edit content properti -->
<div class="modal fade" id="ubah-properti" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Ubah Properti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <div class="container mt-0" id="form-container">
                    <div class="alert alert-success mt-1" role="alert">Judul Properti
                    </div>
                    <input type="hidden" name="nama_type" id="type-properti" class="form-control">
                    <form id="edit-properti-form" enctype="multipart/form-data">
                        <!-- Data Properti -->
                        <input type="hidden" name="id_type" id="id-type" class="form-control">
                        <div class="row ">
                            <div class="input-wrapper col-12 mb-3">
                                <input class="form-control" list="data-status" name="status_properti"
                                    id="status-properti" placeholder="Pilih Status..." />
                                <label for="status-properti" class="label-in">Status Properti</label>

                                <datalist id="data-status">
                                    <?php foreach ($status as $sts) : ?>
                                    <option data-id="<?php echo $sts->id_status; ?>"
                                        value="<?php echo $sts->status; ?>">
                                    </option>
                                    <?php endforeach; ?>
                                </datalist>
                                <input type="hidden" name="id_status" id="id-status" readonly>
                            </div>
                            <div class="input-wrapper col-6" id="penawaran">
                                <input class="form-control" list="data-penawaran" id="jenis-penawaran" name="penawaran"
                                    placeholder="Pilih jenis Penawaran..." />
                                <label for="penawaran" class="label-in">Pilih Penawaran</label>

                                <datalist id="data-penawaran">
                                    <option value="Dijual"></option>
                                    <option value="Disewa"></option>
                                </datalist>
                            </div>
                            <div class="input-wrapper col-6" id="kota-list">
                                <input class="form-control" list="datalistOptions" id="exampleDataList"
                                    placeholder="Ketik nama kota...">
                                <label for="exampleDataList" class="label-in">Pilih Kota</label>

                                <datalist id="datalistOptions">
                                    <?php foreach ($kota as $kotas) : ?>
                                    <option data-id="<?php echo $kotas->id_kota; ?>"
                                        data-provinsi="<?php echo $kotas->provinsi_id; ?>"
                                        value="<?php echo $kotas->nama_kota; ?>">
                                    </option>
                                    <?php endforeach; ?>
                                </datalist>

                                <input type="hidden" name="id_kota" id="id-kota">
                                <input type="hidden" name="id_provinsi" id="id-provinsi">
                            </div>
                        </div>
                        <input type="hidden" name="id_properti" id="ubah-id-properti" class="form-control" required>
                        <div class="input-wrapper mt-3">
                            <input type="text" name="judul_properti" id="judul" class="form-control" required>
                            <label for="judul_properti" class="label-in">Judul Properti</label>
                        </div>
                        <div class="row ">
                            <div class="input-wrapper mt-3 col-6">
                                <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                                <label for="alamat" class="label-in">Alamat</label>
                            </div>
                            <div class="col-6 mt-4">
                                <select id="choices-multiple-remove-button" class="form-control"
                                    placeholder="Pilih Area Terdekat" name="area_terdekat[]" multiple>
                                </select>
                            </div>
                        </div>
                        <div class="input-wrapper mt-3">
                            <textarea name="lokasi" id="lokasi" class="form-control" required></textarea>
                            <label for="lokasi" class="label-in">Lokasi "( isi dg embed maps )"</label>
                        </div>
                        <!-- Data Detail Properti -->
                        <div class="alert alert-primary mt-4" role="alert">Detail Properti
                        </div>
                        <div class="input-wrapper">
                            <input type="number" name="jml_kamar" id="kamar" class="form-control" required>
                            <label for="jml_kamar" class="label-in">Jumlah Kamar</label>
                        </div>
                        <div class="input-wrapper mt-3">
                            <input type="number" name="jml_kamar_mandi" id="kamar-mandi" class="form-control" required>
                            <label for="jml_kamar_mandi" class="label-in">Jumlah Kamar Mandi</label>
                        </div>
                        <div class="input-wrapper mt-3">
                            <input type="number" name="luas_bangunan" id="luas-bangunan" class="form-control" required>
                            <label for="luas_bangunan" class="label-in">Luas Bangunan (m²)</label>
                        </div>
                        <div class="input-wrapper mt-3">
                            <input type="number" name="luas_tanah" id="luas-tanah" class="form-control" required>
                            <label for="lusa_tanah" class="label-in">Luas Tanah (m²)</label>
                        </div>
                        <div class="input-wrapper mt-3">
                            <input type="number" name="daya_listrik" id="daya-listrik" class="form-control" required>
                            <label for="daya_listrik" class="label-in">Daya Listrik (Watt)</label>
                        </div>
                        <div class="input-wrapper mt-3">
                            <input type="number" name="carport" id="carport" class="form-control" required>
                            <label for="carport" class="label-in">Jumlah Carport</label>
                        </div>
                        <div class="input-wrapper mt-3">
                            <input type="number" name="ruang_tamu" id="ruang-tamu" class="form-control" required>
                            <label for="ruang_tamu" class="label-in">Ruang Tamu</label>
                        </div>
                        <div class="input-wrapper mt-3">
                            <input type=" number" name="taman" id="taman" class="form-control" required>
                            <label for="taman" class="label-in">Taman</label>
                        </div>
                        <div class="input-wrapper mt-3">
                            <input type=" number" name="ruang_makan" id="ruang-makan" class="form-control" required>
                            <label for=" ruang_makan" class="label-in">Ruang Makan</label>
                        </div>
                        <div class="input-wrapper mt-3">
                            <input type=" number" name="ruang_keluarga" id="ruang-keluarga" class="form-control"
                                required>
                            <label for=" ruang_keluarga" class="label-in">Ruang Keluarga</label>
                        </div>
                        <div class="row">
                            <div class="input-wrapper col-12 mt-3" id="level-wrapper">
                                <input type="number" id="level" name="level" class="form-control" required>
                                <label for="level" class="label-in">Jumlah Lantai</label>
                            </div>
                            <div class="input-wrapper mt-3 col-6" id="balkon-wrapper" style="display: none;">
                                <input type="number" id="balkon" name="balkon" class="form-control">
                                <label for="balkon" class="label-in">Balkon</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-wrapper mt-3 col-5">
                                <input type="number" name="harga" id="harga" class="form-control" required>
                                <label for="harga" class="label-in">Harga (IDR)</label>
                            </div>
                            <div class="input-wrapper mt-3 col-3">
                                <input type="text" name="satuan" id="satuan" class="form-control" required>
                                <label for="satuan" class="label-in">Satuan</label>
                            </div>
                            <div class="input-wrapper  mt-3 col-4">
                                <input class="form-control" list="option-agent" id="data-agent"
                                    placeholder="Ketik nama agent...">
                                <label for="data-agent" class="label-in">Pilih Agent</label>
                                <datalist id="option-agent">
                                    <?php foreach ($agent as $agn) : ?>
                                    <option data-id_agn="<?php echo $agn->id_agency; ?>"
                                        value="<?php echo $agn->nama_agent; ?>"></option>
                                    <?php endforeach; ?>
                                </datalist>
                                <input type="hidden" name="id_agency" id="id-agency">
                            </div>

                        </div>
                        <div class="input-wrapper mt-3">
                            <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                            <label for="deskripsi" class="label-in">Deskripsi</label>
                        </div>
                        <!-- Data Fasilitas Properti -->
                        <div id="fasilitas-section" style="display:none;">
                            <div class="alert alert-warning mt-4" role="alert">Fasilitas Properti</div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="input-wrapper">
                                        <input type="number" id="jalan" name="jalan"
                                            class="form-control form-control-sm" required>
                                        <label for="level" class="label-in">Jalan</label>
                                    </div>
                                </div>
                                <div class="col-md-3 p-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="taman_bermain"
                                            name="taman_bermain" value="1" />
                                        <label class="form-check-label" for="taman_bermain">Taman Bermain</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="area_ruko" name="area_ruko"
                                            value="1" />
                                        <label class="form-check-label" for="area_ruko">Area Ruko</label>
                                    </div>
                                </div>
                                <div class="col-md-3 p-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="kolam_renang"
                                            name="kolam_renang" value="1" />
                                        <label class="form-check-label" for="kolam_renang">Kolam Renang</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="onegate" name="one_gate"
                                            value="1" />
                                        <label class="form-check-label" for="one_gate">One Gate</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="security" name="security"
                                            value="1" />
                                        <label class="form-check-label" for="security">Security</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cctv" name="cctv"
                                            value="1" />
                                        <label class="form-check-label" for="cctv">CCTV</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="masjid" name="masjid"
                                            value="1" />
                                        <label class="form-check-label" for="masjid">Masjid</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Gambar Properti -->
                        <div class="alert alert-info mt-2" role="alert">
                            Upload Gambar Properti
                            <div class="row">
                                <div id="gambar-preview" class="d-flex gap-2 mt-1 mb-1 col-12" style="flex-wrap: wrap;">
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-success col-12 pb-4" role="alert"> Upload Meta Properti
                            <div id="meta-preview" class="position-relative">
                            </div>
                            <button type="button" id="change-foto" class="btn btn-sm btn-primary rounded-3">Ganti
                                Meta</button>
                            <input type="file" class="d-none" id="upload-meta" name="foto_meta">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submitEditProperti" class="btn btn-primary rounded-3">
                    <span id="loadingIcon" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                    <span id="loadingText" class="d-none">Loading...</span>
                    <span id="submitText"> Simpan</span>
                </button>
            </div>
        </div>
    </div>
    <!-- akhir modal -->


    <!-- Load Bootstrap CSS dan JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <!-- Load Summernote CSS dan JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>


    <script>
    $(document).ready(function() {
        var baseUrl = "<?php echo base_url(); ?>";

        function lazzy_loader() {
            var output = '';
            output += '<div class="post_data">';
            output += '<div class="image-placeholder content-placeholder">&nbsp;</div>';
            output += '<div class="details-placeholder">';
            output += '<div class="title-placeholder content-placeholder">&nbsp;</div>';
            output += '<div class="sub-title-placeholder content-placeholder">&nbsp;</div>';
            output += '<div class="price-placeholder content-placeholder">&nbsp;</div>';
            output +=
                '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
            output +=
                '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
            output += '<div class="sub-title-placeholder content-placeholder">&nbsp;</div>';
            output += '<div class="price-placeholder content-placeholder">&nbsp;</div>';
            output += '</div>';
            output += '</div>';
            $('#lazy-loader').html(output);
        }

        lazzy_loader();

        setTimeout(function() {
            $('#lazy-loader').hide();
            $('#carousel-content').show();
        }, 2000);

        // kode input promo
        $('#summernote').on('summernote.init', function() {
            // Disable tombol dropdown
            $('.note-btn.dropdown-toggle').prop('enable', true);
        });

        $('#summernote').summernote({
            height: 300,
            placeholder: 'Masukkan deskripsi promo...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear', 'fontname', 'fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help']],
                ['misc', ['undo', 'redo']]
            ],
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather'],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '28', '30',
                '36',
                '48', '64', '82', '150'
            ]
        });

        // Fungsi untuk menyimpan data promo
        $('#btn-save').on('click', function() {
            var id_properti = $('#id-properti').val();
            var nama_promo = $('#summernote').val();

            $('#loading-spinner').show();
            $('#btn-save').prop('disabled', true);

            $.ajax({
                url: baseUrl + "Properti/save_promo",
                method: "POST",
                data: {
                    id_properti: id_properti,
                    nama_promo: nama_promo
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Promo berhasil disimpan.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        $('#buat-promo').modal('hide');
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                },
                complete: function() {
                    $('#loading-spinner').hide();
                    $('#btn-save').prop('disabled', false);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#edit-nama-promo').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.btn-edit-promo').on('click', function() {
            var id_promo = $(this).data('id');

            $.ajax({
                url: '<?= base_url("Properti/get_promo_by_id"); ?>',
                type: 'POST',
                data: {
                    id_promo: id_promo
                },
                dataType: 'json',
                success: function(data) {
                    $('#edit-id-promo').val(data.id_promo);
                    $('#edit-id-properti').val(data.id_properti);
                    $('#edit-nama-promo').summernote('code', data.nama_promo);
                    $('#edit-promo-modal').modal('show');
                }
            });
        });

        $('#save-edit-promo').on('click', function() {
            var id_promo = $('#edit-id-promo').val();
            var id_properti = $('#edit-id-properti').val();
            var nama_promo = $('#edit-nama-promo').val();

            $('#loading-spinner-edit').show();
            $('#save-edit-promo').prop('disabled', true);

            $.ajax({
                url: '<?= base_url("Properti/update_promo"); ?>',
                type: 'POST',
                data: {
                    id_promo: id_promo,
                    id_properti: id_properti,
                    nama_promo: nama_promo
                },
                beforeSend: function() {
                    $('#loading-spinner-edit').show();
                    $('#save-edit-promo').prop('disabled', true);
                },
                success: function(response) {
                    $('#save-edit-promo').attr('disabled', false).text('Save');
                    $('#edit-promo-modal').modal('hide');
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Promo berhasil diupdate.',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    location.reload();
                }
            });
        });

        // kode reload gambar
        function loadGambar(idProperti) {
            $('#gambar-preview').empty();

            $.ajax({
                url: '<?= base_url("Properti/get_gambar") ?>',
                type: 'POST',
                data: {
                    id_properti: idProperti
                },
                dataType: 'json',
                success: function(response) {
                    // Mengakses gambar dari response
                    if (response.gambar && response.gambar.length > 0) {
                        $.each(response.gambar, function(index, gambarData) {
                            var gambarName = gambarData.gambar;

                            $('#gambar-preview').append(
                                '<div class="gambar-item">' +
                                '<img src="<?= base_url("upload/gambar_properti/") ?>' +
                                gambarName +
                                '" alt="Preview Gambar" class="d-block rounded">' +
                                '<span class="hapus-gambar" data-gambar="' +
                                gambarName + '">' +
                                '<i class="bx bx-trash"></i>' +
                                '</span>' +
                                '</div>'
                            );
                        });

                        // Tambahkan tombol tambah foto dan input file yang tersembunyi
                        $('#gambar-preview').append(
                            '<div class="tambah-foto-wrapper">' +
                            '<button id="btnTambahFoto" class="tambah-foto-btn" type="button">' +
                            '<i class="bx bx-image-add"></i> Tambahkan Foto' +
                            '</button>' +
                            '<input type="file" id="uploadGambar" accept="image/*" multiple style="display:none">' +
                            '</div>'
                        );
                    } else {
                        $('#gambar-preview').html('<p>Tidak ada gambar yang tersedia.</p>');
                    }
                },
                error: function() {
                    $('#gambar-preview').html('<p>Gagal memuat gambar.</p>');
                }
            });
        }

        // kode ubah properti

        // Fungsi untuk mendapatkan tags berdasarkan id provinsi

        $('#exampleDataList').on('input', function() {
            var inputVal = $(this).val();
            var selectedOption = $('#datalistOptions option').filter(function() {
                return this.value == inputVal;
            });

            if (selectedOption.length) {
                var idProvinsi = selectedOption.data('provinsi');
                $('#id-kota').val(selectedOption.data('id'));
                $('#id-provinsi').val(idProvinsi);
                fetchTagsForProvinsi(idProvinsi);
            }
        });

        // Event listener untuk input status
        $('#status-properti').on('input', function() {
            var inputVal = $(this).val();
            var selectedOption = $('#data-status option').filter(function() {
                return this.value == inputVal;
            });

            if (selectedOption.length) {
                $('#id-status').val(selectedOption.data('id'));
            }
        });

        $('#data-agent').on('input', function() {
            var inputVal = $(this).val();
            var selectedOption = $('#option-agent option').filter(function() {
                return this.value == inputVal;
            });

            if (selectedOption.length) {
                $('#id-agency').val(selectedOption.data('id_agn'));
            }
        });

        // Menangani klik tombol Edit
        $(document).on('click', '.btn-edit', function() {
            var baseUrl = "<?php echo base_url(); ?>";

            var id_properti = $(this).data('id');
            var id_provinsi = $(this).data('id_provinsi');
            var type_properti = $(this).data('type');
            var id_type = $(this).data('id_type');
            var judul = $(this).data('judul');
            var status = $(this).data('status');
            var idstatus = $(this).data('idstatus');
            var deskripsi = $(this).data('deskripsi');
            var alamat = $(this).data('alamat');
            var lokasi = $(this).data('lokasi');
            var id_kota = $(this).data('id_kota');
            var area = $(this).data('area');
            var penawaran = $(this).data('penawaran');
            var kota = $(this).data('kota');
            var kamar = $(this).data('jml_kamar');
            var kamar_mandi = $(this).data('kamar_mandi');
            var luas_tanah = $(this).data('luas_tanah');
            var luas_bangunan = $(this).data('luas_bangunan');
            var level = $(this).data('level');
            var daya_listrik = $(this).data('daya');
            var carport = $(this).data('carport');
            var ruang_tamu = $(this).data('ruang_tamu');
            var ruang_keluarga = $(this).data('ruang_keluarga');
            var taman = $(this).data('taman');
            var ruang_makan = $(this).data('ruang_makan');
            var balkon = $(this).data('balkon');
            var harga = $(this).data('harga');
            var satuan = $(this).data('satuan');
            var agent = $(this).data('agent');
            var id_agent = $(this).data('id_agency');

            var jalan = $(this).data('jalan');
            var masjid = $(this).data('masjid');
            var taman_bermain = $(this).data('taman_bermain');
            var area_ruko = $(this).data('ruko');
            var kolam_renang = $(this).data('kolam_renang');
            var onegate = $(this).data('gate');
            var security = $(this).data('security');
            var cctv = $(this).data('cctv');
            var gambar = $(this).data('gambar');
            var meta = $(this).data('foto_meta');

            if (area) {
                var areas = area.split(',');
                $('#choices-multiple-remove-button').empty();

                $.ajax({
                    url: '<?= base_url('Properti/getKotaByProvinsi'); ?>',
                    type: 'GET',
                    data: {
                        id_provinsi: id_provinsi
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.length > 0) {
                            $('#choices-multiple-remove-button').empty();

                            $.each(response, function(index, value) {
                                $('#choices-multiple-remove-button').append($(
                                    '<option>', {
                                        value: value.nama_kota,
                                        text: value.nama_kota
                                    }));
                            });

                            if (typeof choices !== "undefined") {
                                choices.destroy();
                            }

                            var choices = new Choices('#choices-multiple-remove-button', {
                                removeItemButton: true
                            });

                            choices.setValue(areas.map(area => area.trim()));
                        } else {
                            console.log('Tidak ada data kota yang ditemukan.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan: ' + error);
                    }
                });
            } else {
                console.log('Tidak ada data area yang ditemukan.');
            }


            // Menampilkan gambar di preview
            $('#gambar-preview').empty();
            if (gambar) {
                var gambarArray = gambar.split(',');
                var hasImage = false;
                var loadedImages = 0;

                $.each(gambarArray, function(index, value) {
                    if (typeof value === 'string') {
                        $.ajax({
                            url: '<?= base_url("upload/gambar_properti/") ?>' + value,
                            type: 'HEAD',
                            success: function() {
                                $('#gambar-preview').append(
                                    '<div class="gambar-item">' +
                                    '<img src="<?= base_url("upload/gambar_properti/") ?>' +
                                    value +
                                    '" alt="Preview Gambar" class="d-block rounded">' +
                                    '<span class="hapus-gambar" data-gambar="' +
                                    value + '">' +
                                    '<i class="bx bx-trash"></i>' +
                                    '</span>' +
                                    '</div>'
                                );
                                hasImage = true;
                                loadedImages++;

                                // Pastikan untuk memeriksa jika semua gambar telah dimuat
                                if (loadedImages === gambarArray.length) {
                                    $('#gambar-preview').append(
                                        '<div class="tambah-foto-wrapper">' +
                                        '<button id="btnTambahFoto" class="tambah-foto-btn" type="button">' +
                                        '<i class="bx bx-image-add"></i> Tambahkan Foto' +
                                        '</button>' +
                                        '<input type="file" id="uploadGambar" accept="image/*" multiple style="display:none">' +
                                        '</div>'
                                    );
                                }
                            },
                            error: function() {
                                console.warn(value + ' tidak ditemukan.');
                                loadedImages++;
                                if (loadedImages === gambarArray.length) {
                                    $('#gambar-preview').append(
                                        '<div class="tambah-foto-wrapper">' +
                                        '<button id="btnTambahFoto" class="tambah-foto-btn" type="button">' +
                                        '<i class="bx bx-image-add"></i> Tambahkan Foto' +
                                        '</button>' +
                                        '<input type="file" id="uploadGambar" accept="image/*" multiple style="display:none">' +
                                        '</div>'
                                    );
                                }
                            }
                        });
                    } else {
                        console.warn(value + ' bukan string yang valid.');
                    }
                });
            } else {
                // Jika tidak ada gambar, tetap tampilkan tombol Tambahkan Foto
                $('#gambar-preview').html('<p>Tidak ada gambar yang tersedia.</p>');
                $('#gambar-preview').append(
                    '<div class="tambah-foto-wrapper">' +
                    '<button id="btnTambahFoto" class="tambah-foto-btn" type="button">' +
                    '<i class="bx bx-image-add"></i> Tambahkan Foto' +
                    '</button>' +
                    '<input type="file" id="uploadGambar" accept="image/*" multiple style="display:none">' +
                    '</div>'
                );
            }

            // Event handler untuk membuka file input saat tombol tambah foto diklik
            $(document).on('click', '#btnTambahFoto', function() {
                $('#uploadGambar').click();
            });

            $(document).on('click', '.hapus-gambar', function() {
                var fileName = $(this).data('gambar');
                var idProperti = $('#ubah-id-properti').val();

                $.ajax({
                    url: '<?= base_url("Properti/hapus_gambar") ?>',
                    type: 'POST',
                    data: {
                        id_properti: idProperti,
                        gambar: fileName
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            // Hapus elemen gambar dari DOM
                            $(this).closest('.gambar-item').remove();
                        } else {
                            alert(result.message);
                        }
                    }.bind(this)
                });
            });

            // kode untuk upload gambar
            $(document).on('change', '#uploadGambar', function(event) {
                var files = event.target.files;
                var totalFiles = files.length;

                if (totalFiles > 0) {
                    for (var i = 0; i < totalFiles; i++) {
                        var file = files[i];
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#gambar-preview').prepend(
                                '<div class="gambar-item">' +
                                '<img src="' + e.target.result +
                                '" alt="Preview Gambar" class="d-block rounded">' +
                                '<span class="hapus-gambar" data-gambar="' + file.name +
                                '">' +
                                '<i class="bx bx-trash"></i>' +
                                '</span>' +
                                '</div>'
                            );
                        };

                        reader.readAsDataURL(file);
                    }
                    $('#btnSimpanGambar').remove();
                    $('#gambar-preview').after(
                        '<button id="btnSimpanGambar" type="button" class="btn btn-primary mt-3">Simpan Gambar</button>'
                    );
                }
            });

            // Code untuk menyimpan gambar ke server dengan spinner di dalam tombol
            $(document).on('click', '#btnSimpanGambar', function() {
                var formData = new FormData();
                var files = $('#uploadGambar')[0].files;
                var idProperti = $('#ubah-id-properti').val();

                if (files.length > 0) {
                    for (var i = 0; i < files.length; i++) {
                        formData.append('gambar[]', files[i]);
                    }
                    formData.append('id_properti', idProperti);

                    $('#btnSimpanGambar').prop('disabled', true).html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...'
                    );

                    $.ajax({
                        url: '<?= base_url("Properti/upload_gambar") ?>',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            alert('Gambar berhasil diunggah!');

                            loadGambar(idProperti);
                            $('#btnSimpanGambar').remove();
                        },
                        error: function(xhr, status, error) {
                            alert('Gagal mengunggah gambar: ' + error);
                        },
                        complete: function() {
                            $('#btnSimpanGambar').prop('disabled', false).html(
                                'Simpan Gambar');
                        }
                    });
                } else {
                    alert('Tidak ada gambar yang dipilih.');
                }
            });

            $("input[name='nama_type']").val(type_properti);
            if (type_properti === "Perumahan" || type_properti === "Apartment") {
                $("#fasilitas-section").show();
            } else {
                $("#fasilitas-section").hide();
            }

            $('#ubah-id-properti').val(id_properti);
            $('#judul').val(judul);
            $('#type-properti').val(type_properti);
            $('#deskripsi').val(deskripsi);
            $('#alamat').val(alamat);
            $('#lokasi').val(lokasi);
            $('#id-kota').val(id_kota);
            $('#id-provinsi').val(id_provinsi);
            $('#id-type').val(id_type);
            $('#status-properti').val(status);
            $('#id-status').val(idstatus);
            $('#jenis-penawaran').val(penawaran);
            $('#exampleDataList').val(kota);
            $('#kamar').val(kamar);
            $('#kamar-mandi').val(kamar_mandi);
            $('#luas-tanah').val(luas_tanah);
            $('#luas-bangunan').val(luas_bangunan);
            $('#level').val(level);
            $('#daya-listrik').val(daya_listrik);
            $('#carport').val(carport);
            $('#ruang-tamu').val(ruang_tamu);
            $('#ruang-keluarga').val(ruang_keluarga);
            $('#taman').val(taman);
            $('#ruang-makan').val(ruang_makan);
            $('#balkon').val(balkon);
            $('#harga').val(harga);
            $('#satuan').val(satuan);
            $('#data-agent').val(agent);
            $('#id-agency').val(id_agent);

            $('#jalan').val(jalan);
            $('#taman_bermain').prop('checked', taman_bermain === 1);
            $('#area_ruko').prop('checked', area_ruko === 1);
            $('#kolam_renang').prop('checked', kolam_renang === 1);
            $('#onegate').prop('checked', onegate === 1);
            $('#security').prop('checked', security === 1);
            $('#cctv').prop('checked', cctv === 1);
            $('#masjid').prop('checked', masjid === 1);

            // Hapus foto sebelumnya
            $('#meta-preview').empty();
            // $('#change-foto').addClass('d-none');

            // Tampilkan foto jika ada
            if (meta) {
                var fotoPath = `${baseUrl}upload/meta_properti/${meta}`;
                var imgElement = `<img src="${fotoPath}" alt="Foto Meta" class="img-fluid" />`;
                $('#meta-preview').append(imgElement);
                $('#change-foto').removeClass('d-none');
            }

        });

        $('#change-foto').on('click', function() {
            $('#upload-meta').trigger('click');
        });

        $('#upload-meta').on('change', function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#meta-preview').empty();
                    var imgElement =
                        `<img src="${e.target.result}" alt="Foto Meta" class="img-fluid" />`;
                    $('#meta-preview').append(imgElement);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

        // Simpan perubahan
        $('#submitEditProperti').on('click', function() {
            const formData = new FormData($('#edit-properti-form')[0]);

            var files = $('#upload-meta')[0] ? $('#upload-meta')[0].files :
                undefined;
            if (files && files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    formData.append('foto_meta[]', files[i]);
                }
            }

            // Atur nilai checkbox menjadi 1 jika checked, 0 jika tidak
            formData.set('taman_bermain', $('#taman_bermain').is(':checked') ? 1 : 0);
            formData.set('area_ruko', $('#area_ruko').is(':checked') ? 1 : 0);
            formData.set('kolam_renang', $('#kolam_renang').is(':checked') ? 1 : 0);
            formData.set('onegate', $('#onegate').is(':checked') ? 1 : 0);
            formData.set('security', $('#security').is(':checked') ? 1 : 0);
            formData.set('cctv', $('#cctv').is(':checked') ? 1 : 0);
            formData.set('masjid', $('#masjid').is(':checked') ? 1 : 0);

            var selectedCityName = $('#choices-multiple-remove-button option:selected').text();
            formData.set('nama_kota', selectedCityName);

            $('#loadingIcon').removeClass('d-none');
            $('#loadingText').removeClass('d-none');
            $('#submitEditProperti').prop('disabled', true);

            $.ajax({
                url: '<?php echo base_url("Properti/updateProperti"); ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#loadingIcon').removeClass('d-none');
                    $('#loadingText').removeClass('d-none');
                    $('#submitText').addClass('d-none');
                },
                success: function(response) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });

                    $('#ubah-properti').modal('hide');
                    location.reload();
                },
                complete: function() {
                    $('#loadingIcon').addClass('d-none');
                    $('#loadingText').addClass('d-none');
                    $('#submitText').removeClass('d-none');
                    $('#submitEditProperti').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan: ' + error
                    });
                }
            });
        });

        $('#ubah-properti').on('hidden.bs.modal', function() {
            location.reload();
        });

    });
    </script>