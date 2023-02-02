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


<div class="modal fade" id="settings<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Configuracion General</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>

            </div>
            <div class="modal-body">

                <form action="../includes/_functions.php" method="POST">
                    <p>En este apartado usted puede configurar los datos de su localidad,
                        asi como el color del tema del sistema que corresponde a la barra de navegacion </p>
                    <div class="form-group">
                        <label for="nombre" class="form-label">Municipio:</label>
                        <input type="text" id="municipio" name="municipio" class="form-control" value="<?php echo $fila['municipio']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="form-label">Estado:</label>
                        <input type="text" id="estado" name="estado" class="form-control" value="<?php echo $fila['estado']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Pais</label><br>
                        <input type="text" name="pais" id="pais" class="form-control" value="<?php echo $fila['pais']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tema" class="form-label">Color de Tema:</label>
                        <select name="tema" id="tema" class="form-control" required>
                            <option <?php echo $fila['tema'] === 'bg-dark' ? "selected='selected' " : "" ?> value="bg-dark">Negro</option>
                            <option <?php echo $fila['tema'] === 'bg-secondary' ? "selected='selected' " : "" ?> value="bg-secondary">Gris</option>
                            <option <?php echo $fila['tema'] === 'bg-primary' ? "selected='selected' " : "" ?> value="bg-primary">Azul</option>
                            <option <?php echo $fila['tema'] === 'bg-info' ? "selected='selected' " : "" ?> value="bg-info">Azul-Bajo</option>
                            <option <?php echo $fila['tema'] === 'bg-success' ? "selected='selected' " : "" ?> value="bg-success">Verde</option>
                            <option <?php echo $fila['tema'] === 'bg-danger' ? "selected='selected' " : "" ?> value="bg-danger">Rojo</option>
                            <option <?php echo $fila['tema'] === 'bg-warning' ? "selected='selected' " : "" ?> value="bg-warning">Amarillo</option>

                        </select>
                    </div>


                    <br>
                    <input type="hidden" name="accion" value="editar_tema">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                    <div class="mb-3">

                        <button type="submit" class="btn btn-success">Guardar</button>
                        <a href="../views/index.php" class="btn btn-danger">Cancelar</a>

                    </div>


                </form>

            </div>
        </div>
    </div>
</div>





</html>