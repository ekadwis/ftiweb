<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<div class="container">
    <form class="m-4 p-5 border border-dark">
        <h2>Detail Pengajuan Surat Dekanat</h2>
        <div class="form-group mt-3">
            <label>Perihal</label>
            <input class="form-control" type="text" value="<?= $result['perihal']; ?>" disabled>
        </div>
        <?php $i = 1; ?>
        <?php foreach ($listDosen as $dosen) : ?>
            <?php if ($dosen['nama_dosen'] != "") : ?>
                <div class="form-group mt-3">
                    <label>Nama Dosen <?= $i; ?></label>
                    <input class="form-control" type="text" value="<?= $dosen['nama_dosen']; ?>" disabled>

                    <div class="form-group mt-3">
                        <div class="row">
                            <div class="col">
                                <label>Nik Dosen <?= $i; ?></label>
                                <input type="text" class="form-control" value="<?= $dosen['nik_dosen']; ?>" disabled>
                            </div>
                            <div class="col">
                                <label>Prodi Dosen <?= $i; ?></label>
                                <input type="text" class="form-control" value="<?= $dosen['prodi']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <input type="hidden" value="<?= $i++; ?>">
        <?php endforeach; ?>
        <div class="my-5"></div>
        <?php if ($result['jenis_publikasi'] != "") : ?>
            <div class="form-group mt-3">
                <label>Jenis Publikasi</label>
                <input class="form-control" type="text" value="<?= $result['jenis_publikasi']; ?>" disabled>
            </div>
        <?php endif; ?>
        <?php if ($result['keputusan'] != "") : ?>
            <div class="form-group mt-3">
                <label>Keputusan</label>
                <input class="form-control" type="text" value="<?= $result['keputusan']; ?>" disabled>
            </div>
        <?php endif; ?>
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
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" value="<?= $result['tembusan']; ?>" disabled><?= $result['tembusan']; ?></textarea>
        </div>
        <div class="form-group my-3">
            <label for="exampleFormControlTextarea2">Catatan</label>
            <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" value="<?= $result['catatan']; ?>" disabled><?= $result['catatan']; ?></textarea>
        </div>
        <a href="<?= base_url(); ?>admin/pengajuansurat" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection(); ?>