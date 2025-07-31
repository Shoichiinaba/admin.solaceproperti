<!-- modal edit banner -->
<div class="modal fade" id="edit-banner" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Ubah Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <div class="container mt-2">
                    <form id="edit-banner-form" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Tambahkan id untuk properti -->
                            <div class="input-wrapper col-4 proper" id="input-properti" style="display: none;">
                                <input class="form-control" list="datalistbanner" id="ubah-idprop" name="judul_properti"
                                    placeholder="Ketik nama properti...">
                                <label for="ubah-idprop" class="label-in">Pilih Properti</label>
                                <datalist id="datalistbanner">
                                    <?php foreach ($prop_select as $prop) : ?>
                                    <option data-id="<?php echo $prop->id_properti; ?>"
                                        value="<?php echo $prop->judul_properti; ?>">
                                    </option>
                                    <?php endforeach; ?>
                                </datalist>
                                <input type="hidden" name="id_properti" id="edit-id-properti">
                                <input type="hidden" name="id_banner" id="id-banner">
                            </div>

                            <!-- Tambahkan id untuk penawaran -->
                            <div class="input-wrapper col-4" id="input-penawaran" style="display: none;">
                                <input class="form-control" list="data-penawaran" id="edit-penawaran" name="penawaran"
                                    placeholder="Pilih jenis Penawaran..." />
                                <label for="penawaran" class="label-in">Pilih Penawaran</label>
                                <datalist id="data-penawaran">
                                    <option value="Dijual"></option>
                                    <option value="Disewa"></option>
                                </datalist>
                            </div>

                            <!-- Pilih Type -->
                            <div class="input-wrapper col-12" id="input-type">
                                <input class="form-control" list="type-banner" id="edit-type" name="type_banner" />
                                <label for="type_banners" class="label-in">Pilih Type</label>
                                <datalist id="type-banner">
                                    <option value="Full"></option>
                                    <option value="Split"></option>
                                    <option value="KPR"></option>
                                    <option value="Properti Dijual"></option>
                                    <option value="Properti Disewa"></option>
                                    <option value="All Properti"></option>
                                </datalist>
                            </div>

                            <div class="input-wrapper col-12 mt-3">
                                <div class="alert alert-primary col-12 mb-0" role="alert">Upload Banner
                                    <div id="banner-preview" class="position-relative">
                                    </div>
                                    <button type="button" id="change-foto"
                                        class="btn btn-sm btn-primary rounded-3">Ganti
                                        Profil</button>
                                    <input type="file" id="upload-banner" class="d-none" name="foto_banner">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="UbahBanner" class="btn btn-primary rounded-3">
                    <span id="loadingIconEdit" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                    <span id="loadingTexEdit" class="d-none">Menyimpan...</span>
                    <span id="submitTextEdit">Ubah</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- modal tambah banner -->
