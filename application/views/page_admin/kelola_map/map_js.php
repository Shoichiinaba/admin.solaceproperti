<!-- Modal tambah provinsi-->
<div class="modal fade" id="add-maps" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Maps</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tambah-maps">
                    <div class="row">
                        <div class="mb-2">
                            <label for="exampleDataList" class="form-label">Pilih Provinsi</label>
                            <input class="form-control" list="datalistOptions" id="exampleDataList"
                                placeholder="Ketik nama provinsi...">
                            <datalist id="datalistOptions">
                                <?php foreach ($provinsi as $prov) : ?>
                                <option data-id="<?php echo $prov->id; ?>" value="<?php echo $prov->nama; ?>"></option>
                                <?php endforeach; ?>
                            </datalist>
                            <input type="hidden" name="provinsi_id" id="provinsi_id" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="textarea-container">
                            <label for="exampleFormControlTextarea1" class="form-label">Masukkan code SVG</label>
                            <textarea class="form-control" id="maps-code" rows="3"></textarea>
                            <button type="button" class="btn btn-sm rounded-pill btn-icon btn-outline-danger"
                                id="previewBtn">
                                <span class="tf-icons bx bxs-file-find"></span>
                            </button>
                        </div>
                    </div>
                    <div class="row g-2 preview-container" id="svgPreview">
                        <!-- preview svg -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm rounded-2 btn-outline-danger" id="btn-simpan">
                    <span id="btn-text-simpan">Simpan</span>
                    <span id="loading-icon-simpan" class="loading" style="display:none;">
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                            <rect x="11" y="6" rx="1" width="2" height="7">
                                <animateTransform attributeName="transform" type="rotate" dur="9s"
                                    values="0 12 12;360 12 12" repeatCount="indefinite" />
                            </rect>
                            <rect x="11" y="11" rx="1" width="2" height="9">
                                <animateTransform attributeName="transform" type="rotate" dur="0.75s"
                                    values="0 12 12;360 12 12" repeatCount="indefinite" />
                            </rect>
                        </svg> Loading...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- akhir modal tambah provinsi -->

<!-- Modal tambah data maps-->
<div class="modal fade" id="add-data-maps" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Maps</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="previewForm" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-4">
                            <button type="button" class="btn btn-sm btn-outline-primary">
                                Jumlah Kota &nbsp;
                                <span class="badge ml-2 count">0</span>
                            </button>
                            <input type="hidden" id="id-prov" name="id_prov" required>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <div class="input-group">
                                <input type="file" class="form-control" id="inputGroupFile02" name="file"
                                    accept=".xlsx, .xls" />
                                <label class="input-group-text" for="inputGroupFile02">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20px"
                                        height="20px">
                                        <defs>
                                            <linearGradient id="G7C1BuhajJQaEWHVlNUzHa" x1="6" x2="27" y1="24" y2="24"
                                                data-name="Безымянный градиент 10" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#21ad64" />
                                                <stop offset="1" stop-color="#088242" />
                                            </linearGradient>
                                        </defs>
                                        <path fill="#31c447" d="m41,10h-16v28h16c.55,0,1-.45,1-1V11c0-.55-.45-1-1-1Z" />
                                        <path fill="#fff"
                                            d="m32,15h7v3h-7v-3Zm0,10h7v3h-7v-3Zm0,5h7v3h-7v-3Zm0-10h7v3h-7v-3Zm-7-5h5v3h-5v-3Zm0,10h5v3h-5v-3Zm0,5h5v3h-5v-3Zm0-10h5v3h-5v-3Z" />
                                        <path fill="url(#G7C1BuhajJQaEWHVlNUzHa)" d="m27,42l-21-4V10l21-4v36Z" />
                                        <path fill="#fff"
                                            d="m19.13,31l-2.41-4.56c-.09-.17-.19-.48-.28-.94h-.04c-.05.22-.15.54-.32.98l-2.42,4.52h-3.76l4.46-7-4.08-7h3.84l2,4.2c.16.33.3.73.42,1.18h.04c.08-.27.22-.68.44-1.22l2.23-4.16h3.51l-4.2,6.94,4.32,7.06h-3.74Z" />
                                    </svg>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <button id="previewButton" type="submit" name="preview" value="Preview"
                                class="btn btn-icon btn-outline-danger" title="Preview">
                                <span id="iconSearch" class="tf-icons bx bx-search"></span>
                                <span id="loadingSpinner" class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true" style="display: none;"></span>
                            </button>
                        </div>
                        <small id="fileWarning" class="text-danger mt-2">Upload file excel only</small>
                    </div>
                </form>

                <!-- Container for Preview Result -->
                <div class="table-responsive text-nowrap">
                    <div id="previewResult"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- akhir Modal tambah data maps -->
<!-- modal input id -->
<div class="modal fade" id="inputModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Masukkan ID</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="input-id">Masukkan ID:</label>
                <input type="text" id="input-id" class="form-control" />
                <input type="hidden" id="id-prov-map" class="form-control" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="save-id">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- akhir modal input id -->

<script>
// preview svg
document.getElementById('previewBtn').addEventListener('click', function() {
    var svgCode = document.getElementById('maps-code').value;
    var previewContainer = document.getElementById('svgPreview');
    previewContainer.innerHTML = svgCode;
});

