<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>

<div class="container">
    <form class="m-4 p-5 border border-dark">
        <h2>Pengajuan Surat Formal</h2>
        <div class="form-group mt-4">
            <label>Tujuan</label>
            <input class="form-control" type="text">
        </div>
        <div class="form-group mt-3">
            <label>Perihal</label>
            <select class="form-control form-control-sm">
                <option selected>Pengajaran</option>
                <option>2</option>
                <option>3</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label>Prodi</label>
            <select class="form-control form-control-sm">
                <option selected>Informatika</option>
                <option>2</option>
                <option>3</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label>Nama</label>
            <select class="form-control form-control-sm">
                <option selected>Gloria Virginia, S.Kom</option>
                <option>2</option>
                <option>3</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label>NIK</label>
            <input class="form-control" type="number">
        </div>
        <div class="form-group mt-3">
            <label for="keperluanTextArea" class="form-label">Keperluan</label>
            <textarea class="form-control" id="keperluanTextArea" rows="3"></textarea>
        </div>
        <div class="form-group mt-3">
            <label>Tanggal</label>
            <div class="row">
                <div class="col">
                    <input type="date" class="form-control">
                </div>
                <div class="col">
                    <input type="date" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group mt-3">
            <label for="tembusanTextArea" class="form-label">Tembusan</label>
            <textarea class="form-control" id="tembusanTextArea" rows="3"></textarea>
        </div>
        <div class="form-group mt-3">
            <label>Sifat</label>
            <select class="form-control form-control-sm">
                <option selected>Urgent</option>
                <option>2</option>
                <option>3</option>
            </select>
        </div>
        <div class="form-group my-3">
            <label for="formFile" class="form-label">Unggah Lampiran (optional)</label>
            <input class="form-control" type="file" id="formFile">
        </div>

        <button type="button" class="btn btn-secondary">Submit</button>
    </form>
</div>

<?= $this->endSection(); ?>