<div class="modal fade" id="add-banner" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Tambah Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <div class="container mt-2">
                    <form id="upload-banner" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-wrapper col-6" id="type-wrapper">
                                <input class="form-control" list="type-banner" id="type-banner-input" name="type_banner"
                                    placeholder="Pilih Type Banner..." />
                                <label for="type_banner" class="label-in">Pilih Type</label>
                                <datalist id="type-banner">
                                    <option value="Full"></option>
                                    <option value="Split"></option>
                                    <option value="KPR"></option>
                                    <option value="Properti Dijual"></option>
                                    <option value="Properti Disewa"></option>
                                    <option value="All Properti"></option>
                                </datalist>
                            </div>
                            <div class="input-wrapper col-4" id="property-wrapper">
                                <input class="form-control" list="datalistOptions" id="exampleDataList"
                                    name="judul_properti" placeholder="Ketik nama properti...">
                                <label for="exampleDataList" class="label-in">Pilih Properti</label>
                                <datalist id="datalistOptions">
                                    <?php foreach ($prop_select as $prop) : ?>
                                    <option data-id="<?php echo $prop->id_properti; ?>"
                                        value="<?php echo $prop->judul_properti; ?> (<?php echo $prop->luas_tanah; ?>/<?php echo $prop->luas_bangunan; ?>)">
                                    </option>
                                    <?php endforeach; ?>
                                </datalist>
                                <input type="hidden" name="id_properti" id="id-properti">
                            </div>
                            <div class="input-wrapper col-6" id="penawaran-wrapper">
                                <input class="form-control" list="data-penawaran" id="penawaran" name="penawaran"
                                    placeholder="Pilih jenis Penawaran..." />
                                <label for="penawaran" class="label-in">Pilih Penawaran</label>
                                <datalist id="data-penawaran">
                                    <option value="Dijual"></option>
                                    <option value="Disewa"></option>
                                </datalist>
                            </div>
                            <div class="input-wrapper col-12 mt-4">
                                <div class="alert alert-info " role="alert">Upload Banner
                                    <div id="dropzone" class="dropzone mt-2"></div>
                                    <div id="responseMessage" class="mt-3"></div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submitBanner" class="btn btn-primary rounded-3">
                    <span id="loadingIcon" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                    <span id="loadingText" class="d-none">Menyimpan...</span>
                    <span id="submitText">Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {

    // Periksa dan update tampilan berdasarkan input type-banner
    $('#type-banner-input').on('input', function() {
        var typeValue = $(this).val();

        if (typeValue === 'Full') {
            $('#property-wrapper').removeClass('col-4').addClass('col-4').show();
            $('#penawaran-wrapper').removeClass('col-6').addClass('col-4').show();
        } else if (typeValue === 'Properti Dijual') {
            $('#penawaran-wrapper').removeClass('col-6').addClass('col-4').show();
            $('#penawaran').val('Dijual');
            $('#id-properti').val('');
            $('#property-wrapper').hide();
        } else if (typeValue === 'Properti Disewa') {
            $('#penawaran-wrapper').removeClass('col-6').addClass('col-4').show();
            $('#penawaran').val('Disewa');
            $('#id-properti').val('');
            $('#property-wrapper').hide();
        } else if (typeValue === 'KPR') {
            $('#penawaran-wrapper').removeClass('col-6').addClass('col-4').show();
            $('#penawaran').val('DiJual');
            $('#id-properti').val('');
            $('#property-wrapper').hide();
        } else if (typeValue === 'Split') {
            $('#penawaran-wrapper').removeClass('col-6').addClass('col-4').show();
            $('#penawaran').val('');
            $('#id-properti').val('');
            $('#property-wrapper').hide();
        } else if (typeValue === 'All Properti') {
            $('#penawaran-wrapper').removeClass('col-6').addClass('col-4').show();
            $('#penawaran').val('Jual & Sewa');
            $('#id-properti').val('');
            $('#property-wrapper').hide();
        } else {
            $('#property-wrapper').removeClass('col-12').addClass('col-4').hide();
        }

        // Update kelas pada type-wrapper
        if (typeValue === 'Full') {
            $('#type-wrapper').removeClass('col-6').addClass('col-4');
        } else {
            $('#type-wrapper').removeClass('col-4').addClass('col-6');
            $('#penawaran-wrapper').removeClass('col-4').addClass('col-6');
        }
    });

    // Inisialisasi dengan state default
    $('#type-banner-input').trigger('input');
});

// update filter
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.filter-banner').forEach(function(filterItem) {
        filterItem.addEventListener('click', function() {
            let selectedCategory = this.textContent.trim();

            document.getElementById('filterButton').innerHTML =
                `<i class='bx bx-filter'></i> ${selectedCategory}`;

        });
    });
});

$('#exampleDataList').on('input', function() {
    var inputVal = $(this).val();
    var selectedOption = $('#datalistOptions option').filter(function() {
        return this.value == inputVal;
    });

    if (selectedOption.length) {
        var idPro = selectedOption.data('id');
        $('#id-properti').val(selectedOption.data('id'));

    }
});
// kode untuk upload banner

// Inisialisasi Dropzone
Dropzone.autoDiscover = false;

