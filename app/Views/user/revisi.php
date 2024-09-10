<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>
<div class="form-group mt-3">
    <h2 class="mb-2">Revisi</h2>
    <textarea class="form-control w-75 mb-3" id="revisi" rows="6" name="revisi" disabled><?= $revisi; ?></textarea>
    <a href="<?= base_url(); ?>user/daftarsurat" class="btn btn-secondary">Kembali</a>
</div>
<?= $this->endSection(); ?>