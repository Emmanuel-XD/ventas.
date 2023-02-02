<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>


</head>

<body id="page-top">
    <div class="modal fade" id="editar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h3 class="modal-title" id="exampleModalLabel">Editar registro de <?php echo $fila['nombre']; ?> </h3>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i></button>

                </div>
                <div class="modal-body">

                    <form action="../includes/_functions.php" method="POST">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre/Apellido *</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $fila['nombre']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Correo:</label><br>
                            <input type="email" name="correo" id="correo" class="form-control" value="<?php echo $fila['correo']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control" value="<?php echo $fila['password']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Telefono:</label><br>
                            <input type="tel" name="telefono" id="telefono" class="form-control" value="<?php echo $fila['telefono']; ?>" required>
                        </div>

                        <div class="form-group ">
                            <label>Rol de usuario:</label>
                            <select name="rol_id" id="rol_id" class="form-control" value="<?php echo $fila['rol_id']; ?>" required>
                                <option <?php echo $fila['rol_id'] === '1' ? "selected='selected' " : "" ?> value="1">Administrador</option>
                                <option <?php echo $fila['rol_id'] === '2' ? "selected='selected' " : "" ?> value="2">Empleado</option>
                            </select>
                        </div>


                        <br>
                        <input type="hidden" name="accion" value="editar_registro">
                        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Editar</button>
                            <a href="../views/usuarios.php" class="btn btn-danger">Cancelar</a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</html>