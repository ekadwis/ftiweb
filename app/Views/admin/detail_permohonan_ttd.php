<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<div class="container">
    <form action="<?= base_url(); ?>admin/edit_permohonan_ttd" method="POST" class="m-4 p-5 border border-dark" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <h2>Detail Permohonan TTD</h2>
        <input type="hidden" value="<?= $result['id_permohonan']; ?>" name="id_permohonan">
        <div class="form-group mt-4">
            <label>Tujuan Surat</label>
            <input class="form-control" type="text" value="<?= $result['tujuan']; ?>" disabled>
        </div>
        <div class="form-group mt-3">
            <label>Perihal</label>
            <input class="form-control" type="text" value="<?= $result['perihal']; ?>" disabled>
        </div>
        <div class="form-group mt-3">
            <div class="row">
                <?php if ($result['jenis_surat'] == "Surat Tugas" || $result['jenis_surat'] == "Surat Keputusan") : ?>
                    <div class="col">
                        <div class="form-group">
                            <input type="hidden" name="kode_surat" value="<?= $result['kode_surat']; ?>">
                            <label>Jenis Surat</label>
                            <select class="form-control form-control-sm" name="jenis_surat" readonly>
                                <option value="<?= $result['jenis_surat']; ?>"><?= $result['jenis_surat']; ?></option>
                            </select>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="col">
                        <div class="form-group">
                            <label>Jenis Surat</label>
                            <select class="form-control form-control-sm" name="jenis_surat">
                                <?php foreach ($kodeSurat as $ks) : ?>

                                    <option value="<?= $ks['jenis_surat']; ?>"><?= $ks['jenis_surat']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col">
                    <div class="form-group">
                        <label>Tingkat</label>
                        <select class="form-control form-control-sm" name="tingkat">
                            <option value="FTI" selected>FTI</option>
                            <option value="FTI-SI">FTI-SI</option>
                            <option value="FTI-I">FTI-I</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label>Tahun</label>
                    <input type="number" class="form-control form-control-sm" name="tahun">
                </div>
            </div>
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
            <label>Kegiatan</label>
            <input class="form-control" type="text" value="<?= $result['kegiatan_keperluan']; ?>" disabled>
        </div>
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

        <button type="submit" class="btn btn-secondary">Simpan</button>
    </form>
</div>

<?= $this->endSection(); ?>