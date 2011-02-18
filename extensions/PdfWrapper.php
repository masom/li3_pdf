<?php
/**
 * li3_pdf: Pdf for Lithium
 *
 * @copyright     Copyright 2011, Martin Samson <pyrolian@gmail.com>
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
namespace li3_pdf\extensions;

use TCPDF;

class PdfWrapper extends TCPDF{
	
	/**
	 * 
	 * Holds the layout callbacks
	 */
    private $__layout = array();
    
    /**
     * 
     * Executes a given render callback method to generate the header
     * @see libraries/tcpdf/tcpdf.TCPDF::Header()
     */
    public function Header(){
    	if(is_callable($this->__layout['header'])){
    		$this->__layout['header']();
    	}else{
    		parent::Header();
    	}
    } 
    
    /**
     * Executes a given render callback method to generate the header
     * @see libraries/tcpdf/tcpdf.TCPDF::Footer()
     */
    public function Footer() {
    	if(is_callable($this->__layout['footer'])){
    		$this->__layout['footer']();
    	}else{
    		parent::Footer();
    	}
    }
    
    /**
     * 
     * Set the layout options for the header and footer
     * @param $layout array
     */
    public function setCustomLayout(array $layout = array()){
    	$default = array('header'=> null, 'footer'=>null);
    	$this->__layout = array_merge($default,$layout);
    }
}
?>
