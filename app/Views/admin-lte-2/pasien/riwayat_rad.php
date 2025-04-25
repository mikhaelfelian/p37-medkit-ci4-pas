<?php $this->extend('admin-lte-2/layout/main'); ?>

<?php $this->section('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Riwayat Pemeriksaan Radiologi</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-left">Tgl</th>
                                <th class="text-center">No. Dokumen</th>
                                <th class="text-center">No. Sample</th>
                                <th class="text-left">Radiografer</th>
                                <th class="text-left">Hasil Pemeriksaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($riwayat)): ?>
                                <?php $no = 1;
                                foreach ($riwayat as $row): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-left"><?= tgl_indo8($row->tgl_masuk) ?></td>
                                        <td class="text-center"><?= $row->no_rad ?? '-' ?></td>
                                        <td class="text-center"><?= $row->no_sample ?? '-' ?></td>
                                        <td class="text-left"><?= $row->radiografer ?></td>
                                        <td class="text-left"><?= (!empty($row->file_name) ? anchor($Pengaturan->url_app.'/'.$row->file_name, '<i class="fa fa-download"></i> Unduh', 'target="_blank" class="btn btn-xs btn-primary"')  : '<span class="label label-default">Tidak ada file</span>')?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
