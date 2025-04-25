<?= $this->extend(theme_path('top-nav')) ?>

<?= $this->section('content') ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">INFORMASI KETERSEDIAAN KAMAR</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kelas</th>
                                    <th width="15%">Kapasitas</th>
                                    <th width="15%">Terpakai</th>
                                    <th width="15%">Sisa</th>
                                </tr>
                            </thead>
                            <tbody id="data-kamar">
                                <!-- Data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<script>
$(document).ready(function() {
    loadKamarData();

    // Refresh data every 30 seconds
    setInterval(function() {
        loadKamarData();
    }, 30000);
});

function loadKamarData() {
    $.ajax({
        url: '<?= base_url('home/json_data_kamar') ?>',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var html = '';
            $.each(response, function(index, item) {
                var sisaClass = '';
                if (item.sisa <= 0) {
                    sisaClass = 'text-danger';
                }
                html += '<tr>';
                html += '<td>' + item.no + '</td>';
                html += '<td>' + item.kelas + '</td>';
                html += '<td class="text-center">' + item.kapasitas + '</td>';
                html += '<td class="text-center">' + item.terpakai + '</td>';
                html += '<td class="text-center ' + sisaClass + '">' + item.sisa + '</td>';
                html += '</tr>';
            });
            $('#data-kamar').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error loading data:', error);
        }
    });
}
</script>
<?= $this->endSection() ?>