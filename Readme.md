# About
li3_pdf brings PDF support to Lithium using the <http://www.tcpdf.org>  library.

# Versions
- Third Release: li3_pdf is now using a vanilla upstream TCPDF. No more hacking of the library required. Big thanks to Nate Abele.
- Second Release: li3_pdf is a Helper, renderer is deprecated.
- First Release: li3_pdf is a View renderer/loader based on File.

# Setup 

- Download TCPDF
- Extract in app/libraries **or** app/libraries/_source (symlink to app/libraries/tcpdf)

# Application Setup

app/config/bootstrap/libraries.php

```php
Library::add('li3_pdf');
```

## Create a layout:

app/views/layouts/mypdf.pdf.php

```php
<?php
header("Content-type: application/pdf");
echo $this->Pdf->Output('filename.pdf', 'D');
?>
```

## Create a view:

app/views/[controller]/view.pdf.php

```php
<?php
$pdf =& $this->Pdf;
$this->Pdf->setCustomLayout(array(
	'header'=>function() use($pdf){
		list($r, $g, $b) = array(200,200,200);
		$pdf->SetFillColor($r, $g, $b); 
		$pdf->SetTextColor(0 , 0, 0);
		$pdf->Cell(0,15, 'PDF created using Lithium', 0,1,'C', 1);
		$pdf->Ln();
	},
	'footer'=>function() use($pdf){
		$footertext = sprintf('Copyright © %d XXXXXX. All rights reserved.', date('Y')); 
		$pdf->SetY(-20); 
		$pdf->SetTextColor(0, 0, 0); 
		$pdf->SetFont(PDF_FONT_NAME_MAIN,'', 8); 
		$pdf->Cell(0,8, $footertext,'T',1,'C');
	}
));
$this->Pdf->setMargins(10,30,10);
$this->Pdf->SetAuthor('Lithified');
$this->Pdf->SetAutoPageBreak(true);

$this->Pdf->AddPage();
$this->Pdf->SetTextColor(0, 0, 0);
$this->Pdf->SetFont($textfont,'B',20); 
$this->Pdf->Cell(0,14, "Hello World", 0,1,'L');
?>
```

## Rendering the PDF as a normal response
Add the following to app/config/bootstrap/media.php

```php
Media::type('pdf', 'application/pdf', array());
```

Lithium will now automatically serve PDF if a request looks like the following: http://app/controller/action/id.pdf

## Rendering the PDF in a Controller

```php
$view  = new View(array(
	'paths' => array(
		'template' => '{:library}/views/{:controller}/{:template}.{:type}.php',
		'layout'   => '{:library}/views/layouts/{:layout}.{:type}.php',
	)
));

echo $view->render(
	'all',
	array('content' => compact('offer','venue')),
	array(
		'controller' => 'offers',
		'template'=>'view',
		'type' => 'pdf',
		'layout' =>'offers'
	)
);
```
