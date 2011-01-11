<?php
/**
 * li3_pdf: Pdf for Lithium
 *
 * @copyright     Copyright 2011, Martin Samson <pyrolian@gmail.com>
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
namespace li3_pdf\extensions;
use \tcpdf\TCPDF;

class PdfWrapper extends \tcpdf\TCPDF{
    private $__layout = array();
    
    public function Header(){
    	$this->__layout['header']();
    } 
    public function Footer() {
    	$this->__layout['footer']();
    }
    public function setCustomLayout($layout){
    	$this->__layout = $layout;
    }
}
?>