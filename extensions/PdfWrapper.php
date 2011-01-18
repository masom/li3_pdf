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
    	if(is_callable($this->__layout['header'])){
    		$this->__layout['header']();
    	}else{
    		parent::Header();
    	}
    } 
    public function Footer() {
    	if(is_callable($this->__layout['footer'])){
    		$this->__layout['footer']();
    	}else{
    		parent::Footer();
    	}
    }
    public function setCustomLayout($layout){
    	$default = array('header'=> null, 'footer'=>null);
    	$this->__layout = array_merge($default,$layout);
    }
}
?>