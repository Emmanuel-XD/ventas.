<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

	header("Location:../includes/_sesion/login.php");
}
?>
<?php include_once "encabezado.php" ?>

<div class="modal fade" id="codbarra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h3 class="modal-title" id="exampleModalLabel">Generar Codigo de Barras</h3>
				<button type="button" class="btn btn-primary" data-dismiss="modal">
					<i class="fa fa-times" aria-hidden="true"></i></button>
			</div>
			<div class="modal-body">
				<form method="post" action="">


					<div class="form-group">
						<label class="form-label"><--Selecciona el producto--></label>
						<select class="form-control" required id="id_producto" name="id_producto">
							<option value="">--Selecciona una opcion--</option>
							<?php
							include "../includes/db.php";
							//Codigo para mostrar categorias desde otra tabla
							$sql = "SELECT * FROM productos ";
							$resultado = mysqli_query($conexion, $sql);
							while ($consulta = mysqli_fetch_array($resultado)) {
								echo '<option value="' . $consulta['id'] . '">' . $consulta['descripcion'] . '</option>';
							}

							?>

						</select>
					</div>
					<br>
					<div class="form-group" id="select2lista">

					</div>
					<br>
					<div class="mb-3">

						<input type="submit" value="Guardar" id="register" class="btn btn-success" name="registrar">
						<a href="codbarra.php" class="btn btn-danger">Cancelar</a>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	$(document).ready(function() {
		$('#id_producto').val(1);
		recargarLista();

		$('#id_producto').change(function() {
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista() {
		$.ajax({
			type: "POST",
			url: "data.php",
			data: "codigo=" + $('#id_producto').val(),
			success: function(r) {
				$('#select2lista').html(r);
			}
		});
	}
</script>
<script type="text/javascript">
        $(function() {
            $('#register').click(function(e) {

                var valid = this.form.checkValidity();

                if (valid) {


                    var id_producto = $('#id_producto').val();
                    var codigo = $('#codigo').val();



                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: '../includes/save_cod.php',
                        data: {
                            id_producto: id_producto,
                            codigo: codigo
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
                                window.location = "codbarra.php";
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

<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>