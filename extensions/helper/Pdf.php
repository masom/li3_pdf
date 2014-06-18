<?php 
/**
 * li3_pdf: Pdf for Lithium
 *
 * @copyright     Copyright 2011, Martin Samson <pyrolian@gmail.com>
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
namespace li3_pdf\extensions\helper;

use li3_pdf\extensions\PdfWrapper;

class Pdf extends \lithium\template\Helper {
	
	protected $_classes = array(
		'pdf' => 'li3_pdf\extensions\PdfWrapper'
	);
	
	/*
	 * Holds the TCPDF instance
	 */
	private $_pdf = null;
	
	/**
	 * The page orientation based on TCPDF parameters
	 */
	public $orientation = 'P';
	
	/**
	 * The page units based on TCPDF parameters
	 */
	public $unit = 'mm';
	
	/**
	 * The page dimensions format based on TCPDF parameters
	 */
	public $format = 'LETTER';
	
	/**
	 * Whether to render in Unicode
	 */
	public $unicode = true;
	
	/**
	 * Encoding based on TCPDF parameters
	 */
	public $encoding = 'UTF-8';
	
	/**
	 * Whether to reduce memory usage by caching temporary data on file system
	 */
	public $diskcache = false;
	
	/**
	 * Sets PDF/A mode
	 */
	public $pdfa = false;
	
	public function _init() {
		parent::_init();
		$this->_pdf = new $this->_classes['pdf'](
			$this->orientation,
			$this->unit,
			$this->format,
			$this->unicode,
			$this->encoding,
			$this->diskcache,
			$this->pdfa
		);
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