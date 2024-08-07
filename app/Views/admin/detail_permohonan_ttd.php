<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<div class="container">
    <form class="m-4 p-5 border border-dark">
        <h2>Detail Permohonan TTD</h2>
        <div class="form-group mt-4">
            <label>Tujuan Surat</label>
            <input class="form-control" type="text">
        </div>
        <div class="form-group mt-3">
            <label>Perihal</label>
            <input class="form-control" type="text">
        </div>
        <div class="form-group mt-3">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Jenis Surat</label>
                        <select class="form-control form-control-sm">
                            <option selected>Surat tugas</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label>No Urut Surat</label>
                    <input type="text" class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label>Kode Surat</label>
                    <input type="text" class="form-control form-control-sm">
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Jenis Surat</label>
                        <select class="form-control form-control-sm">
                            <option selected>Surat tugas</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label>Tahun</label>
                    <input type="text" class="form-control form-control-sm">
                </div>
            </div>
        </div>
        <div class="form-group mt-3">
            <label>Nama (1)</label>
            <input class="form-control" type="text">
        </div>
        <div class="form-group mt-3">
            <label>NIK (1)</label>
            <input class="form-control" type="text">
        </div>
        <div class="form-group mt-3">
            <label>Prodi (1)</label>
            <input class="form-control" type="text">
        </div>
        <div class="form-group mt-3">
            <label>Nama (2)</label>
            <input class="form-control" type="text">
        </div>
        <div class="form-group mt-3">
            <label>NIK (2)</label>
            <input class="form-control" type="text">
        </div>
        <div class="form-group mt-3">
            <label>Prodi (2)</label>
            <input class="form-control" type="text">
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
            <label for="exampleFormControlTextarea1">Tembusan</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="exampleFormControlTextarea2">Catatan</label>
            <textarea class="form-control" id="exampleFormControlTextarea2" rows="3"></textarea>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>