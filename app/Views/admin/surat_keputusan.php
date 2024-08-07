<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<div class="container">
    <form class="m-4 p-5 border border-dark">
        <h2>Surat Keputusan</h2>
        <div class="form-group mt-4">
            <label>Nama Surat</label>
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
                <option selected>Sistem Informasi</option>
                <option>2</option>
                <option>3</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label>Nama</label>
            <input class="form-control" type="text">
        </div>
        <div class="form-group mt-3">
            <label>NIK</label>
            <input class="form-control" type="text">
        </div>
        <div class="form-group mt-3">
            <a href="#" class="d-flex">
            <box-icon name='plus' ></box-icon>
            Tambah dosen baru
            </a>
        </div>
        <div class="form-group mt-3">
            <label>Kegiatan</label>
            <input class="form-control" type="text">
        </div>
        <div class="form-group mt-3">
            <label>Periode</label>
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
            <label for="exampleFormControlFile1">Unggah Lampiran</label><br>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
    </form>
</div>

<?= $this->endSection(); ?>