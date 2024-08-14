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
        <div class="container pt-4 w-50 mx-auto">
            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('msg'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>

        <div class="container pt-4 w-50 mx-auto">
            <?php if (session()->getFlashdata('msg-regist')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('msg-regist'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
        <!-- Content  -->
        <form action="<?= url_to('login') ?>" method="post" enctype="multipart/form-data" class="m-auto mt-5">
            <?= csrf_field(); ?>
            <div class="logo mx-auto mb-5">
                <img src="img/logo.png" alt="">
            </div>

            <?php if ($config->validFields === ['email']) : ?>
                <div class="mb-3 mt-5">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.login') ?>
                    </div>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            <?php else : ?>
                <div class="form-group mb-3">
                    <label for="login" class="mb-2">Email address</label>
                    <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.login') ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="password" class="mb-2"><?= lang('Auth.password') ?></label>
                <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.password') ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block float-end mt-3"><?= lang('Auth.loginAction') ?></button>
            <br><br>
            <?php if ($config->allowRegistration) : ?>
                <p><a href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
            <?php endif; ?>
        </form>

    </div>

    <!-- Javascript  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>