$(document).ready(function() {
    var bannerDropzone = new Dropzone("#dropzone", {
        url: "<?= base_url('Kelola_banner/upload_banner') ?>",
        autoProcessQueue: false,
        paramName: "foto_banner",
        maxFilesize: 1,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictDefaultMessage: "Seret file ke sini atau klik untuk mengupload",
        dictRemoveFile: "Hapus file",
        init: function() {
            var dropzoneInstance = this;

            this.on("sending", function(file, xhr, formData) {
                formData.append("id_properti", $('#id-properti').val());
                formData.append("type_banner", $('#type-banner-input').val());
                formData.append("penawaran", $('#penawaran').val());

                $('#loadingIcon').removeClass('d-none');
                $('#loadingText').removeClass('d-none');
                $('#submitText').addClass('d-none');
            });

            this.on("success", function(file, response) {
                $('#loadingIcon').addClass('d-none');
                $('#loadingText').addClass('d-none');
                $('#submitText').removeClass('d-none');

                if (typeof response === 'string') {
                    response = JSON.parse(response);
                }

                $('#add-banner').modal('hide');
                $('#add-banner form')[0].reset();

                if (response.status === "success") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(function() {
                        dropzoneInstance.removeAllFiles(true);
                        reloadBannerData();
                    });
                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Gagal menyimpan data banner: ' + (response.message ||
                            'Unknown error'),
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });

            this.on("error", function(file, response) {
                $('#loadingIcon').addClass('d-none');
                $('#loadingText').addClass('d-none');
                $('#submitText').removeClass('d-none');

                if (file.size > this.options.maxFilesize * 1024 * 1024) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Ukuran File Terlalu Besar!',
                        text: 'Ukuran file melebihi batas 1 MB.',
                        showConfirmButton: true
                    });
                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat mengupload banner.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });

            this.on("maxfilesexceeded", function(file) {
                this.removeFile(file);
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'Ukuran File Terlalu Besar!',
                    text: 'Ukuran file melebihi batas 1 MB.',
                    showConfirmButton: true
                });
            });
        }
    });

    $('#submitBanner').on('click', function(e) {
        e.preventDefault();

        var queuedFiles = bannerDropzone.getQueuedFiles();
        console.log('Queued files:', queuedFiles);

        if (queuedFiles.length > 0) {
            bannerDropzone.processQueue();
        } else {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Gagal!',
                text: 'Harap unggah file banner sebelum menyimpan.',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });

});

// kode list data banner
$(document).ready(function() {
    var limit = 4;
    var start = 0;
    var action = 'inactive';
    var total_pages = 1;
    var bannerType = '';

    function lazzy_loader(limit) {
        var output = '';
        for (var count = 0; count < limit; count++) {
            output += '<div class="post_data">';
            output += '<div class="image-placeholder content-placeholder">&nbsp;</div>';
            output += '<div class="details-placeholder">';
            output += '<div class="title-placeholder content-placeholder">&nbsp; </div>';
            output += '<div class="sub-title-placeholder content-placeholder">&nbsp;</div>';
            output += '<div class="price-placeholder content-placeholder">&nbsp;</div>';
            output += '</div>';
            output += '</div>';
        }
        $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start, search = '', bannerType = '') {
        $.ajax({
            url: "<?php echo base_url(); ?>Kelola_banner/fetch_banner",
            method: "POST",
            data: {
                limit: limit,
                start: start,
                search: search,
                bannerType: bannerType
            },
            cache: false,
            success: function(data) {
                var response = JSON.parse(data);
                $('#load_data').html('');
                if (response.data.trim() === '') {
                    $('#load_data_message').html(
                        '<div class="alert alert-primary alert-dismissible" role="alert">' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '<i class="fa fa-folder-open"></i> Data Banner Tidak Ditemukan...</div>'
                    );
                    action = 'active';
                } else {
                    if (start === 0) {
                        $('#load_data').html(response.data);
                    } else {
                        $('#load_data').append(response.data);
                    }
                    $('#load_data_message').html("");
                    action = 'inactive';
                    total_pages = response.total_pages;
                    update_pagination();
                }
            }
        });
    }

    function update_pagination() {
        var paginationHtml =
            '<li class="page-item prev"><a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-left"></i></a></li>';

        for (var i = 1; i <= total_pages; i++) {
            paginationHtml += '<li class="page-item ' + (i === (start / limit) + 1 ? 'active' : '') +
                '"><a class="page-link" href="javascript:void(0);">' + i + '</a></li>';
        }

        paginationHtml +=
            '<li class="page-item next"><a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-right"></i></a></li>';

        $('.pagination').html(paginationHtml);
    }

    $('.pagination').on('click', '.page-item', function() {
        if ($(this).hasClass('prev')) {
            if (start >= limit) {
                start -= limit;
                load_data(limit, start, $('#search-banner').val(), bannerType);
            }
        } else if ($(this).hasClass('next')) {
            if (start + limit < total_pages * limit) {
                start += limit;
                load_data(limit, start, $('#search-banner').val(), bannerType);
            }
        } else {
            var page = parseInt($(this).find('.page-link').text());
            start = (page - 1) * limit;
            load_data(limit, start, $('#search-banner').val(), bannerType);
        }
    });

    load_data(limit, start);

    $('#search-banner').on('input', function() {
        var search = $(this).val();
        start = 0;
        load_data(limit, start, search, bannerType);
    });

    $('.filter-banner').on('click', function() {
        bannerType = $(this).data('type');
        start = 0;
        load_data(limit, start, $('#search-banner').val(), bannerType);
    });
});

