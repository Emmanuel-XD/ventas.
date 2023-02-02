<?php
include_once "encabezado.php";
include_once "../includes/db.php";
?>
<?php
error_reporting(0);
session_start();
$actualsesion = $_SESSION['nombre'];

if ($actualsesion == null || $actualsesion == '') {
}
?>
<?php

$sql = "SELECT  user.id, user.nombre, user.correo, user.password, user.telefono, 
user.fecha, permisos.rol FROM user 
LEFT JOIN permisos ON user.rol_id= permisos.id   WHERE nombre ='$actualsesion'";
$usuarios = mysqli_query($conexion, $sql);
if ($usuarios->num_rows > 0) {
    foreach ($usuarios as $key => $fila) {




?>
        <tr>

        </tr>

<?php
    }
}
?>

<?php
$consulta = "SELECT * FROM datos";
$sql = mysqli_query($conexion, $consulta);
if ($sql->num_rows > 0) {
    foreach ($sql as $key => $filas) {

?>
<?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/perfil.css" />
    <link rel="stylesheet" href="../css/fontawesome-all.min.css" />
</head>

<body>

    <!--==========================
=            html            =
===========================-->
    <section class="seccion-perfil-usuario">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada">
                <div class="perfil-usuario-avatar">
                    <img src="../img/../img/undraw_profile.svg" alt="img-avatar">
                    <button type="button" class="boton-avatar">
                        <i class="far fa-image"></i>
                    </button>
                </div>
                <button type="button" class="boton-portada">
                    <i class="far fa-image"></i> (Proximamente))
                </button>
            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <h3 class="titulo"><?php echo $fila['nombre']; ?></h3>
                <p class="texto">¡Bienvenido al Sistema De Ventas Web - El Sistema De Ventas Web. Que necesita tu negocio!</p>
            </div>
            <div class="perfil-usuario-footer">
                <ul class="lista-datos">
                    <li><i class="icono fas fa-envelope"></i>Email: <?php echo $fila['correo']; ?></li>
                    <li><i class="icono fas fa-phone"></i>Telefono: <?php echo $fila['telefono']; ?></li>
                    <li><i class="icono fas fa-briefcase"></i>Trabaja en: <?php echo $filas['negocio']; ?></li>
                    </li>
                    <li><i class="icono fas fa-building"></i> Cargo: <?php echo $fila['rol']; ?></li>
                </ul>
                <ul class="lista-datos">
                    <li><i class="icono fas fa-map-marker-alt"></i> Ubicacion: <?php echo $filas['direccion']; ?></li>
                    <li><i class="icono fas fa-calendar-alt"></i> Fecha: <?php echo $fila['fecha']; ?></li>
                    <li><i class="icono fas fa-user"></i>Estado: Activo</li>
                    <li><i class="icono fas fa-share-alt"></i> Redes sociales: 3</li>
                </ul>
            </div>

            <div class="redes-sociales">
                <a href="" class="boton-redes facebook fab fa-facebook-f" target="_blank"><i class="icon-facebook"></i></a>
                <a href="" class="boton-redes twitter fab fa-twitter"><i class="icon-twitter" target="_blank"></i></a>
                <a href=" " class="boton-redes instagram fab fa-instagram" target="_blank"><i class="icon-instagram"></i></a>
            </div>
        </div>
        <?php include "pie.php"; ?>
    </section>

    <!--====  End of html  ====-->

    <!--=============================
redes sociales fijadas en pantalla
No es necesario que copies esto!
==============================-->

    <div class="mis-redes" style="display: block;position: fixed;bottom: 1rem;left: 1rem; opacity: 0.5; z-index: 1000;">
        <p style="font-size: .75rem;">SoftCodEPM</p>
        <div>
            <a target="_blank" href="" target="_blank"><i class="fab fa-facebook-square"></i></a>
            <a target="_blank" href=""><i class="fab fa-twitter"></i></a>
            <a target="_blank" href="" target="_blank"><i class="fab fa-instagram"></i></a>
            <a target="_blank" href="" target="_blank"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
    <!--====  End of tarjeta  ====-->
</body>

</html>