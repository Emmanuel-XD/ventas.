<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

    header("Location: ../includes/_sesion/login.php");
    die();
}



?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>


</head>


<div class="modal fade" id="editar<?php echo $filas['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Datos de empresa</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>

            </div>
            <div class="modal-body">

                <form action="../includes/_functions.php" method="POST">
                    <p>En este apartado usted puede colocar los datos de su empresa. Los cuales seran de ayuda
                        y complemento para los datos que llevaran su ticket de venta.</p>
                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" id="negocio" name="negocio" class="form-control" value="<?php echo $filas['negocio']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="form-label">Telefono:</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo $filas['telefono']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Direccion</label><br>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $filas['direccion']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Mensaje Final:</label><br>
                        <input type="text" name="mensaje" id="mensaje" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $filas['mensaje']; ?>" required>
                    </div>


                    <br>
                    <input type="hidden" name="accion" value="editar_datos">
                    <input type="hidden" name="id" value="<?php echo $filas['id']; ?>">
                    <div class="mb-3">

                        <button type="submit" class="btn btn-success">Guardar </button>
                        <a href="../views/usuarios.php" class="btn btn-danger">Cancelar</a>

                    </div>


                </form>

            </div>
        </div>
    </div>
</div>





</html>