// Fungsi untuk memuat ulang data
var baseUrl = "<?php echo base_url(); ?>";
var limit = 4;
var start = 0;
var bannerType = '';
var total_pages = 0;

function reloadBannerData() {
    var search = $('#search-banner').val();

    $.ajax({
        url: baseUrl + "Kelola_banner/fetch_banner",
        method: "POST",
        data: {
            limit: limit,
            start: start,
            search: search,
            bannerType: bannerType
        },
        cache: false,
        success: function(data) {
            var response = JSON.parse(data);
            $('#load_data').html('');
            if (response.data.trim() === '') {
                $('#load_data_message').html(
                    '<div class="alert alert-primary alert-dismissible" role="alert">' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '<i class="fa fa-folder-open"></i> Data Banner Tidak Ditemukan...</div>'
                );
                action = 'active';
            } else {
                if (start === 0) {
                    $('#load_data').html(response.data);
                } else {
                    $('#load_data').append(response.data);
                }
                $('#load_data_message').html("");
                action = 'inactive';
                total_pages = response.total_pages;
                update_pagination();
            }
        }
    });
}

// Fungsi untuk update pagination
function update_pagination() {
    if (total_pages === 0) {
        return;
    }

    var paginationHtml =
        '<li class="page-item prev"><a class="page-link" href="javascript:void(0);" onclick="changePage(' + Math
        .max(
            start - limit, 0) + ');"><i class="tf-icon bx bx-chevrons-left"></i></a></li>';

    for (var i = 1; i <= total_pages; i++) {
        paginationHtml += '<li class="page-item ' + (i === (start / limit) + 1 ? 'active' : '') +
            '"><a class="page-link" href="javascript:void(0);" onclick="changePage(' + (i - 1) * limit + ');">' +
            i +
            '</a></li>';
    }

    paginationHtml +=
        '<li class="page-item next"><a class="page-link" href="javascript:void(0);" onclick="changePage(' + Math
        .min(
            start + limit, (total_pages - 1) * limit) + ');"><i class="tf-icon bx bx-chevrons-right"></i></a></li>';

    $('.pagination').html(paginationHtml);
}

function changePage(newStart) {
    if (newStart < 0 || newStart >= total_pages * limit) {
        return;
    }
    start = newStart;
    reloadBannerData();
}

$(document).ready(function() {
    reloadBannerData();
});

// kode hapus data banner
$(document).on('click', '.btn-delete', function() {
    var id_banner = $(this).data('id');

    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Apakah Anda yakin ingin menghapus data Banner?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?php echo site_url('Kelola_banner/hapus_banner'); ?>",
                type: "POST",
                data: {
                    id_banner: id_banner
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire(
                            'Terhapus!',
                            'Agent berhasil dihapus.',
                            'success'
                        ).then(() => {
                            reloadBannerData();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat menghapus data.',
                    });
                }
            });
        }
    });
});


