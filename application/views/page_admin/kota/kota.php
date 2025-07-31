<style>
    .filter {
        margin-left: 13px;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="row">
            <h5 class="card-header pb-2">Daftar Kota & Kabupaten</h5>
            <div class="col-md-3 col-sm-4 col-lg-2 mb-3 mt-0 ms-3 pl-2 custom-margin">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="tf-icons bx bx-street-view text-info"></i></span>
                    <input class="form-control form-select-sm" list="datalistOptions" id="exampleDataList" placeholder="Ketik provinsi..." aria-label="Provinsi" aria-describedby="basic-addon1">
                </div>
                <datalist id="datalistOptions">
                    <?php foreach ($provinsi as $prov) : ?>
                        <option data-id="<?php echo $prov->id; ?>" value="<?php echo $prov->nama; ?>"></option>
                    <?php endforeach; ?>
                </datalist>
                <input type="hidden" name="provinsi_id" id="provinsi_id" required>
            </div>
            <div class="card-datatable table-responsive pt-0 mb-2">
                <table id="data-kota" class="datatables-basic table border-top mt-3 mb-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Code Kota</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>