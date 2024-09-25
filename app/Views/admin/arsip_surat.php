<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<div class="container pt-4">
    <?php if (session()->getFlashdata('msg')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('msg'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<?php if (session()->getFlashdata('msg-success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('msg-success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<h2 class="my-5 fw-bold">Data Arsip Surat</h2>
<!-- Table  -->
<table id="example" class="display" style="width:100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Jenis Surat</th>
            <th>Kode Surat</th>
            <th>Perihal</th>
            <th>Keputusan</th>
            <th>Nama Dosen</th>
            <th>Prodi</th>
            <th>Periode</th>
            <th>Pembuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
       <!-- Data -->
       <?php $i = 1; ?>
        <?php foreach ($surat as $srt) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $srt['jenis_surat']; ?></td>
            <td><?= $srt['kode_surat']; ?></td>
            <td><?= $srt['perihal']; ?></td>
            <td><?= $srt['keputusan']; ?></td>
            <td><?= $srt['nama_dosen']; ?></td>
            <td><?= $srt['prodi']; ?></td>
            <td><?= $srt['periode_awal']; ?> s.d <?= $srt['periode_akhir']; ?></td>
            <td><?= $srt['author']; ?></td>
            <td class="text-center"><a href="<?= site_url('admin/download/' . $srt['lampiran']); ?>" class="btn btn-warning"><box-icon type='solid' name='cloud-download'></box-icon></a></td>
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