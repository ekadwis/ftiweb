<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<h1 class="mt-3">Dashboard Surat</h1>

<div class="row mt-5">
    <div class="col-md-4">
        <div class="card" style="width: 18rem; background-color: #D9D9D9;">
            <div class="card-body">
               <div class="d-inline-flex flex-row">
                <box-icon type='solid' name='envelope' class="mt-3" size="lg"></box-icon>
                <div class="text-center ps-4">
                    <h2><?= $total_surat; ?></h2>
                    <h5>Pengajuan Surat</h5>
                </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    <div class="card" style="width: 18rem; background-color: #D9D9D9;">
            <div class="card-body">
               <div class="d-inline-flex flex-row">
                <box-icon name='task' class="mt-3" size="lg"></box-icon>
                <div class="text-center ps-4">
                    <h2><?= $total_permohonan_ttd; ?></h2>
                    <h5>Permohonan TTD</h5>
                </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    <div class="card" style="width: 18rem; background-color: #D9D9D9;">
            <div class="card-body">
               <div class="d-inline-flex flex-row">
                <box-icon type='solid' name='archive' class="mt-3" size="lg"></box-icon>
                <div class="text-center ps-4">
                    <h2><?= $total_arsip; ?></h2>
                    <h5>Arsip Surat</h5>
                </div>
               </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>