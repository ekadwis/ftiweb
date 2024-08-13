<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<div class="container">
    <form class="m-4 p-5 border border-dark">
        <h2>Detail Pengajuan Surat Dekanat</h2>
        <div class="form-group mt-4">
            <label>Tujuan Surat</label>
            <input class="form-control" type="text" value="<?= $result['tujuan']; ?>" disabled>
        </div>
        <div class="form-group mt-3">
            <label>Perihal</label>
            <input class="form-control" type="text" value="<?= $result['perihal']; ?>" disabled>
        </div>
        <div class="form-group mt-3">
            <label>Kegiatan</label>
            <input class="form-control" type="text" value="<?= $result['kegiatan_keperluan']; ?>" disabled>
        </div>
        <?php $i = 1; ?>
        <?php foreach ($listDosen as $dosen) : ?>
            <div class="form-group mt-3">
                <label>Nama Dosen <?= $i; ?></label>
                <input class="form-control" type="text" value="<?= $dosen['nama_dosen']; ?>" disabled>

                <div class="form-group mt-3">   
                    <div class="row">
                        <div class="col">
                            <label>Nik Dosen <?= $i; ?></label>
                            <input type="number" class="form-control" value="<?= $result['nik_dosen']; ?>" disabled>
                        </div>
                        <div class="col">
                            <label>Prodi Dosen <?= $i; ?></label>
                            <input type="text" class="form-control" value="<?= $result['prodi']; ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="<?= $i++; ?>">
        <?php endforeach; ?>
        <div class="form-group mt-3">
            <label>Periode</label>
            <div class="row">
                <div class="col">
                    <input type="date" class="form-control" value="<?= $result['periode_awal']; ?>" disabled>
                </div>
                <div class="col">
                    <input type="date" class="form-control" value="<?= $result['periode_akhir']; ?>" disabled>
                </div>
            </div>
        </div>
        <div class="form-group mt-3">
            <label for="exampleFormControlTextarea1">Tembusan</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" value="<?= $result['tembusan']; ?>" disabled></textarea>
        </div>
        <div class="form-group my-3">
            <label for="exampleFormControlTextarea2">Catatan</label>
            <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" value="<?= $result['catatan']; ?>" disabled></textarea>
        </div>
        <a href="<?= base_url(); ?>admin/pengajuansurat" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection(); ?>