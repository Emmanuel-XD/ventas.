<?php 

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location:./_sesion/login.php");
		die();
	}
    ?>
<link rel="stylesheet" href="../DataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../css/prueba.css">
    <script src="../js/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/new/bootstrap.min.css">
    <script src="../js/resp/bootstrap.min.js"></script>
    <script src="../js/JsBarcode.all.min.js"></script>

<div class="col-xs-12">
<br>
<h1>Lista de Codigos de Barra</h1>

</div>
<br>
<table class="table table-striped" id= "table_id">
<?php 
require_once ("db.php"); 
$sql="SELECT cd.id, cd.codigo, p.codigo, p.descripcion FROM codbarra cd INNER JOIN productos p ON cd.id_producto = p.id";
$resultado=mysqli_query($conexion,$sql);

//declaramos arreglo para guardar codigos
$codbarra=array();
?>
<?php 
while($fila=mysqli_fetch_assoc($resultado)):
$codbarra[]=(string)$fila['codigo']; 
        ?>
                   
               <thead>    
                <tr >
              
                <th><?php echo $fila['descripcion'] ?>  </th>
              
             </tr>
        </thead>
   <tbody>


<tr>
                 
<td><svg id='<?php echo "barcode".$fila['codigo']; ?>'></td>


</tr>

<?php endwhile;?>

	</body>
  </table>
 <script>
    document.addEventListener("DOMContentLoaded", () => {
        window.print();
        setTimeout(() => {
            window.location.href = "../views/codbarra.php";
        }, 1000);
    });
</script>

<script type="text/javascript">

function arrayjsonbarcode(j){
    json=JSON.parse(j);
    arr=[];
    for (var x in json) {
        arr.push(json[x]);
    }
    return arr;
}

jsonvalor='<?php echo json_encode($codbarra) ?>';
valores=arrayjsonbarcode(jsonvalor);

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