<?php
use lithium\core\Libraries;
// Config for autoloading the TCPDF library

Libraries::add('tcpdf', array(
	'path' => '/Library/WebServer/Documents/tcpdf',
	'prefix' => false,
	'bootstrap' => false,
	'transform' => function($class, $config) {
		$map = array(
			'TCPDF2DBarcode'     => '2dbarcodes',
			'TCPDFBarcode'       => 'barcodes',
			'TCPDF_UNICODE_DATA' => 'unicode_data',
			'PDF417'             => 'pdf417',
			'TCPDF'              => 'tcpdf',
			'QRcode'             => 'qrcode'
		);
		if (!isset($map[$class])) {
			return false;
		}
		return "{$config['path']}/{$map[$class]}{$config['suffix']}";
	}
));

?>
