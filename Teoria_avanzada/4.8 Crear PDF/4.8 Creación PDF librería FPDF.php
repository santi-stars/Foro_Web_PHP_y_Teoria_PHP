<?php
require("Libreria_FPDF/fpdf.php");  // Cargamos la clase
$pdf = new FPDF();                  // Creamos nuevo objeto
$pdf->AddPage();                    //método para crear CADA PÁGINA del AA Foro
$pdf->SetFont('Arial', 'B', 16);    // Seleccionamos  Arial, negrita y tamaño 16
$pdf->Cell(40, 10, 'Hola Mundo!');     // Creamos una celda con su tamaño y texto a incluir
$pdf->Output(); // se cierra y envía al navegador, se puede guardar en un fichero pasando como parámetro el nombre del archivo
