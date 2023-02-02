<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

  header("Location:../includes/_sesion/login.php");
  die();
}
include_once "encabezado.php";
?>


<div>
<center>
<h1>USUARIOS</h1>
</center>
  <br>


  <div>

  <h2 class="subtitle">¡Welcome Administrator <?php echo $_SESSION['nombre']; ?>!</h2>
    <br>
  </div>

  <div>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#user">
      <span class="glyphicon glyphicon-plus"></span> Agregar usuario <i class="fa fa-user-plus"></i> </a></button>

    <?php
    require_once("../includes/db.php");
    $consult = mysqli_query($conexion, "SELECT * FROM datos ");

    while ($filas = mysqli_fetch_array($consult)) {

    ?>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editar<?php echo $filas['id']; ?>">
        Datos de la empresa <i class="fa fa-building" aria-hidden="true"></i>
      </button>
      <?php include "datos.php"; ?>

    <?php } ?>
    <?php include("../includes/_sesion/registros.php"); ?>

  </div>
  <br>


  <table class="table table-striped" id="table_id">


    <thead>
      <tr class="bg-dark" style="color: white;">
        <th>Nombre</th>
        <th>Correo</th>
        <th>Password</th>
        <th>Telefono</th>
        <th>Fecha_Registro</th>
        <th>Rol </th>
        <th>Acciones</th>

      </tr>
    </thead>
    <tbody>

      <?php

      require_once("../includes/db.php");
      $result = mysqli_query($conexion, "SELECT * FROM user");
      while ($fila = mysqli_fetch_assoc($result)) :

      ?>
        <tr>
          <td><?php echo $fila['nombre']; ?></td>
          <td><?php echo $fila['correo']; ?></td>
          <td><?php echo $fila['password']; ?></td>
          <td><?php echo $fila['telefono']; ?></td>
          <td><?php echo $fila['fecha']; ?></td>
          <td><?php echo $fila['rol_id']; ?></td>

          <td>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['id']; ?>">
              <i class="fa fa-edit "></i>
            </button>

            <a href="../includes/eliminar_user.php?id=<?php echo $fila['id'] ?> " class="btn btn-danger btn-del">
              <i class="fa fa-trash "></i></a></button>
          </td>
        </tr>

        <?php include "../includes/editar_user.php"; ?>
      <?php endwhile; ?>

    </tbody>

  </table>
</div>
</div>

</div>

<script>
  $('.btn-del').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire({
      title: 'Estas seguro de eliminar este usuario?',
      text: "¡No podrás revertir esto!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!',
      cancelButtonText: 'Cancelar!',
    }).then((result) => {
      if (result.value) {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El usuario fue eliminado.',
            'success'
          )
        }

        document.location.href = href;
      }
    })

  })
</script>

<script src="../js/user.js"></script>

<?php include_once "pie.php" ?>

</html>