<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<h2 class="my-5 fw-bold">Data Permohonan Tanda Tangan</h2>
<!-- Table  -->
<table id="example" class="display" style="width:100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>No Surat</th>
            <th>Tanggal</th>
            <th>Jabatan</th>
            <th>Tujuan</th>
            <th>Perihal</th>
            <th>Sifat</th>
            <th>Download</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data -->
        <?php $i = 1; ?>
        <?php foreach ($surat as $srt) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $srt['kode_surat']; ?></td>
            <td><?= $srt['tanggal']; ?></td>
            <td>Dekanat</td>
            <td><?= $srt['tujuan']; ?></td>
            <td><?= $srt['perihal']; ?></td>
            <td class="<?php 
                switch($srt['sifat']) {
                    case 'Urgent':
                        echo 'bg-danger';
                        break;
                    case 'Not Urgent':
                        echo 'bg-success';
                        break;
                    default:
                        echo '';
                        break;
                }
            ?>"><?= $srt['sifat']; ?></td>
           <td class="text-center"><a href="<?= site_url('admin/download/' . $srt['lampiran']); ?>" class="btn btn-warning"><box-icon type='solid' name='cloud-download'></box-icon></a></td>
            <td style="width: 60px;">
                <a href="<?= base_url(); ?>admin/detail_permohonan_ttd/<?= $srt['id_permohonan']; ?>"><box-icon name='detail'></box-icon></a>
                <a href="<?= base_url(); ?>d/approved_permohonan_ttd/<?= $srt['id_permohonan']; ?>"><box-icon name='check'></box-icon></a>
            </td>
        </tr>
       <?php endforeach; ?>
    </tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="scripts.js"></script>

<?= $this->endSection(); ?>