$(document).ready(function() {
    // code load warna

    function loadMapColors(id_prov) {
        setTimeout(function() {
            var map = $('.cls-2');
            var data = new FormData();
            var param = [];

            for (var i = 0; i < map.length; i++) {
                if (map[i].id) {
                    param[i] = map[i].id;
                    data.append('id[]', map[i].id);
                }
            }
            $.ajax({
                url: "<?php echo base_url('Kelola_map/allColor') ?>",
                data: data,
                type: 'GET',
                processData: false,
                contentType: false,
                success: function(data) {
                    for (var i = 0; i < data.results.length; i++) {
                        var path = data.results[i];
                        var element = $(`#${path.code}`);
                        element.css('fill', path.color);
                    }

                }
            });
        }, 2000);

        $('.cls-1').click(function() {

            var svgElement = $(this);
            // svgElement.addClass('active');
            // var svgPath = svgElement[0].outerHTML;

            // Menampilkan modal
            $('#id-prov-map').val(id_prov);
            $('#inputModal').modal('show');

            $('#save-id').off('click').on('click', function() {
                var inputId = $('#input-id').val();
                if (inputId) {
                    // Menambahkan ID ke elemen SVG
                    svgElement.attr('id', inputId);
                    var updatedSvgPath = svgElement[0].outerHTML;

                    $.ajax({
                        url: "<?php echo base_url('Kelola_map/update_svg_id') ?>",
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            id_prov: id_prov,
                            updated_svg_path: updatedSvgPath
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.status === 'success') {
                                alert('ID berhasil disimpan!');
                            } else {
                                alert('Gagal menyimpan ID: ' + response.message);
                            }
                            $('#inputModal').modal('hide');
                            $('#input-id').val('');
                        },
                        error: function(error) {
                            alert(
                                'Gagal menyimpan ID. Kesalahan jaringan atau server.'
                            );
                        }
                    });
                } else {
                    alert('Harap masukkan ID.');
                }
            });
        });
    }

    // code menu provinsi
    $('.nav-link').on('click', function() {
        var mapId = $(this).data('id');
        var id_prov = $(this).data('id_prov');

        // console.log('ID yang dikirim:', mapId);

        $.ajax({
            url: '<?php echo base_url('Kelola_map/get_map'); ?>',
            type: 'POST',
            data: {
                id: mapId,
                id_prov: id_prov
            },
            success: function(response) {
                var data = JSON.parse(response);

                if (data.error) {
                    console.error('Error:', data.error);
                    alert(data.error);
                } else {
                    var svgMap = data.svg_map;

                    var targetTab = $(`#map-${mapId}`);
                    targetTab.html(svgMap);

                    loadMapColors(id_prov);
                }
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan:', error);
            }
        });
    });

    // Muat peta pertama secara default
    $('.nav-link.active').click();

    // code simpan maps
    $('#exampleDataList').on('input', function() {
        var inputVal = $(this).val();
        var selectedOption = $('#datalistOptions option').filter(function() {
            return this.value == inputVal;
        });
        $('#provinsi_id').val(selectedOption.data('id'));
    });

    // Form submit handler
    $('#btn-simpan').click(function() {
        $('#tambah-maps').submit();
    });

    $('#tambah-maps').submit(function(event) {
        event.preventDefault();

        $('#btn-text-simpan').hide();
        $('#loading-icon-simpan').show();
        $('#btn-simpan').attr('disabled', true);

        var provinsi_id = $('#provinsi_id').val();
        var maps_code = $('#maps-code').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('Kelola_map/tambah_maps'); ?>',
            data: {
                provinsi_id: provinsi_id,
                maps_code: maps_code,
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        position: "top-center",
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Map Berhasil Ditambahkan.',
                        timer: 1400
                    });

                    $('#btn-text-simpan').show();
                    $('#loading-icon-simpan').hide();
                    $('#btn-simpan').attr('disabled', false);

                    $('#add-maps').modal('hide');
                    $('#tambah-maps')[0].reset();

                    window.location.href = "<?php echo base_url('Kelola_map'); ?>";

                } else {
                    console.error('Terjadi kesalahan saat validasi data di server.');

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat validasi data di server.',
                    });

                    $('#btn-text-simpan').show();
                    $('#loading-icon-simpan').hide();
                    $('#btn-simpan').attr('disabled', false);
                }
            },
            error: function(xhr, status, error) {
                $('#btn-text-simpan').show();
                $('#loading-icon-simpan').hide();
                $('#btn-simpan').attr('disabled', false);

                console.error(xhr.responseText);

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengirim data ke server.',
                });
            }
        });
    });

    $('.badge-custom').on('click', function() {
        var idMap = $(this).data('id');
        var idProv = $(this).data('id-prov');

        $('#id-map').val(idMap);
        $('#id-prov').val(idProv);

        $.ajax({
            url: '<?php echo base_url('Kelola_map/countDataByProv'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                id_prov: idProv
            },
            success: function(response) {
                if (response && response.count !== undefined) {
                    $('.count').text(response.count);
                } else {
                    console.error('Data tidak sesuai format:', response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    });

    // code preview
    $("#previewButton").click(function(e) {
        e.preventDefault();
        var formData = new FormData($('#previewForm')[0]);

        $("#loadingSpinner").show();
        $("#iconSearch").hide();

        $.ajax({
            url: "<?php echo base_url('Kelola_map/preview'); ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log("Success: ", response);
                $("#previewResult").html(response);
                $("#fileWarning").hide();
                $("#loadingSpinner").hide();
                $("#iconSearch").show();
            },
            error: function(xhr, status, error) {
                console.log("Error: ", xhr.responseText);
                alert("Terjadi kesalahan saat melakukan preview.");
                $("#loadingSpinner").hide();
                $("#iconSearch").show();
            }
        });
    });

});
</script>