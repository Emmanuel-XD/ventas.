<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

    header("Location:_sesion/login.php");
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


<div class="modal fade" id="editar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar el producto <?php echo $fila['descripcion']; ?></h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form action="_functions.php" method="POST">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Codigo de barra:</label>
                                <input type="text" id="codigo" name="codigo" class="form-control" value="<?php echo $fila['codigo']; ?>" required>

                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Descripcion</label>
                                <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo $fila['descripcion']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Precio de venta:</label><br>
                                <input type="text" name="precioVenta" id="precioVenta" class="form-control" value="<?php echo $fila['precioVenta']; ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Precio de compra:</label><br>
                                <input type="text" name="precioCompra" id="precioCompra" class="form-control" value="<?php echo $fila['precioCompra']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Existencia:</label><br>
                                <input type="text" name="existencia" id="existencia" class="form-control" value="<?php echo $fila['existencia']; ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Fecha:</label><br>
                                <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $fila['fecha']; ?>">
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Registrado por:</label><br>
                                <input type="text" name="" id="" class="form-control" readonly value="<?php echo $fila['nombre']; ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Actualizado por:</label><br>
                                <input type="text" name="nombre" id="nombre" class="form-control" readonly value="<?php echo $_SESSION['nombre']; ?>">
                            </div>
                        </div>
                        </div>
                        
							


                        <input type="hidden" name="accion" value="editar_producto">
                        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                            <br>

                        <div class="mb-3">

                            <input class="btn btn-success" type="submit" value="Editar">
                            <a class="btn btn-danger" href="listar.php">Cancelar</a>

                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>




</html>