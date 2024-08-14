<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>

<h1 class="mt-3">Pengajuan Surat</h1>

<div class="row mt-5">
    <div class="col-md-4">
        <div class="card" style="width: 18rem; background-color: #D9D9D9">
            <div class="card-body">
                <div class="text-center">
                    <box-icon type='solid' name='envelope' class="fs-1" size="lg"></box-icon>
                    <p class="card-text">Surat Keputusan</p>
                    <a href="<?= base_url(); ?>user/pengajuansurat_keputusan" class="btn btn-secondary">Buat baru</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card" style="width: 18rem; background-color: #D9D9D9">
            <div class="card-body">
                <div class="text-center">
                    <box-icon type='solid' name='envelope' class="fs-1" size="lg"></box-icon>
                    <p class="card-text">Surat Tugas</p>
                    <a href="<?= base_url(); ?>user/pengajuansurat_tugas" class="btn btn-secondary">Buat baru</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card" style="width: 18rem; background-color: #D9D9D9">
            <div class="card-body">
                <div class="text-center">
                    <box-icon type='solid' name='envelope' class="fs-1" size="lg"></box-icon>
                    <p class="card-text">Surat Formal</p>
                    <a href="<?= base_url(); ?>user/pengajuansurat_formal" class="btn btn-secondary">Buat baru</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>