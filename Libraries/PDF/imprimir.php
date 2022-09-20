<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */
require_once 'D:\xampp\htdocs\SISTEMA_GANADO\PDF\vendor\autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
    include('reporteVista.php');
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(10,10,10,10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    $html2pdf->output('tratamiento.pdf');
   
    readfile('tratamiento.pdf');

} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
  
