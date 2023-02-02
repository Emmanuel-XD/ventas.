<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

    header("Location:../includes/_sesion/login.php");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ventas</title>


    <link rel="stylesheet" href="../css/fontawesome-all.min.css">

    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <link rel="stylesheet" href="../DataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../css/prueba.css">

    <script src="../js/resp/bootstrap.min.js"></script>
</head>
<?php
require_once("../includes/db.php");
$consulta = mysqli_query($conexion, "SELECT * FROM settings ");

while ($fila = mysqli_fetch_array($consulta)) {

?>
    <?php include "settings.php"; ?>


    <nav class="navbar navbar-expand-lg navbar-dark <?php echo $fila['tema'] ?> fixed-top" id="mainNav">


        <div class="container px-4">
            <a class="navbar-brand" href="../views/index.php">Ventas <i class="fa fa-check" aria-hidden="true"></i></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item"><a class="nav-link" href="../includes/listar.php">Productos <i class="fa fa-list" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="../views/vender.php">Venta <i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="../views/ventas.php">Historial <i class="fa fa-history" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="../views/calendario.php">Calendario <i class="fa fa-calendar" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="../includes/_sesion/login.php">Usuarios <i class="fa fa-users" aria-hidden="true"></i></a>
                    <li>
                    <li class="nav-item"><a class="nav-link" href="../views/contacto.php">Soporte <i class="fa fa-question-circle" aria-hidden="true"></i></a>
                    <li>
                        <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?php echo $_SESSION['nombre']; ?></span>
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                        </a>
                        <?php
                        //Con esto editamos el perfil de usuario en sesion
                        //include "db.php";              
                        //$result=mysqli_query($conexion,"SELECT  user.id, user.nombre, user.correo, user.password, user.fecha,
                        //roles.rol FROM user 
                        // LEFT JOIN roles ON user.rol= roles.id ");
                        //while ($fila = mysqli_fetch_assoc($result)):

                        ?>

                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


                            <a class="dropdown-item" href="../views/perfil.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Perfil
                            </a>


                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settings<?php echo $fila['id']; ?>">
                                <i class="fa fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                Configuracion

                            </a>


                        <?php } ?>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>

                        </div>

                    </li>

                </ul>
            </div>
        </div>

    </nav>

    <?php include "salir.php"; ?>

    <script src="../js/JsBarcode.all.min.js"></script>
    <div class="container">
        <div class="row">
            <script src="../js/contenido.js"></script>