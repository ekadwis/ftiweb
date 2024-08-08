<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>

<div class="container">
    <form action="<?= base_url(); ?>user/submit_pengajuansurat_keputusan" method="POST" enctype="multipart/form-data" class="m-4 p-5 border border-dark">
        <?= csrf_field(); ?>
        <h2>Pengajuan Surat Keputusan</h2>
        <div class="form-group mt-4">
            <label>Tujuan</label>
            <input class="form-control" type="text" name="tujuan">
        </div>
        <div class="form-group mt-3">
            <label>Perihal</label>
            <select class="form-control form-control-sm" name="perihal">
                <option value="Pengajaran" selected>Pengajaran</option>
                <option value="Pengabdian">Pengabdian</option>
                <option value="Pengabdian (Publikasi) Tingkat Internal">Pengabdian (Publikasi) Tingkat Internal</option>
                <option value="Pengabdian (Publikasi) Tingkat Lokal">Pengabdian (Publikasi) Tingkat Lokal</option>
                <option value="Pengabdian (Publikasi) Tingkat Nasional">Pengabdian (Publikasi) Tingkat Nasional</option>
                <option value="Pengabdian (Publikasi) Tingkat Internasional">Pengabdian (Publikasi) Tingkat Internasional</option>
                <option value="Penelitian (Publikasi) Tingkat Internal">Penelitian (Publikasi) Tingkat Internal</option>
                <option value="Penelitian (Publikasi) Tingkat Lokal">Penelitian (Publikasi) Tingkat Lokal</option>
                <option value="Penelitian (Publikasi) Tingkat Nasional">Penelitian (Publikasi) Tingkat Nasional</option>
                <option value="Penelitian (Publikasi) Tingkat Internasional">Penelitian (Publikasi) Tingkat Internasional</option>
                <option value="Penunjang">Penunjang</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <a href="#" id="tambahDosen" class="btn btn-success"><box-icon name='plus' color='#ffffff'></box-icon> Tambah Dosen</a>
        </div>
        <div id="dosenContainer">
            <!-- Tempat untuk menambahkan dosen baru -->
        </div>
        <div class="form-group mt-3">
            <label>Keperluan Penugasan</label>
            <input class="form-control" type="text" name="kegiatan_keperluan">
        </div>
        <div class="form-group mt-3">
            <label>Periode</label>
            <div class="row">
                <div class="col">
                    <input type="date" class="form-control" name="periode_awal">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="periode_akhir">
                </div>
            </div>
        </div>
        <div class="form-group mt-3">
            <label>Sifat</label>
            <select class="form-control form-control-sm" name="sifat">
                <option value="Urgent" selected>Urgent</option>
                <option value="Not Urgent">Not Urgent</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="tembusanTextArea" class="form-label">Tembusan</label>
            <textarea class="form-control" id="tembusanTextArea" rows="3" name="tembusan"></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="catatanTextArea" class="form-label">Catatan</label>
            <textarea class="form-control" id="catatanTextArea" rows="3" name="catatan"></textarea>
        </div>
        <!-- <div class="form-group my-3">
            <label for="formFile" class="form-label">Unggah Lampiran</label>
            <input class="form-control" type="file" id="formFile" name="lampiran">
        </div> -->


        <button type="button" class="btn btn-secondary">Submit</button>
    </form>
    <script>
        // Data dosen dari server ke JavaScript
        const dosenData = <?= json_encode($dosen); ?>;
    </script>

    <script>
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
                    <select class="form-control form-control-sm" name="dosen${dosenCount}">
                        <option value="">Pilih Dosen</option>
                        ${optionsHtml}
                    </select>
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


</div>

<?= $this->endSection(); ?>