$(document).ready(function() {
    // code javascript untuk edit banner mengatur show hide inputan

    // Event listener untuk modal saat dibuka
    $('#edit-banner').on('shown.bs.modal', function() {
        let typeBannerValue = $('#edit-type').val();

        if (typeBannerValue === "Full") {
            $('#input-properti').show();
            $('#input-penawaran').show();
            $('#input-type').removeClass('col-12').addClass('col-4');
        } else {
            $('#input-properti').hide();
            $('#input-penawaran').hide();
            $('#input-type').removeClass('col-4').addClass('col-12');
        }
    });

    // Event listener ketika ada perubahan di input type banner
    $('#edit-type').on('input change', function() {
        let typeBannerValue = $(this).val();

        if (typeBannerValue === "Full") {
            $('#input-properti').show();
            $('#input-penawaran').show();
            $('#input-type').removeClass('col-12').addClass('col-4');
        } else {
            $('#input-properti').hide();
            $('#input-penawaran').hide();
            $('#input-type').removeClass('col-4').addClass('col-12');
        }
    });
    $('#input-properti').hide();
    $('#input-penawaran').hide();

    $('#ubah-idprop').on('input', function() {
        var inputVal = $(this).val();
        var selectedOption = $('#datalistbanner option').filter(function() {
            return this.value == inputVal;
        });

        if (selectedOption.length) {
            var idPro = selectedOption.data('id');
            $('#edit-id-properti').val(selectedOption.data('id'));

        }
    });

    // Menangani klik tombol Edit
    $(document).on('click', '.btn-edit', function() {
        var id_banner = $(this).data('id_banner');
        var id_properti = $(this).data('id_properti');
        var judul_properti = $(this).data('judul');
        var type_banner = $(this).data('type_banner');
        var penawaran = $(this).data('penawaran');
        var foto = $(this).data('foto');

        $('#id-banner').val(id_banner);
        $('#edit-id-properti').val(id_properti);
        $('#ubah-idprop').val(judul_properti);
        $('#edit-penawaran').val(penawaran);
        $('#edit-type').val(type_banner);

        // Hapus foto sebelumnya
        $('#banner-preview').empty();
        $('#change-foto').addClass('d-none');

        // Tampilkan foto jika ada
        if (foto) {
            var fotoPath = `${baseUrl}upload/banner/${foto}`;
            var imgElement = `<img src="${fotoPath}" alt="Foto Profil" class="img-fluid" />`;
            $('#banner-preview').append(imgElement);
            $('#change-foto').removeClass('d-none');
        }

        $('#ubah-banner').modal('show');
    });

    //    code ubah banner
    $('#change-foto').on('click', function() {
        $('#upload-banner').click();
    });

    // Menangani perubahan pada input file
    $('#upload-banner').on('change', function() {
        var fileName = $(this).val().split('\\').pop();

        // Mengupdate preview jika file dipilih
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#banner-preview').empty();
                var imgElement =
                    `<img src="${e.target.result}" alt="Foto Banner" class="img-fluid" />`;
                $('#banner-preview').append(imgElement);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Simpan perubahan
    $('#UbahBanner').on('click', function() {
        const formData = new FormData($('#edit-banner-form')[0]);

        const fileInput = $('#upload-banner')[0].files[0];
        if (fileInput) {
            console.log('File name:', fileInput.name);
        } else {
            console.log('No file selected');
        }

        $.ajax({
            url: '<?php echo base_url("Kelola_banner/updateBannerData"); ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#loadingIconEdit').removeClass('d-none');
                $('#loadingTextEdit').removeClass('d-none');
                $('#submitTextEdit').addClass('d-none');
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

                $('#edit-banner').modal('hide');
                reloadBannerData();
            },
            complete: function() {
                $('#loadingIconEdit').addClass('d-none');
                $('#loadingTextEdit').addClass('d-none');
                $('#submitTextEdit').removeClass('d-none');
            }
        });
    });

});
</script>