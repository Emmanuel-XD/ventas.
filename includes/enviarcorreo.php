<?php  

// Check for empty fields
if(empty($_POST['nombre'])  ||
   empty($_POST['correo']) 	||
   empty($_POST['numero'])	||
   empty($_POST['mensaje'])	||
   !filter_var($_POST['correo'],FILTER_VALIDATE_EMAIL))
   {
    echo "<script language='JavaScript'>
    alert('Por favor llena todos los campos');
    location.assign('../views/contacto.php');
   </script>";
	return false;
   }
	

// Llamando a los campos
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$numero = $_POST['numero'];
$mensaje = $_POST['mensaje'];

// Datos para el correo
$destinatario = "priscafermugarte@gmail.com";
$asunto = "Correo";

$carta = "De: $nombre \n";
$carta .= "Correo: $correo \n";
$carta .= "Telefono: $numero \n";
$carta .= "Mensaje: $mensaje";

// Enviando Mensaje
mail($destinatario, $asunto, $carta);
echo "<script language='JavaScript'>
alert('Tu mensaje se envio con exito!! Pronto te atenderemos');
location.assign('../views/contacto.php');
</script>";
return true;
?>