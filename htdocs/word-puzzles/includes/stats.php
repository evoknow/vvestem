<?php

function get_stats() {
 
   $cmd = $_REQUEST['cmd'];

   switch($cmd) {

      case 'class'  : $results = get_class_stats(); break;

      default: $results = get_summary_stats();
   }

   return $results;
}

function get_class_stats() {

   $header = get_stats_header('class');

   $data['header'] = $header;

   $data['stats'] = read_stats();

   debug($data['stats']);

   return $data;
}


function get_summary_stats() {

   $header = get_stats_header('summary');

   $data['header'] = $header;

   $data['stats'] = read_stats();

   return $data;
}


function get_stats_header($section) {

   return '<h1>' . ucwords("$section stats") . '</h1>';
}

function read_stats() {

  $stats_file =  sys_get_temp_dir() . '/puzzle.json';

  if (!file_exists($stats_file))
  	 return false;

  $json = json_decode(file_get_contents($stats_file), true);

  return $json;


}
