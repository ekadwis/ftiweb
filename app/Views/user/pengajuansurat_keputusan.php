<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('msg-failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('msg-failed'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container">
    <form action="<?= base_url(); ?>user/submit_pengajuansurat_keputusan" method="POST" enctype="multipart/form-data" class="m-4 p-5 border border-dark">
        <?= csrf_field(); ?>
        <h2>Pengajuan Surat Keputusan</h2>
        <div class="form-group mt-3">
            <label>Perihal</label>
            <select class="form-control form-control-sm" id="perihalSelect" name="perihal" required>
                <option value="Pengajaran" selected>Pengajaran</option>
            </select>
        </div>

        <!-- Field lainnya yang sudah ada -->
        <div class="form-group mt-3">
            <a href="#" id="tambahDosen" class="btn btn-success w-25"><box-icon name='plus' color='#ffffff'></box-icon> Tambah Dosen</a>
        </div>
        <div id="dosenContainer">
            <!-- Tempat untuk menambahkan dosen baru -->
        </div>
        <div class="my-5"></div>
        <!-- Tambahan field untuk jenis publikasi dan keputusan -->
        <div id="jenisPublikasiContainer" class="form-group mt-3" style="display: none;">
            <label>Jenis Publikasi</label>
            <select class="form-control form-control-sm" name="jenis_publikasi">
                <option value="">Pilih Jenis Publikasi</option>
                <option value="Jurnal">Jurnal</option>
                <option value="Prosiding">Prosiding</option>
                <option value="HKI">HKI</option>
                <option value="Paten">Paten</option>
                <option value="Buku Ajar">Buku Ajar</option>
                <option value="Buku Chapter">Buku Chapter</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div id="keputusanContainer" class="form-group mt-3" style="display: none;">
            <label>Keputusan</label>
            <input class="form-control" type="text" name="keputusan">
        </div>
        <div class="form-group mt-3">
            <label>Periode</label>
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
            <label>Sifat</label>
            <select class="form-control form-control-sm" name="sifat" required>
                <option value="Urgent" selected>Urgent</option>
                <option value="Not Urgent">Not Urgent</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="tembusanTextArea" class="form-label">Tembusan</label>
            <textarea class="form-control" id="tembusanTextArea" rows="3" name="tembusan" required></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="catatanTextArea" class="form-label">Catatan</label>
            <textarea class="form-control" id="catatanTextArea" rows="3" name="catatan" required></textarea>
        </div>
        <div class="form-group my-3">
            <label for="formFile" class="form-label">Unggah Lampiran</label>
            <input class="form-control" type="file" id="formFile" name="lampiran" required>
        </div>

        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const perihalSelect = document.getElementById("perihalSelect");
            const jenisPublikasiContainer = document.getElementById("jenisPublikasiContainer");
            const keputusanContainer = document.getElementById("keputusanContainer");
            const tambahDosenButton = document.getElementById("tambahDosen");

            // Event listener untuk dropdown Perihal
            perihalSelect.addEventListener("change", function() {
                const selectedValue = perihalSelect.value;

                // Jika perihal Pengabdian atau Penelitian, tampilkan jenis publikasi dan keputusan
                if (selectedValue.includes("Pengabdian") || selectedValue.includes("Penelitian")) {
                    jenisPublikasiContainer.style.display = "block";
                    keputusanContainer.style.display = "block";
                } 
                // Jika perihal Pengajaran, hanya tampilkan keputusan
                else if (selectedValue === "Pengajaran")  {
                    jenisPublikasiContainer.style.display = "none";
                    keputusanContainer.style.display = "block";
                } else if (selectedValue === "Penunjang")  {
                    jenisPublikasiContainer.style.display = "none";
                    keputusanContainer.style.display = "block";
                } 
                // Jika perihal lain, sembunyikan semuanya
                else {
                    jenisPublikasiContainer.style.display = "none";
                    keputusanContainer.style.display = "none";
                }

                // Sembunyikan tombol "Tambah Dosen" jika Perihal adalah "Pengajaran"
                if (selectedValue === "Pengajaran") {
                    tambahDosenButton.style.display = "none";
                } else {
                    tambahDosenButton.style.display = "block";
                }
            });

            // Memicu event change di awal agar tombol sesuai dengan nilai default
            perihalSelect.dispatchEvent(new Event('change'));
        });

        // Data dosen dari server ke JavaScript
        const dosenData = <?= json_encode($dosen); ?>;

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
