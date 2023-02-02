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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../DataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../css/prueba.css">


    <title></title>
    <!-- CSS only -->


    <title></title>
</head>

<div class="col-xs-12">
    <center>
        <h1>CODIGOS DE BARRAS</h1>
    </center>
    <br>
    <div>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#codbarra">
            <span class="glyphicon glyphicon-plus"></span> Generar Codigo de Barra <i class="fa fa-plus"></i> </a></button>

        <a href="../includes/print.php" class="btn btn-outline-secondary" target="_blank">Imprimir <i class="fa fa-print" aria-hidden="true"></i> </a>
    </div>
    <br>
    <p>En este apartado usted podra crear sus codigos de barra, asi como tambien podra imprimirlos. Esto es para aquellos
        productos que se venden por menudencia o individuales.</p>
    <p><b>Nota:</b> Una vez que hayas creado el codigo de barra. Si cambias el codigo desde la vista de "PRODUCTOS" se actualizara
        de forma automatica en la vista de "CODIGOS DE BARRAS", sin que tengas que hacerlo manualmente.</p>
    <style>
        #m {
            color: #FF0000;
        }

        #b {
            color: #FFA500;
        }

        a {
            text-decoration: none;
        }

        table.dataTable thead th,
        table.dataTable tfoot th {
            font-weight: bold;
            color: white;
        }
    </style>

    <table class="table table-striped" id="table_id">

        <thead>
            <tr class="bg-dark">

                <th>Descripcion</th>

                <th>Codigo-Barra</th>
                <th>Eliminar</th>

            </tr>
        </thead>
        <tbody>

            <?php
            require_once("../includes/db.php");
            $sql = "SELECT cd.id, cd.codigo, p.codigo, p.descripcion FROM codbarra cd INNER JOIN productos p ON cd.id_producto = p.id";
            $resultado = mysqli_query($conexion, $sql);

            //declaramos arreglo para guardar codigos
            $codbarra = array();
            ?>
            <?php
            while ($fila = mysqli_fetch_assoc($resultado)) :
                $codbarra[] = (string)$fila['codigo'];
            ?>
                <tr>
                    <td><?php echo $fila['descripcion'] ?></td>
                    <td><svg id='<?php echo "barcode" . $fila['codigo']; ?>'></td>

                    <td>



                        <a href="../includes/eliminar_cod.php?id=<?php echo $fila['id'] ?> " class=" btn btn-danger btn-del">
                            <i class="fa fa-trash "></i></a></button>
                    </td>
                </tr>


            <?php endwhile; ?>


            </body>

    </table>
    <style>



    </style>
    <script>
        $('.btn-del').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: 'Estas seguro de eliminar este codigo?',
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
                            'El codigo de barra fue eliminado.',
                            'success'
                        )
                    }

                    document.location.href = href;
                }
            })

        })
    </script>

    <script type="text/javascript">
        function arrayjsonbarcode(j) {
            json = JSON.parse(j);
            arr = [];
            for (var x in json) {
                arr.push(json[x]);
            }
            return arr;
        }

        jsonvalor = '<?php echo json_encode($codbarra) ?>';
        valores = arrayjsonbarcode(jsonvalor);

        for (var i = 0; i < valores.length; i++) {

            JsBarcode("#barcode" + valores[i], valores[i].toString(), {
                format: "CODE128",
                lineColor: "#000",
                width: 2,
                height: 30,
                displayValue: true
            });
        }
    </script>


    <script src="../js/codigo.js"></script>

    <?php include_once "../views/pie.php" ?>

    <?php include('../views/formcode.php'); ?>

</html>