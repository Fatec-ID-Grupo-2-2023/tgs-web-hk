<?php include_once 'services/verificar-token.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Authors -->
    <meta name="author" content="Caique Patelli Scapeline" />
    <meta name="author" content="Gianluca Dias De Micheli" />

    <title>TGS | Cadastrar Dentista</title>

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="assets/icons/logo_bg.svg" />

    <!-- Custom Fonts -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="assets/img/logo.png" height="50px">
                </div>
                <div class="sidebar-brand-text mx-3">TGS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <?php
                $json = file_get_contents('mock/sidebarItems.json');
                $data = json_decode($json);

                foreach ($data as $key => $value){
                    $workaround = isset($value->target) ? "target='" . $value->target . "' href='" . $value->link . "'" : "href='" . $value->link . ".php'";
                    echo "<li class='nav-item'>
                                <a class='nav-link' " . $workaround . ">
                                    <img src='assets/icons/" . $value->icon . ".svg' width='18px' height='18px'/>
                                    <span>" . $value->title . "</span></a>
                            </li>";
                }
            ?>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['name'] ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="dentist-list.php">Dentistas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cadastrar Dentista</li>
                        </ol>
                    </nav>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Cadastrar Dentista</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row mb-4 p-4">

                        <form class="row g-3" action="services/register.php" method="post">
                            <div class="col-12 mb-2 form-subtitle">
                                <h4>Dados Básicos</h4>
                            </div>
                            <div class="mb-3 col-12 col-md-12">
                                <label for="document" class="form-label">CRO <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="document" name="document" aria-describedby="croHelp" required>
                                <div id="croHelp" class="form-text">Insira somente os números.</div>
                            </div>
                            <div class="mb-3 col-6 col-md-6">
                                <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3 col-6 col-md-6">
                                <label for="surname" class="form-label">Sobrenome <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="surname" name="surname" required>
                            </div>
                            <div class="mb-3 col-12 col-md-12">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3 col-6 col-md-6">
                                <label for="telephone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telephone" name="telephone" aria-describedby="telephoneHelp">
                                <div id="telephoneHelp" class="form-text">Insira somente os números.</div>
                            </div>
                            <div class="mb-3 col-6 col-md-6">
                                <label for="cellphone" class="form-label">Celular <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cellphone" name="cellphone" aria-describedby="cellphoneHelp" required>
                                <div id="cellphoneHelp" class="form-text">Insira somente os números.</div>
                            </div>
                            <div class="mb-3 col-12 col-md-12">
                                <label for="expertise" class="form-label">Especialidade <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="expertise" name="expertise" required>
                            </div>
                            <div class="mb-3 col-12 col-md-12">
                                <label for="password" class="form-label">Senha <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="col-12 btn-toolbar flex-row-reverse">
                                <button type="submit" class="btn btn-primary" name="registerDentist">Cadastrar</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; TGS 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tem certeza que quer sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Logout" se estiver preparado para sair.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>