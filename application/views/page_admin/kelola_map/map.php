<div class="container-xxl flex-grow-1 container-p-y">
    <div class="demo-inline-spacing mb-4">
        <button type="button" class="btn btn-sm btn-primary rounded-2" data-bs-toggle="modal"
            data-bs-target="#add-maps">Tambah Maps</button>
        <a href="<?php echo site_url('Kelola_map/daftar_kota'); ?>" class="btn btn-sm btn-danger rounded-2">Lihat
            Kode Kota</a>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <?php foreach ($map_prov as $index => $data) : ?>
                    <li class="nav-item position-relative">
                        <button type="button" class="nav-link <?php echo $index === 0 ? 'active' : ''; ?>" role="tab"
                            data-bs-toggle="tab" data-id="<?= $data->id; ?>" data-id_prov="<?= $data->id_prov; ?>"
                            data-bs-target="#map-<?= $data->id; ?>" aria-controls="map-<?= $data->id; ?>"
                            aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                            <i class="tf-icons bx bx-map-pin"></i> <?= $data->nama; ?>
                        </button>
                        <a class="badge badge-center rounded-pill bg-label-info position-absolute badge-custom"
                            data-id="<?= $data->id; ?>" data-id-prov="<?= $data->id_prov; ?>" data-bs-toggle="modal"
                            data-bs-target="#add-data-maps">
                            <span class="tf-icons bx bx-plus"></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content">
                    <?php foreach ($map_prov as $index => $data) : ?>
                    <div class="tab-pane fade <?php echo $index === 0 ? 'show active' : ''; ?>"
                        id="map-<?= $data->id; ?>" role="tabpanel">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>