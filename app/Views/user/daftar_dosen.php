<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('msg-dosen')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('msg-dosen'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col">
        <h2 class="my-5 fw-bold">Daftar Dosen</h2>
    </div>
    <div class="col mt-5">
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Dosen
        </button>
    </div>
</div>

<!-- Tambah Data Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukan data Dosen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>user/tambahdosen" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <label for="nama_dosen" class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" id="nama_dosen" aria-describedby="emailHelp" name="nama_dosen" placeholder="Masukan nama dosen" required>
                    </div>
                    <div class="mb-3">
                        <label for="nik_dosen" class="form-label">Nik Dosen</label>
                        <input type="number" class="form-control" id="nik_dosen" aria-describedby="emailHelp" name="nik_dosen" placeholder="Masukan nik dosen" required>
                    </div>
                    <div class="mb-3">
                        <label for="prodi_dosen" class="form-label">Prodi</label>
                        <input type="text" class="form-control" id="prodi_dosen" aria-describedby="emailHelp" name="prodi_dosen" placeholder="Masukan prodi" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Table  -->
<table id="example" class="display" style="width:100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Dosen</th>
            <th>NIK</th>
            <th>Prodi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data -->
        <?php $i = 1; ?>
        <?php foreach ($dosen as $dsn) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $dsn['nama_dosen']; ?></td>
                <td><?= $dsn['nik_dosen']; ?></td>
                <td><?= $dsn['prodi_dosen']; ?></td>
                <td>
                    <a href="<?= base_url(); ?>user/editdosen/<?= $dsn['id_dosen']; ?>"><i class="fas fa-edit text-dark"></i></a>
                    <a href="<?= base_url(); ?>user/deletedosen/<?= $dsn['id_dosen']; ?>"><i class="fas fa-trash text-danger"></i></a>
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