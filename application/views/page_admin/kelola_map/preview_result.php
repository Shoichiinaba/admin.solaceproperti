<?php
// Tampilkan pesan error upload jika ada
if (isset($upload_error)) {
    echo "<div style='color: red;'>" . htmlspecialchars($upload_error) . "</div>";
    die;
}

// Mulai form
echo "<form id='importForm' method='post'>";

// Tampilkan pesan jika ada data yang kosong
echo "<div style='color: red; display: none;' id='kosong'>
    Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
</div>";

// Tampilkan tabel preview data

echo "<table class='table table-hover'>
            <thead>
                <th colspan='5' class='text-center'>Preview Data</th>
                <tr>
                    <th>No</th>
                    <th>Id Prov</th>
                    <th>Code Kota</th>
                    <th>Color</th>
                </tr>
            </thead>
        ";

if (isset($sheet) && is_array($sheet)) {
    $kosong = 0;
    $numrow = 1;

    // Menghindari baris header, dimulai dari baris kedua
    foreach ($sheet as $index => $row) {
        if ($index == 1) continue; // Lewati baris header

        $code = isset($row['A']) ? $row['A'] : '';
        $color = isset($row['B']) ? $row['B'] : '';

        if (empty($code) && empty($color)) continue;

        $code_td = empty($code) ? " style='background: #E07171;'" : "";
        $color_td = empty($color) ? " style='background: #E07171;'" : "";

        if (empty($code) || empty($color)) {
            $kosong++;
        }

        echo "<tbody class='table-border-bottom-0'>";
        echo "<tr>";
        echo "<td>" . $numrow . "</td>";
        echo "<td>" . (isset($id_prov) ? htmlspecialchars($id_prov) : '') . "</td>";
        echo "<td" . $code_td . ">" . htmlspecialchars($code) . "</td>";
        echo "<td" . $color_td . ">" . htmlspecialchars($color) . "</td>";
        echo "</tr>";
        echo "</tbody>";

        $numrow++;
    }

    echo "</table>";

    if ($kosong > 0) {
        echo "<script>
                    $(document).ready(function() {
                        $('#jumlah_kosong').html('$kosong');
                        $('#kosong').show();
                    });
                </script>";
    } else {
        echo "<hr>";
        echo "<div style='margin-top: 10px;'>";
        echo "<button id='importButton' type='button' class='btn btn-sm btn-outline-success rounded-2' name='import' style='margin-right: 10px;'>Import</button>";
        echo "<a class='btn btn-sm btn-outline-warning rounded-2' href='" . base_url("Kelola_map") . "'>Cancel</a>";
        echo "</div>";
    }
} else {
    echo "<div style='color: red;'>Data tidak tersedia untuk preview.</div>";
}

echo "<input type='hidden' name='id-prov' value='" . htmlspecialchars(isset($id_prov) ? $id_prov : '') . "'>";

// Akhiri form
echo "</form>";
?>


<script>
    $(document).ready(function() {
        $("#importButton").click(function(e) {
            e.preventDefault();
            var formData = new FormData($('#importForm')[0]);

            var importButton = $(this);
            importButton.prop('disabled', true);
            var originalButtonText = importButton.html();
            importButton.html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Importing...'
            );

            $.ajax({
                url: "<?php echo base_url('Kelola_map/import'); ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log("Success: ", response);
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        alert(jsonResponse.message);
                        window.location.href = "<?php echo base_url('Kelola_map'); ?>";
                    } else {
                        alert("Gagal menyimpan data: " + jsonResponse.message);
                    }
                    importButton.prop('disabled', false);
                    importButton.html(originalButtonText);
                },
                error: function(xhr, status, error) {
                    console.log("Error: ", xhr.responseText);
                    alert("Terjadi kesalahan saat menyimpan data.");
                    importButton.prop('disabled', false);
                    importButton.html(originalButtonText);
                }
            });
        });
    });
</script>