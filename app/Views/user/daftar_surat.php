<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('msg-surat')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('msg-surat'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<h2 class="my-5 fw-bold">Daftar Surat</h2>
<!-- Table  -->
<table id="example" class="display" style="width:100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Surat</th>
            <th>Tanggal</th>
            <th>Jenis Surat</th>
            <th>Perihal</th>
            <th>Status</th>
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
                <td><?= $srt['jenis_surat']; ?></td>
                <td><?= $srt['perihal']; ?></td>
                <td class="<?php
                            switch ($srt['status']) {
                                case 'Pending':
                                    echo 'bg-warning';
                                    break;
                                case 'Proses':
                                    echo 'bg-primary';
                                    break;
                                case 'Download':
                                    echo 'bg-success';
                                    break;
                                case 'Revisi':
                                    echo 'bg-danger';
                                    break;
                                default:
                                    echo '';
                                    break;
                            }
                            ?>">
                    <?php
                    switch ($srt['status']) {
                        case 'Pending':
                            echo $srt['status'];
                            break;
                        case 'Proses':
                            echo $srt['status'];
                            break;
                        case 'Download':
                            echo '<a href="' . site_url('admin/download/' . $srt['lampiran']) . '" style="color: black;">' . $srt['status'] . '</a>';
                            break;
                        case 'Revisi':
                            echo $srt['status'] . ' <a href="' . site_url('user/revisi/' . $srt['id_merged']) . '"><box-icon type="solid" name="message-square-dots"></box-icon></a>';
                            break;
                        default:
                            echo '';
                            break;
                    }
                    ?>
                </td>


            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="scripts.js"></script>

<?= $this->endSection(); ?>