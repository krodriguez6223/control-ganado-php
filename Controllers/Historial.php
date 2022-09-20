<?php 

require_once 'Libraries/PDF/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


class Historial extends Controllers{
	public function __construct()
	{
       parent:: __construct(); 
	}
	public function reporteHistorial($codigo){

		if (is_numeric($codigo)) {
			$data = $this->model->selectTratamientoIJ($codigo);
			

			    $content = ob_get_clean();
			    $html = getFile("Template/Modals/reporteVista",$data);
			    $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(10,10,10,10));
			    $html2pdf->setDefaultFont('Arial');
			    $html2pdf->writeHTML($html);
			    $html2pdf->output('tratamiento.pdf');
			    $Html2Pdf->Cell(40,10,date('d/m/Y'),0,1,'P');
			   
					}else{
						echo "Dato no válido";	
			}	
	}
		

	public function historialProduccion($codigo){

		if (is_numeric($codigo)) {
			$data = $this->model->selectProduccionIJ($codigo);
			echo '<pre>'; print_r($data); echo '</pre>';
			
			    $content = ob_get_clean();
			    $html = getFile("Template/Modals/historialProduccion",$data);

			    $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(10,10,10,10));
			    $html2pdf->setDefaultFont('Arial');
			    $html2pdf->writeHTML($html);
			    $html2pdf->output('produccion.pdf');
			    $Html2Pdf->Cell(40,10,date('d/m/Y'),0,1,'L');
			   
					}else{
						echo "Dato no válido";	
			}	
	}
		
	
}


 