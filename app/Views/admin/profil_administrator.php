<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('msg-success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('msg-success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container">

    <div class="d-flex justify-content-between mt-3">
        <h2>Profil Administrator</h2>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ubah Profil
        </button>

        <!-- Tambah Data Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Profile <?= user()->nama_user; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/ubahprofile" method="POST" enctype="multipart/form-data">
                            
                            <input type="hidden" class="form-control" id="id" aria-describedby="emailHelp" name="id" value="<?= user()->id; ?>">
                            
                            <div class="mb-3">
                                <label for="nama_user" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_user" aria-describedby="emailHelp" name="nama_user" value="<?= user()->nama_user; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="<?= user()->email; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="telp_user" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="telp_user" aria-describedby="emailHelp" name="telp_user" value="<?= user()->telp_user; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="jeniskelamin_user" class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control" id="jeniskelamin_user" aria-describedby="emailHelp" name="jeniskelamin_user" value="<?= user()->jeniskelamin_user; ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Ubah Profile</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="card border border-dark p-4 mt-5">
        <div class="card-body">
            <h5>Nama : <?= user()->nama_user; ?></h5>
            <h5 class="mt-3">Email : <?= user()->email; ?></h5>
            <h5 class="mt-3">No Telepon : <?= user()->telp_user; ?></h5>
            <h5 class="mt-3">Jenis Kelamin : <?= user()->jeniskelamin_user; ?></h5>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>