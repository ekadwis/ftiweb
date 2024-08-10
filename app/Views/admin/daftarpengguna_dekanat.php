<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<h2 class="my-5 fw-bold">Data Pengguna Dekanat</h2>
<!-- Table  -->
<table id="example" class="display" style="width:100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Jabatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
       <!-- Data  -->
       <?php $i = 1; ?>
        <?php foreach ($users as $user) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $user['nama_user']; ?></td>
            <td><?= $user['nik_user']; ?></td>
            <td>Dekanat</td>
            <td><a href="<?= base_url(); ?>admin/deleteuser/<?= $user['user_id']; ?>"><box-icon type='solid' name='trash-alt'></box-icon></a></td>
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