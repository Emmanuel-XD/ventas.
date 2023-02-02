<?php


session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location: ./_sesion/login.php");
		die();
	}

require('../fpdf/fpdf.php');
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->image('../img/logo.png', 150, 1, 60); // X, Y, Tamaño
    $this->Ln(20);
    // Arial bold 15
    $this->SetFont('Arial','B',20);
  
    // Movernos a la derecha
    $this->Cell(60);

    // Título
    $this->Cell(70,10,'Reporte de Productos',0,0,'C');
    // Salto de línea
   
    $this->Ln(30);
    $this->SetFont('Arial','B',10);
    $this->SetX(10);
    $this->Cell(40,10,'Codigo de Barra',1,0,'C',0);
    $this->Cell(38,10,'Descripcion',1,0,'C',0,);
    $this->Cell(27,10,'Precio_venta',1,0,'C',0);
    $this->Cell(20,10,'Stock',1,0,'C',0);
    $this->Cell(20,10,'Total',1,0,'C',0);
    $this->Cell(20,10,'Ganancia',1,0,'C',0);
    $this->Cell(22,10,'Fecha',1,1,'C',0);
	

  
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
  
    $this->Cell(0,10,utf8_decode('Página') .$this->PageNo().'/{nb}',0,0,'C');
   //$this->SetFillColor(223, 229,235);
    //$this->SetDrawColor(181, 14,246);
    //$this->Ln(0.5);
}
}

require_once ("db.php");
$consulta = "SELECT * FROM productos";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
//$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));
while ($row=$resultado->fetch_assoc()) {

    $pdf->SetX(10);

    $pdf->Cell(40,10,$row['codigo'],1,0,'C',0);
    $pdf->Cell(38,10,$row['descripcion'],1,0,'C',0);
    $pdf->Cell(27,10,'$'.$row['precioVenta'],1,0,'C',0);
    $pdf->Cell(20,10, $row['existencia'],1,0,'C',0);
    $pdf->Cell(20,10,'$'.$row['precioVenta'] * $row['existencia'],1,0,'C',0);
    $pdf->Cell(20,10,'$'.($row['precioVenta'] - $row['precioCompra']) * $row['existencia'],1,0,'C',0);
    $pdf->Cell(22,10,$row['fecha'],1,1,'C',0);
	


} 


	$pdf->Output();
?>