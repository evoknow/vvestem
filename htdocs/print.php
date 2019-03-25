<?php

  require_once __DIR__ . '/vendor/autoload.php';

  $file = $_REQUEST['file'];

  $data = [];
  $data['contents'] = file_get_contents($file);

  $results = render($data);

  $mpdf = new \Mpdf\Mpdf( ['tempDir' => '/tmp']);
  $mpdf->WriteHTML($results);
  $mpdf->Output();


  exit;

  function render($data) {

	extract($data);
	 
	ob_start();
	include('template.php');
	$results = ob_get_contents();
	ob_end_clean();
	return $results;

  }
