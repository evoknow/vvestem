<?php


  $pdf_generator = '/usr/local/bin/wkhtmltopdf';

  $file = $_REQUEST['file'];

  $data = [];
  $data['contents'] = file_get_contents($file);

  $results = render($data);

  // die($results);

  $html_file = str_replace('.html', '.processed.html', $file);
  $pdf       = str_replace('.html', '.pdf', $file);



  file_put_contents($html_file, $results);

  $cmd = "$pdf_generator --margin-top 30mm --margin-bottom 20mm --margin-left 20mm --margin-right 20mm $html_file $pdf";

  system($cmd);

  if (file_exists($pdf)) {

	    header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
            header("Content-Type: application/pdf");
            header("Content-Disposition: attachment; filename=\"".basename($pdf)."\";");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".@filesize($pdf));
            set_time_limit(0);
            @readfile("$pdf") or die("File not found.");
  } else {

	die("Cannot find file $pdf");
  }
     

  exit;

  function render($data) {

	 
	ob_start();
	extract($data);
	include('template.php');
	$results = ob_get_contents();
	ob_end_clean();
	return $results;

  }
