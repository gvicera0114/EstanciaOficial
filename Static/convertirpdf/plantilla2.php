<?php
	require 'fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{
			$this->Image('images/logo.jpg', 30, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(40);
			$this->Cell(50,10,'Servicios y Precios de la barberia que comienza con P',0,0,'C');
			$this->Ln(40);
		}
		
		function Footer()
		{
			
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>