<?php
/**
 * li3_pdf: Pdf for Lithium
 *
 * @copyright     Copyright 2010, Martin Samson <pyrolian@gmail.com>
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
namespace li3_pdf\extensions;
use \tcpdf\TCPDF;

class PdfWrapper extends \tcpdf\TCPDF{
    private $__header = null;
    private $__footer = null;
    
    public function Header(){
    	call_user_func($this->__header);
    } 
    public function Footer() {
    	call_user_func($this->__footer);
    }
    public function setCustomHeader(&$header){
    	if(is_callable($header)){
    		$this->__header = $header;
    	}
    	
    }
    public function setCustomFooter(&$footer){
    	if(is_callable($footer)){
    		$this->__footer = $footer;
    	}
    }
}
?>