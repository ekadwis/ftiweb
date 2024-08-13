<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<div class="container">
    <form action="<?= base_url(); ?>admin/submit_revisi_pengajuan_surat" method="POST" class="border border-dark rounded px-4 pb-4 mt-4" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <h2 class="my-3">Revisi Surat <?= $kode_surat[0]; ?></h2>
        <input type="hidden" name="kode_surat" value="<?= $kode_surat[0]; ?>">
        <div class="form-group mt-3">
            <label for="exampleFormControlTextarea1">Masukan pesan/alasan Revisi :</label>
            <textarea class="form-control mt-2" id="exampleFormControlTextarea1" rows="3" name="revisi"></textarea>
            <button type="submit" class="btn btn-secondary mt-3">Kirim</button>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>