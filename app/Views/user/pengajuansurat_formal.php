<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('msg-failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('msg-failed'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container">
    <form action="<?= base_url(); ?>user/submit_pengajuansurat_formal" method="POST" enctype="multipart/form-data" class="m-4 p-5 border border-dark">
    <?= csrf_field(); ?>
        <h2>Pengajuan Surat Formal</h2>
        <div class="form-group mt-4">
            <label>Tujuan</label>
            <input class="form-control" type="text" name="tujuan" required>
        </div>
        <div class="form-group mt-4">
            <label>Perihal</label>
            <input class="form-control" type="text" name="perihal" required>
        </div>
        <div class="form-group mt-3">
            <label>Dosen</label>
            <select class="form-control form-control-sm" name="dosen" required>
                <?php foreach ($dosen as $d) : ?>
                    <option value="<?= $d['id_dosen']; ?>"><?= $d['nama_dosen']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="kegiatan_keperluan" class="form-label">Keperluan</label>
            <textarea class="form-control" id="kegiatan_keperluan" rows="3" name="kegiatan_keperluan" required></textarea>
        </div>
        <div class="form-group mt-3">
            <label>Tanggal</label>
            <div class="row">
                <div class="col">
                    <input type="date" class="form-control" name="periode_awal" required>
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="periode_akhir" required>
                </div>
            </div>
        </div>
        <div class="form-group mt-3">
            <label for="tembusanTextArea" class="form-label">Tembusan</label>
            <textarea class="form-control" id="tembusanTextArea" rows="3" name="tembusan" required></textarea>
        </div>
        <div class="form-group mt-3">
            <label>Sifat</label>
            <select class="form-control form-control-sm" name="sifat" required>
                <option value="Urgent" selected>Urgent</option>
                <option value="Not Urgent">Not Urgent</option>
            </select>
        </div>
        <div class="form-group my-3">
            <label for="formFile" class="form-label">Unggah Lampiran</label>
            <input class="form-control" type="file" id="formFile" name="lampiran" required>
        </div>

        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
</div>

<?= $this->endSection(); ?>