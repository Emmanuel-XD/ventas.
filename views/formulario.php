<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

	header("Location:../includes/_sesion/login.php");
}
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
<?php include_once "encabezado.php" ?>
<div class="modal fade" id="producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h3 class="modal-title" id="exampleModalLabel">Nuevo Producto</h3>
				<button type="button" class="btn btn-primary" data-dismiss="modal">
					<i class="fa fa-times" aria-hidden="true"></i></button>
			</div>
			<div class="modal-body">

				<form action="_functions.php" method="POST">

					<div class="row">
						<div class="col-sm-6">
							<div class="mb-3">
								<label for="nombre" class="form-label">Codigo de barra:</label>
								<input type="text" id="codigo" name="codigo" class="form-control" required>

							</div>
						</div>


						<div class="col-sm-6">
							<div class="mb-3">
								<label for="nombre" class="form-label">Descripcion</label>
								<input type="text" id="descripcion" name="descripcion" class="form-control" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="mb-3">
								<label for="password">Precio de venta:</label><br>
								<input type="text" name="precioVenta" id="precioVenta" class="form-control" required>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="mb-3">
								<label for="password">Precio de compra:</label><br>
								<input type="text" name="precioCompra" id="precioCompra" class="form-control" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="mb-3">
								<label for="password">Existencia:</label><br>
								<input type="text" name="existencia" id="existencia" class="form-control" required>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="mb-3">
								<label for="username">Fecha:</label><br>
								<input type="date" name="fecha" id="fecha" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="nombre" class="form-label">Registrado por:</label>
						<input type="text" id="nombre" name="nombre" class="form-control" readonly value="<?php echo $fila['nombre']; ?>" required>
					</div>


					<br>

					<div class="mb-3">

						<input type="submit" value="Guardar" id="register" class="btn btn-success" name="registrar">
						<a class="btn btn-danger" href="../includes/listar.php">Cancelar</a>

					</div>
			</div>

			</form>
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


				var codigo = $('#codigo').val();
				var descripcion = $('#descripcion').val();
				var precioVenta = $('#precioVenta').val();
				var precioCompra = $('#precioCompra').val();
				var existencia = $('#existencia').val();
				var fecha = $('#fecha').val();
				var nombre = $('#nombre').val();

				e.preventDefault();

				$.ajax({
					type: 'POST',
					url: '../includes/nuevo.php',
					data: {
						codigo: codigo,
						descripcion: descripcion,
						precioVenta: precioVenta,
						precioCompra: precioCompra,
						existencia: existencia,
						fecha: fecha, nombre: nombre
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
							window.location = "listar.php";
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