<?php 
/**
 * li3_pdf: Pdf for Lithium
 *
 * @copyright     Copyright 2011, Martin Samson <pyrolian@gmail.com>
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
namespace li3_pdf\extensions\helper;

use li3_pdf\extensions\PdfWrapper;

class Pdf extends \lithium\template\Helper{
	
	protected $_classes = array(
		'pdf' => 'li3_pdf\extensions\PdfWrapper'
	);
	
	/*
	 * Holds the TCPDF instance
	 */
	private $_pdf = null;
	
	public function _init(){
		parent::_init();
		$this->_pdf = new $this->_classes['pdf'](PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	}
	
	public function __call($method, array $params = array()){
		switch (count($params)) {
			case 0:
				return $this->_pdf->{$method}();
			case 1:
				return $this->_pdf->{$method}($params[0]);
			case 2:
				return $this->_pdf->{$method}($params[0], $params[1]);
			case 3:
				return $this->_pdf->{$method}($params[0], $params[1], $params[2]);
			case 4:
				return $this->_pdf->{$method}($params[0], $params[1], $params[2], $params[3]);
			case 5:
				return $this->_pdf->{$method}($params[0], $params[1], $params[2], $params[3], $params[4]);
			default:
				return call_user_func_array(array(&$this->_pdf, $method), $params);
		}	
	}
}
?>