<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TGS | Login</title>

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="assets/icons/logo_bg.svg" />

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-login">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-12 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="assets/img/logo.png" height="150px">
                                        <h1 class="h4 text-gray-900 mt-2 mb-4">Seja bem-vindo!</h1>
                                    </div>
                                    <?php
                                        if (isset($_GET['response']) == "unauthorized"){
                                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <strong>Falha no login!</strong> Usuário e/ou senha inválidos.
                                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>";
                                        } else if (isset($_GET['session']) == "null"){
                                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <strong>Faça login!</strong>
                                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>"; 
                                        }
                                    ?>
                                    <form class="user" action="services/register.php" method="post">
                                        <div class="form-group">
                                            <input type="user" style="border-right: 1px solid #d1d3e2" class="form-control form-control-user"
                                                id="user" name="user" placeholder="Usuário">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control form-control-user"
                                            id="password" name="password" placeholder="Senha" aria-describedby="eye">
                                            <div class="input-group-append" onclick="showPassword()">
                                                <span class="input-group-text"><i id="eye" class="fas fa-eye"></i></span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="login">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="assets/js/custom.js"></script>

</body>

</html>