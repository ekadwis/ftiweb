<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('msg-success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('msg-success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<h2 class="my-5 fw-bold">Data Permohonan Tanda Tangan</h2>

<!-- Modal Setuju -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadForm" method="post" enctype="multipart/form-data" action="<?= base_url('admin/approved_permohonan_ttd'); ?>">
                <div class="modal-body">
                    <input type="hidden" name="id_permohonan" id="id_permohonan" value="">
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">Choose file</label>
                        <input type="file" class="form-control" id="fileInput" name="lampiran" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Table -->
<table id="example" class="display" style="width:100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>No Surat</th>
            <th>Tanggal</th>
            <th>Jabatan</th>
            <th>Tujuan</th>
            <th>Perihal</th>
            <th>Sifat</th>
            <th>Download</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data -->
        <?php $i = 1; ?>
        <?php foreach ($surat as $srt) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $srt['kode_surat']; ?></td>
                <td><?= $srt['tanggal']; ?></td>
                <td><?= $srt['username']; ?></td>
                <td><?= $srt['tujuan']; ?></td>
                <td><?= $srt['perihal']; ?></td>
                <td class="<?php
                            switch ($srt['sifat']) {
                                case 'Urgent':
                                    echo 'bg-danger';
                                    break;
                                case 'Not Urgent':
                                    echo 'bg-success';
                                    break;
                                default:
                                    echo '';
                                    break;
                            }
                            ?>"><?= $srt['sifat']; ?></td>
                <td class="text-center">
                    <a href="<?= site_url('admin/download/' . $srt['lampiran']); ?>" class="btn btn-warning">
                        <box-icon type='solid' name='cloud-download'></box-icon>
                    </a>
                </td>
                <td style="width: 60px;">
                    <a href="<?= base_url(); ?>admin/detail_permohonan_ttd/<?= $srt['id_permohonan']; ?>">
                        <box-icon name='detail'></box-icon>
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="<?= $srt['id_permohonan']; ?>">
                        <box-icon name='check'></box-icon>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="scripts.js"></script>

<script>
    // Modal Trigger Script
    document.addEventListener('DOMContentLoaded', function() {
        var uploadModal = document.getElementById('uploadModal');
        uploadModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button yang memicu modal
            var idPermohonan = button.getAttribute('data-id'); // Ambil id_permohonan dari data-id

            var modal = bootstrap.Modal.getInstance(uploadModal);
            modal._element.querySelector('#id_permohonan').value = idPermohonan; // Set value id_permohonan ke input hidden
        });
    });
</script>

<?= $this->endSection(); ?>
