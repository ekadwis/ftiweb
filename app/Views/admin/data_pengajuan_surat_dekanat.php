<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('msg-success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('msg-success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<h2 class="my-5 fw-bold">Data Pengajuan Surat Dekanat</h2>
<!-- Table  -->
<table id="example" class="display" style="width:100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jabatan</th>
            <th>Perihal</th>
            <th>Sifat</th>
            <th>File</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data -->
        <?php $i = 1; ?>
        <?php foreach ($surat as $srt) : ?>
            <tr class="fs-6">
                <td><?= $i++; ?></td>
                <td><?= $srt['tanggal']; ?></td>
                <td><?= $srt['username']; ?></td>
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
                <td><a href="<?= site_url('admin/download/' . $srt['lampiran']); ?>" class="btn btn-warning"><box-icon type='solid' name='cloud-download'></box-icon></a></td>
                <td style="width: 100px;">
                <a href="<?= base_url(); ?>admin/detail_pengajuan_surat/<?= $srt['id_surat']; ?>"><box-icon name='detail'></box-icon></a>
                <a href="<?= base_url(); ?>admin/approved_pengajuan_surat/<?= $srt['id_surat']; ?>"><box-icon name='check'></box-icon></a>
                <a href="<?= base_url(); ?>admin/revisi_pengajuan_surat/<?= $srt['id_surat']; ?>"><box-icon name='x'></box-icon></a></td>
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