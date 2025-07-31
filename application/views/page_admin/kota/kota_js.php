<!-- datatables -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap4.js"></script>

<script>
$(document).ready(function() {
    // Mengambil id dari select
    $('#exampleDataList').on('input', function() {
        var inputVal = $(this).val();
        var selectedOption = $('#datalistOptions option').filter(function() {
            return this.value === inputVal;
        });

        if (selectedOption.length > 0) {
            $('#provinsi_id').val(selectedOption.data('id')).trigger('change');
        }
    });

    // Code datatable
    var table;
    table = $('#data-kota').DataTable({
        "responsive": true,
        "paging": true,
        "autoWidth": true,
        "search": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?= site_url('Kelola_map/get_data_kota') ?>",
            "type": "POST",
            "data": function(d) {
                d.fil_provinsi = $('#provinsi_id').val();
            }
        },

        "lengthMenu": [
            [10, 25, 50, 75, 100, -1],
            [10, 25, 50, 75, 100, "All"]
        ],
    });

    $('#provinsi_id').on('change', function() {
        // Debugging apakah nilai select muncul
        // console.log('Nilai select: ' + $(this).val());
        table.draw();
    });
});
</script>