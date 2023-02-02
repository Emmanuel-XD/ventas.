<?php


session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

    header("Location:../includes/_sesion/login.php");
    die();
}


include_once "encabezado.php"
?>
<html>

<head>
    <title>Estadistica</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="../js/chartJS/jquery.js"></script>
    <script type="text/javascript" src="../js/chartJS/Chart.min.js"></script>
</head>
<style>
    .caja {
        margin: auto;
        max-width: 250px;


    }

    .caja select {
        width: 100%;
        font-size: 16px;
        padding: 5px;
    }

    .resultados {
        margin: auto;
        margin-top: 5px;
        width: 1000px;
    }
</style>

<body>


    <div class="caja">
        <select onChange="mostrarResultados(this.value);">
            <?php
            for ($i = 2023; $i < 2041; $i++) {
                if ($i == 20) {
                    echo '<option value="' . $i . '" selected>' . $i . '</option>';
                } else {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <div class="resultados"><canvas id="grafico"></canvas></div>
</body>

<script>
    $(document).ready(mostrarResultados(2023));

    function mostrarResultados(year) {
        $('.resultados').html('<canvas id="grafico"></canvas>');
        $.ajax({
            type: 'POST',
            url: '../includes/procesar.php',
            data: 'year=' + year,
            dataType: 'JSON',
            success: function(response) {
                var Datos = {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    datasets: [{
                        fillColor: 'rgb(0, 0, 255)', //COLOR DE LAS BARRAS
                        strokeColor: 'rgb(0, 0, 255)', //COLOR DEL BORDE DE LAS BARRAS
                        highlightFill: 'rgba(73,206,180,0.6)', //COLOR "HOVER" DE LAS BARRAS
                        highlightStroke: 'rgba(66,196,157,0.7)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                        data: response
                    }]
                }
                var contexto = document.getElementById('grafico').getContext('2d');
                window.Barra = new Chart(contexto).Bar(Datos, {
                    responsive: true
                });
                Barra.clear();
            }
        });
        return false;
    }
</script>

</html>