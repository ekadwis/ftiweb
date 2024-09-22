<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<form action="<?= base_url(); ?>admin/savedosen" method="POST" class="w-75" enctype="multipart/form-data">

    <?= csrf_field(); ?>
    <h2 class="mb-4">Edit Dosen</h2>
    <input type="hidden" value="<?= $result['id_dosen']; ?>" name="id_dosen">
    <div class="mb-3">
        <label for="nama_barang" class="form-label">Nama Dosen</label>
        <input type="text" class="form-control" id="nama_dosen" aria-describedby="emailHelp" name="nama_dosen" value="<?= $result['nama_dosen'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Nik Dosen</label>
        <input type="text" class="form-control" id="nik_dosen" aria-describedby="emailHelp" name="nik_dosen" value="<?= $result['nik_dosen'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="kategori" class="form-label">Prodi</label>
        <input type="text" class="form-control" id="prodi_dosen" aria-describedby="emailHelp" name="prodi_dosen" value="<?= $result['prodi_dosen'] ?>" required>
    </div>
    <div class="modal-footer">
        <a class="btn btn-secondary me-4" href="<?= base_url(); ?>admin/daftardosen">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>


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