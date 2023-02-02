<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

    header("Location: login.php");
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
    <link rel="stylesheet" href="../package/dist/sweetalert2.css">

</head>

<body id="page-top">
    <div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h3 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h3>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i></button>

                </div>
                <div class="modal-body">

                    <form action="registros.php" method="POST">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre *</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Correo:</label><br>
                            <input type="email" name="correo" id="correo" class="form-control" placeholder="No se puede repetir con alguno de la lista...">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label><br>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="form-label">Telefono *</label>
                            <input type="tel" id="telefono" name="telefono" class="form-control" required>

                        </div>

                        <div class="form-group">
                            <label for="rol_id" class="form-label">Rol de usuario:</label>
                            <select name="rol_id" id="rol_id" class="form-control" required>
                                <option value="">--Selecciona una opcion--</option>
                                <option value="1">Administrador</option>
                                <option value="2">Empleado</option>
                            </select>
                        </div>
                        <br>

                        <div class="mb-3">

                            <input type="submit" value="Guardar" id="register" class="btn btn-success" name="registrar">
                            <a href="usuarios.php" class="btn btn-danger">Cancelar</a>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>





    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#register').click(function(e) {

                var valid = this.form.checkValidity();

                if (valid) {


                    var nombre = $('#nombre').val();
                    var correo = $('#correo').val();
                    var telefono = $('#telefono').val();
                    var password = $('#password').val();
                    var rol_id = $('#rol_id').val();


                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: '../includes/_sesion/validar.php',
                        data: {
                            nombre: nombre,
                            correo: correo,
                            telefono: telefono,
                            password: password,
                            rol_id: rol_id
                        },
                        success: function(data) {
                            Swal.fire({
                                'title': '¡Mensaje!',
                                'text': data,
                                'icon': 'success',
                                'type': 'success',
                                'showConfirmButton': 'false',
                                'timer': '1500'
                            }).then(function() {
                                window.location = "usuarios.php";
                            });


                        },
                        error: function(data) {
                            Swal.fire({
                                'title': 'Error',
                                'text': 'Hubo problemas al guardar los datos',
                                'type': 'error'
                            })
                        }
                    });


                } else {

                }





            });


        });
    </script>
</body>

</html>