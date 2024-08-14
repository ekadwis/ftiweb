<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/auth.css">
</head>

<body>
    <div class="container">
        <!-- Content  -->
        <h2 class="text-center fw-bold mt-3"><?= lang('Auth.register') ?></h2>
        <?= view('Myth\Auth\Views\_message_block') ?>
        <form action="<?= url_to('register') ?>" method="post" enctype="multipart/form-data" class="m-auto mt-3 mb-5">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="username"><?= lang('Auth.username') ?></label>
                <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
            </div>
            <div class="mb-3">
                <label for="nama_user" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control <?php if (session('errors.nama_user')) : ?>is-invalid<?php endif ?>" name="nama_user" placeholder="Masukan nama lengkap" value="<?= old('nama_user') ?>">
            </div>
            <div class="mb-3">
                <label for="nik_user" class="form-label">NIK</label>
                <input type="number" class="form-control <?php if (session('errors.nik_user')) : ?>is-invalid<?php endif ?>" name="nik_user" placeholder="Masukan NIK" value="<?= old('nik_user') ?>">
            </div>
            <div class="mb-3">
                <label for="telp_user" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control <?php if (session('errors.telp_user')) : ?>is-invalid<?php endif ?>" name="telp_user" placeholder="Masukan nomor telepon" value="<?= old('telp_user') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-select" aria-label="Default select example" name="jeniskelamin_user">
                    <option value="laki-laki" selected>Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
            </div>
            <div class="mb-3">
                <label for="password"><?= lang('Auth.password') ?></label>
                <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="pass_confirm">Konfirmasi Password</label>
                <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="Konfirmasi Password" autocomplete="off">
            </div>
            <!-- <div class="mb-3">
                <label class="form-label">No Telepon</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis kelamin</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Pria</option>
                    <option value="1">Wanita</option>
                </select>
            </div> -->

            <button type="submit" class="btn btn-primary btn-block float-end mt-3"><?=lang('Auth.register')?></button>
            <p class="mt-5"><?=lang('Auth.alreadyRegistered')?> <a href="<?= url_to('login') ?>"><?=lang('Auth.signIn')?></a></p>
        </form>
    </div>

    <!-- Javascript  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>