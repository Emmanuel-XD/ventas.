<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

    header("Location:../includes/_sesion/login.php");
}
?>

<div class="modal fade" id="vender" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Realizar Venta <i class="fa fa-shopping-cart" aria-hidden="true"></i></h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <div class="modal-body">

                <form action="../includes/terminarVenta.php" method="POST" name="form" onsubmit="return validar()">
                    <h4>TOTAL: <?php echo  '$', $granTotal; ?></h4>
                    <input name="total" type="hidden" id="val2" value="<?php echo $granTotal; ?>">

                    <br>

                    <div class="form-group">

                        <label for="cliente"><b> EL CLIENTE PAGO CON:</label>
                        <input placeholder="Agrega con cuanto paga el cliente" type="number" onkeypress="comprueba(this)" min="1" pattern="^[0-9]+" id="pago" name="pago" class="form-control" required>
                    </div>

                    <br>

                    <div class="form-group">

                        <label for="cliente"> SU CAMBIO ES:</label>
                        <input step="any" min="1" type="number" name="cambio" id="cambio" class="form-control outlinenone" placeholder="Aqui se refleja el cambio" required>
                        <br>
                        <!-- <button type="button" class="btn btn-outline-secondary btn-sm" onclick="restar()">Calcular <i class="fa fa-plus-square"></i></button>-->
                    </div>

                    <br>
                    <style>
                        .outlinenone {
                            outline: none;
                            background-color: #fff;
                            border: 0;

                        }
                    </style>
                    <div class="row">
                        <div class="col-xs-12">
                            <center>
                                <button type="submit" class="btn btn-primary ">Realizar venta</button>
                            </center>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </form>

    <script>
        let val1 = document.getElementById("pago")
        let val2 = document.getElementById("val2")

        document.getElementById("pago").addEventListener("input", () => {
            document.getElementById("cambio").value = val1.value - val2.value;

            console.log(`es : ${document.getElementById("cambio").value}`)
        })

        var cambio = document.getElementById('pago');

        function comprueba(valor) {
            if (valor.value < 0) {
                valor.value = 1;
            }
        }
    </script>

    <!-- function restar(){
var val1 = parseFloat(document.getElementById('pago').value);
var val2 = parseFloat(document.getElementById('val2').value);
var numberFormat = new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' });

var resta = val1 - val2;
document.form.cambio.value=resta;
}

        let val1 = document.getElementById("pago")
        let val2 = document.getElementById("val2")
        let val3 = document.getElementById("cambio")
        
val1.addEventListener("change", () => {
    var numberFormat = new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' });
            val3.value =  numberFormat.format(parseFloat(val1.value) - parseFloat(val2.value))

        })
-->