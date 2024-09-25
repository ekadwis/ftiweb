<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<div class="container">
    <form action="<?= base_url(); ?>admin/edit_permohonan_ttd" method="POST" class="m-4 p-5 border border-dark" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <h2>Detail Permohonan TTD</h2>
        <input type="hidden" value="<?= $result['id_permohonan']; ?>" name="id_permohonan">
        <div class="form-group mt-3">
            <label>Perihal</label>
            <input class="form-control" type="text" name="perihal" value="<?= $result['perihal']; ?>" disabled>
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
                            <option value="FTI" selected>Fakultas Teknologi Informasi</option>
                            <option value="FTI-SI">Fakultas Teknologi Informasi - Sistem Informas</option>
                            <option value="FTI-I">Fakultas Teknologi Informasi - Informasi</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label>Tahun</label>
                    <input type="number" class="form-control form-control-sm" name="tahun">
                </div>
            </div>
        </div>
        <?php if (!($result['perihal'] == "Pengajaran" && $result['jenis_surat'] == "Surat Keputusan")) : ?>
            <?php $i = 1; ?>
            <?php foreach ($listDosen as $dosen) : ?>
                <div class="form-group mt-3">
                    <label>Nama Dosen <?= $i; ?></label>
                    <input class="form-control" type="text" value="<?= $dosen['nama_dosen']; ?>" disabled>

                    <div class="form-group mt-3">
                        <div class="row">
                            <div class="col">
                                <label>Nik Dosen <?= $i; ?></label>
                                <input type="number" class="form-control" value="<?= $dosen['nik_dosen']; ?>" disabled>
                            </div>
                            <div class="col">
                                <label>Prodi Dosen <?= $i; ?></label>
                                <input type="text" class="form-control" value="<?= $dosen['prodi']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?= $i++; ?>">
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($result['perihal'] == "Pengajaran" && $result['jenis_surat'] == "Surat Keputusan") : ?>
            <!-- Field lainnya yang sudah ada -->
            <div class="form-group mt-3">
                <a href="#" id="tambahDosen" class="btn btn-success"><box-icon name='plus' color='#ffffff'></box-icon> Tambah Dosen</a>
            </div>
            <div id="dosenContainer">
                <!-- Tempat untuk menambahkan dosen baru -->
            </div>
        <?php endif; ?>
        <div class="form-group mt-3">
            <label>Keputusan</label>
            <input class="form-control" type="text" value="<?= $result['keputusan']; ?>" disabled>
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
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" value="<?= $result['tembusan']; ?>" disabled><?= $result['tembusan']; ?></textarea>
        </div>
        <div class="form-group my-3">
            <label for="exampleFormControlTextarea2">Catatan</label>
            <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" value="<?= $result['catatan']; ?>" disabled><?= $result['catatan']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-secondary">Simpan</button>
    </form>
</div>

<script>
    // Data dosen dari server ke JavaScript
    const dosenData = <?= json_encode($dosens); ?>;

    document.addEventListener("DOMContentLoaded", function() {
        let dosenCount = 0;

        document.getElementById('tambahDosen').addEventListener('click', function(e) {
            e.preventDefault();
            dosenCount++;

            let optionsHtml = dosenData.map(d =>
                `<option value="${d.id_dosen}">${d.nama_dosen}</option>`
            ).join('');

            let dosenHtml = `
                <div class="form-group mt-3" id="dosenGroup${dosenCount}">
                    <div class="d-flex justify-content-between">
                        <label>Dosen ${dosenCount}</label>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusDosen(${dosenCount})">Hapus</button>
                    </div>
                    <select class="form-control form-control-sm" name="dosen${dosenCount}" required>
                        <option value="">Pilih Dosen</option>
                        ${optionsHtml}
                    </select>
                    <div class="mt-2">
                        <label>Jumlah Matkul</label>
                        <input type="number" class="form-control form-control-sm" name="jumlah_matkul${dosenCount}" required>
                    </div>
                </div>
            `;

            document.getElementById('dosenContainer').insertAdjacentHTML('beforeend', dosenHtml);
        });
    });

    function hapusDosen(dosenId) {
        let dosenGroup = document.getElementById(`dosenGroup${dosenId}`);
        dosenGroup.remove();
    }
</script>


<?= $this->endSection(); ?>