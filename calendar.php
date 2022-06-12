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

    <title>TGS | Calendar</title>

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="assets/icons/logo_bg.svg" />

    <!-- Custom Fonts -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>

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

            foreach ($data as $key => $value) {
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['name'] ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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
                            <li class="breadcrumb-item active" aria-current="page">Calendário</li>
                        </ol>
                    </nav>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Calendário</h1>
                        <div class="col-auto">
                            <a href="schedule-form.php" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus fa-sm text-white"></i>
                                Abrir Agenda
                            </a>
                            <a href="consult-form.php" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus fa-sm text-white"></i>
                                Agendar Consulta
                            </a>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Consultas Agendadas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="filters">
                                            <th>Dentista
                                                <select id="dentist-filter" class="form-control">
                                                    <option value="Any" selected>Selecione um dentista</option>
                                                    <?php

                                                    include_once 'services/requestAPI.php';
                                                    $json = requestApi('GET', 'http:/localhost:8080/dentists/list/true', false, $_SESSION['token']);
                                                    $data = json_decode($json);

                                                    foreach ($data as $key => $value) {
                                                        echo "<option>{$value->name} {$value->surname}</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </th>
                                            <th>Paciente
                                                <select id="patient-filter" class="form-control">
                                                    <option value="Any" selected>Selecione um paciente</option>
                                                    <?php

                                                    include_once 'services/requestAPI.php';
                                                    $json = requestApi('GET', 'http:/localhost:8080/patients/list/true', false, $_SESSION['token']);
                                                    $data = json_decode($json);

                                                    foreach ($data as $key => $value) {
                                                        echo "<option>{$value->name} {$value->surname}</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </th>
                                            <th>Procedimento
                                                <select id="procedure-filter" class="form-control">
                                                    <option value="Any" selected>Selecione um procedimento</option>
                                                    <?php

                                                    include_once 'services/requestAPI.php';
                                                    $json = requestApi('GET', 'http:/localhost:8080/procedures/list/true', false, $_SESSION['token']);
                                                    $data = json_decode($json);

                                                    foreach ($data as $key => $value) {
                                                        echo "<option>{$value->title}</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>

                                <div class="panel panel-primary filterable">
                                    <table id="task-list-tbl" class="table">
                                        <thead>
                                            <tr>
                                                <th>Dentista</th>
                                                <th>Paciente</th>
                                                <th>Data</th>
                                                <th>Hora</th>
                                                <th>Procedimento</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php

                                            include_once 'services/requestAPI.php';
                                            $consultsJson = requestApi('GET', 'http:/localhost:8080/consults/list/true', false, $_SESSION['token']);
                                            $consultsData = json_decode($consultsJson);

                                            $procedureJson = requestApi('GET', 'http:/localhost:8080/procedures/list/true', false, $_SESSION['token']);
                                            $proceduresData = json_decode($procedureJson);

                                            $patientsJson = requestApi('GET', 'http:/localhost:8080/patients/list/true', false, $_SESSION['token']);
                                            $patientsData = json_decode($patientsJson);

                                            $dentistsJson = requestApi('GET', 'http:/localhost:8080/dentists/list/true', false, $_SESSION['token']);
                                            $dentistsData = json_decode($dentistsJson);

                                            foreach ($consultsData as $key => $consultsValues) {
                                                /* Arrumando reposta do back-end */

                                                /* Pegando o nome do procedimento */
                                                if (isset($consultsValues->procedure->id)) {
                                                    $procedureTitle = $consultsValues->procedure->title;
                                                } else if ($consultsValues->procedure) {
                                                    $procedureTitle = $proceduresData[array_search($consultsValues->procedure, array_column($proceduresData, 'id'))]->title;
                                                }

                                                /* Pegando o nome do paciente */
                                                if (isset($consultsValues->patient->cpf)) {
                                                    $patientFullName = "{$consultsValues->patient->name} {$consultsValues->patient->surname}";
                                                } else if ($consultsValues->patient) {
                                                    if (array_search($consultsValues->patient, array_column($patientsData, 'nickname'))) {
                                                        $patientFullName = array_search($consultsValues->patient, array_column($patientsData, 'nickname'));
                                                    } else if ($consultsValues->patient) {
                                                        $patientName = $patientsData[array_search($consultsValues->patient, array_column($patientsData, 'name'))]->name;
                                                        $patientSurname = $patientsData[array_search($consultsValues->patient, array_column($patientsData, 'surname'))]->surname;
                                                        $patientFullName = "{$patientName} {$patientSurname}";
                                                    }
                                                }

                                                /* Pegando o nome do dentista */
                                                if (isset($consultsValues->dentist->userId)) {
                                                    $dentistFullName = "{$consultsValues->dentist->name} {$consultsValues->dentist->surname}";
                                                } else if ($consultsValues->dentist) {
                                                    $dentistName = $dentistsData[array_search($consultsValues->dentist, array_column($dentistsData, 'name'))]->name;
                                                    $dentistSurname = $dentistsData[array_search($consultsValues->dentist, array_column($dentistsData, 'surname'))]->surname;
                                                    $dentistFullName = "{$dentistName} {$dentistSurname}";
                                                }

                                                $date = explode(" ", $consultsValues->dateTime)[0];
                                                $time = explode(" ", $consultsValues->dateTime)[1];
                                            ?>

                                                <tr id="task-<?= $consultsValues->id ?>" class="task-list-row" data-dentist='<?= $dentistFullName ?>' data-patient='<?= $patientFullName ?>' data-procedure='<?= $procedureTitle ?>' data-date='<?= date_format(date_create($date), "d/m/Y") ?>'>
                                                    <td><?= $dentistFullName ?></td>
                                                    <td><?= $patientFullName ?></td>
                                                    <td><?= date_format(date_create($date), "d/m/Y") ?></td>
                                                    <td><?= date_format(date_create($time), "H:i") ?></td>
                                                    <td><?= $procedureTitle ?></td>
                                                    <td>
                                                        <a href='#' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#removeModal<?= $consultsValues->id ?>'><i class='fas fa-trash'></i></a>
                                                    </td>
                                                </tr>

                                            <?php
                                            }

                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        <!-- Remove Modal-->
        <?php
        include_once 'services/requestAPI.php';
        $json = requestApi('GET', 'http:/localhost:8080/consults/list/true', false, $_SESSION['token']);
        $data = json_decode($json);

        foreach ($data as $key => $value) {
            echo "
                <div class='modal fade' id='removeModal" . $value->id . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
                    aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'>Tem certeza que quer exluir esse registro?</h5>
                                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>×</span>
                                </button>
                            </div>
                            <div class='modal-body'>Selecione 'Sim' para confirmar a exclusão.</div>
                            <div class='modal-footer'>
                                <form action='' method='post'>
                                    <button class='btn btn-secondary' type='button' data-dismiss='modal'>Não</button>
                                    <a href='calendar.php?id=" . $value->id . "' class='btn btn-primary'>Sim</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        if (isset($_GET['id'])) {
            $postData = array(
                "id" => $_GET['id']
            );

            $response = requestApi('POST', 'http:/localhost:8080/consults/remove', $postData, $_SESSION['token']);

            echo "<script> window.location = 'calendar.php?response=" . $response . "' </script>";
        }
        ?>

        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin-2.min.js"></script>
        <script src="assets/js/custom.js"></script>

</body>

</html>

<?php

$response = isset($_GET['response']) ? $_GET['response'] : null;

if (isset($response)) {
    if (strpos($response, 'OK') !== false) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Agenda aberta com sucesso!',
                    confirmButtonUrl: 'calendar.php'
                })
            </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '" . $response . "'',
                    confirmButtonUrl: 'calendar.php'
                })
            </script>";
    }
}

?>