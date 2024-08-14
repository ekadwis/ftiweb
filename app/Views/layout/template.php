<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- JQuery  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- BoxIcons -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <link rel="stylesheet" href="/css/template.css">
    <title>FTI WEB</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <img src="/img/logo.png" alt="">
                </div>
                <!-- Sidebar Navigation Administrator -->
                <?php if (in_groups('administrator')) : ?>
                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Tools & Components
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url(); ?>" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                Home
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pagespengajuansurat" aria-expanded="false" aria-controls="pagespengajuansurat">
                                <i class="fa-solid fa-envelope"></i>
                                Pengajuan Surat
                            </a>
                            <ul id="pagespengajuansurat" class="sidebar-dropdown list-unstyled collapse ps-3" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/admin/pengajuansurat" class="sidebar-link">Dekanat</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Dosen</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Mahasiswa</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="/admin/permohonanttd" class="sidebar-link">
                                <i class="fa-solid fa-file"></i>
                                Permohonan TTD
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pagessuratmasuk" aria-expanded="false" aria-controls="pagessuratmasuk">
                                <i class="fa-solid fa-envelope"></i>
                                Surat Masuk
                            </a>
                            <ul id="pagessuratmasuk" class="sidebar-dropdown list-unstyled collapse ps-3" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/admin/surattugas" class="sidebar-link">Surat Tugas</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/admin/suratkeputusan" class="sidebar-link">Surat Keputusan</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="/admin/arsipsurat" class="sidebar-link">
                                <i class="fa-solid fa-box-archive"></i>
                                Arsip
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#user" aria-expanded="false" aria-controls="pages">
                                <i class="fa-solid fa-users"></i>
                                Daftar Pengguna
                            </a>
                            <ul id="user" class="sidebar-dropdown list-unstyled collapse ps-3" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/admin/daftarpengguna_dekanat" class="sidebar-link">Dekanat</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/admin/daftarpengguna_dosen" class="sidebar-link">Dosen</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/admin/daftarpengguna_mahasiswa" class="sidebar-link">Mahasiswa</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url(); ?>admin/profiladministrator" class="sidebar-link">
                                <i class="fa-solid fa-box-archive"></i>
                                Profil Administrator
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url('logout'); ?>" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
                <?php if (in_groups('user')) : ?>
                    <!-- Sidebar Navigation User-->
                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Tools & Components
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pengajuansurat" aria-expanded="false" aria-controls="pengajuansurat">
                                <i class="fa-solid fa-users"></i>
                                Pengajuan Surat
                            </a>
                            <ul id="pengajuansurat" class="sidebar-dropdown list-unstyled collapse ps-3" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/user/pengajuansurat_keputusan" class="sidebar-link">Surat Keputusan</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/user/pengajuansurat_tugas" class="sidebar-link">Surat Tugas</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/user/pengajuansurat_formal" class="sidebar-link">Surat Formal</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="/user/daftarsurat" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                Daftar Surat
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url('logout'); ?>" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </aside>
        <!-- Main Component -->
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <!-- Button for sidebar toggle -->
                <button class="btn" type="button" data-bs-theme="light">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <div class="container pt-4">
                            <?php if (session()->getFlashdata('msg')) : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('msg'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?= $this->renderSection('content'); ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    <script>
        const toggler = document.querySelector(".btn");
        toggler.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("collapsed");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</body>

</html>