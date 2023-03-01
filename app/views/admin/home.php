<?php
require_once '../app/models/admin.php';
if($_SESSION["admin"]=="") header("Location: /frontEndprueba/www/");
$admin_model = new admin_model();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/frontEndprueba/www/user/">
    </base>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin-Home</title>
    <link href="../../www/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../../www/assets/css/warehouse.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav orange-color-back sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminIndex">
                <div class="sidebar-brand-icon">
                    <img class="logo-app-header" src="../../www/img/logo-app.png" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="adminIndex">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Inicio</span></a>
            </li>
            

            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["admin"]; ?></span>
                                <img class="img-profile rounded-circle" src="../../www/assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item cursor-pointer" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400 "></i>Cerrar Sesion</a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div class="container-fluid">
                    <h1 class="text-center">¡<?php echo $admin_model->getNameByUsername($_SESSION["admin"]); ?> bienvenido!</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuarios Registrados</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Materias Registradas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-box fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Clases Registradas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-box fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                            <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Agrega Usuario</h6>
                            </a>
                            <div class="collapse" id="collapseCardExample2">
                                <div class="card-body">
                                    <form action="adminIndex" method="post">
                                        <div class="row">
                                            <div class="col"><input type="text" class="form-control mb-2" name="name" placeholder="Nombre" required></div>
                                            <div class="col">
                                                <select  class="form-control mb-2" name="idClases" id="idProfesorDp">
                                                    <?php $admin_model->getClases(); ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                            <select  class="form-control mb-2" name="rol" id="rol">
                                                    <option value="1">Maestro</option>
                                                    <option value="2">Estudiante</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><input type="text" class="form-control mb-2" name="username" placeholder="Nombre de usuario" required></div>
                                            <div class="col"><input type="password" class="form-control mb-2" name="password" placeholder="Contraseña" required></div>
                                          
                                        </div>
                                        <input type="submit" class="form-control btn btn-success" name="insertUser" value="Agregar usuario">

                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Agrega Clases</h6>
                            </a>
                            <div class="collapse" id="collapseCardExample">
                                <div class="card-body">
                                    <form action="adminIndex" method="post">
                                        <div class="row">
                                            <div class="col"><input type="text" class="form-control mb-2" name="className" placeholder="Clase" required></div>
                                            <div class="col"><input type="submit" class="form-control btn btn-success" name="insertClass" value="Agregar clase"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                            <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Agrega Materia</h6>
                            </a>
                            <div class="collapse" id="collapseCardExample1">
                                <div class="card-body">
                                    <form action="adminIndex" method="post">
                                        <div class="row">
                                            <div class="col"><input type="text" class="form-control mb-2" name="materiaName" placeholder="Materia" required></div>
                                            <div class="col">
                                                <select  class="form-control mb-2" name="idProfesorDp" id="idProfesorDp">
                                                    <?php $admin_model->getTeachers(); ?>
                                                </select>
                                            </div>

                                            <div class="col"><input type="submit" class="form-control btn btn-success" name="insertMateria" value="Agregar materia"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    



                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Sistema de registro de notas</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Seguro que deseas salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona cerrar si realmente quieres cerrar sesion</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="close">Cerrar</a>
                </div>
            </div>
        </div>
    </div>
    <script src="../../www/assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../www/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../www/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../www/assets/js/sb-admin-2.min.js"></script>
    <script src="../../www/assets/vendor/chart.js/Chart.min.js"></script>
    <script src="../../www/assets/js/demo/chart-area-demo.js"></script>
    <script src="../../www/assets/js/demo/chart-pie-demo.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="../../www/assets/js/demo/datatables-demo.js"></script>
    <script src="../../www/assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../www/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>
<?php
if(isset($_POST["insertClass"])){
    $class = $_POST["className"];
    $admin_model->insertClass($class);
}
if(isset($_POST["insertMateria"])){
    $name = $_POST["materiaName"];
    $idProfesor = $_POST["idProfesorDp"];

    $admin_model->insertMateria($name, $idProfesor);
}
if(isset($_POST["insertUser"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $classId = $_POST["idClases"];
    $rol = $_POST["rol"];


    $admin_model->insertUser($username, $password, $name, $classId, $rol);
}
?>