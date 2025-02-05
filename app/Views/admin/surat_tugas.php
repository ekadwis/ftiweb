<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<div class="container">
    <form action="<?= base_url(); ?>admin/surat_masuk_tugas" method="POST" class="m-4 p-5 border border-dark" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <h2>Surat Tugas</h2>
        <div class="form-group mt-4">
            <label>Nomor Surat</label>
            <input class="form-control" type="text" name="kode_surat" required>
        </div>
        <div class="form-group mt-3">
            <label>Perihal</label>
            <select class="form-control form-control-sm" name="perihal" required>
                <option value="">Pilih Perihal</option>
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
        <div class="my-5"></div>
        <!-- Tambahkan kontainer untuk Jenis Publikasi -->
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

        <div id="keputusanContainer" class="form-group mt-3">
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
       
        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
    </form>

    <script>
        // Data dosen dari server ke JavaScript
        const dosenData = <?= json_encode($dosen); ?>;
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let dosenCount = 0;

            // Menangani perubahan pada select perihal
            document.querySelector('select[name="perihal"]').addEventListener('change', function() {
                let perihal = this.value.toLowerCase();
                const jenisPublikasiContainer = document.getElementById('jenisPublikasiContainer');

                if (perihal.includes("pengabdian") || perihal.includes("penelitian")) {
                    jenisPublikasiContainer.style.display = 'block'; // Tampilkan kontainer
                } else {
                    jenisPublikasiContainer.style.display = 'none'; // Sembunyikan kontainer
                }
            });

            // Saat tombol tambah dosen diklik
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

                let perihal = document.querySelector('select[name="perihal"]').value.toLowerCase();

                if (perihal.includes("pengabdian") || perihal.includes("penelitian") || perihal.includes("penunjang")) {
                    // Jika perihal mengandung kata pengabdian, penelitian, atau penunjang, input type hidden
                    dosenHtml += `
                        <input type="hidden" name="jumlah_matkul${dosenCount}" value="1" id="matkulGroup${dosenCount}">
                    `;
                } else {
                    // Jika tidak, tampilkan input jumlah matkul biasa
                    dosenHtml += `
                    <div class="form-group mt-3" id="matkulGroup${dosenCount}">
                        <label>Jumlah Matkul ${dosenCount}</label>
                        <input class="form-control" type="text" name="jumlah_matkul${dosenCount}" required>
                    </div>
                    `;
                }

                document.getElementById('dosenContainer').insertAdjacentHTML('beforeend', dosenHtml);
            });
        });

        // Fungsi untuk menghapus dosen yang ditambahkan
        function hapusDosen(dosenId) {
            let dosenGroup = document.getElementById(`dosenGroup${dosenId}`);
            let matkulGroup = document.getElementById(`matkulGroup${dosenId}`);
            dosenGroup.remove();
            if (matkulGroup) matkulGroup.remove();
        }
    </script>

</div>

<?= $this->endSection(); ?>
