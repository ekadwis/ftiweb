<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>

<h1>Dashboard</h1>

<div class="row mt-5">
    <div class="col-md-4">
        <div class="card bg-secondary" style="width: 18rem;">
            <div class="card-body">
                <div class="text-center">
                    <box-icon type='solid' name='envelope' class="fs-1" size="lg"></box-icon>
                    <p class="card-text">Surat Keputusan</p>
                    <a href="#" class="btn btn-primary">Buat baru</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-secondary" style="width: 18rem;">
            <div class="card-body">
                <div class="text-center">
                    <box-icon type='solid' name='envelope' class="fs-1" size="lg"></box-icon>
                    <p class="card-text">Surat Tugas</p>
                    <a href="#" class="btn btn-primary">Buat baru</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-secondary" style="width: 18rem;">
            <div class="card-body">
                <div class="text-center">
                    <box-icon type='solid' name='envelope' class="fs-1" size="lg"></box-icon>
                    <p class="card-text">Surat Formal</p>
                    <a href="#" class="btn btn-primary">Buat baru</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>