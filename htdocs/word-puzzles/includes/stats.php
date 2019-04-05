<?php


function get_stats() {
 
   $cmd = $_REQUEST['cmd'];

   switch($cmd) {

      case 'class'         : $results = get_class_stats(); break;
      case 'challenges'    : $results = get_challenges_stats(); break;
      case 'solutions'     : $results = get_solutions(); break;
      case 'view_solution' : $results = view_solution(); break;

      default: $results = get_summary_stats();
   }

   return $results;
}

function view_solution() {

    $file = $_REQUEST['file'];

    $filename = basename($file);
    $h        = preg_replace("/Solution_puzzle_/i", 'Solution for Puzzle ', $filename);
    $h        = preg_replace("/\.html/i", '', $h);

    $header = get_stats_header($h);
    $data['header'] = $header;


    $data['contents'] = file_get_contents($file);

    return $data;

}

function get_solutions() {

   $header = get_stats_header('solutions');


   $data['header'] = $header;

   $dir  = sys_get_temp_dir();

   $last = $_SESSION['puzzle_count'];

   for($i=1; $i<= $last; $i++) {

      $data['solutions'][] = $dir . 'solution_puzzle_' .  $i . '.html';

   }

   arsort($data['solutions']);


   return $data;

}


function get_challenges_stats() {

   $header = get_stats_header('challenges');

   $data['header'] = $header;

   $data['stats'] = read_stats();

   $stats = [];

   if (!empty($data['stats']['class']['p']))
       $stats['principal'] = $data['stats']['class']['p'];

   if (!empty($data['stats']['class']['t']))
       $stats['teacher']   = $data['stats']['class']['t'];

   return $stats;
}


function get_class_stats() {

   $header = get_stats_header('class');

   $data['header'] = $header;

   $data['stats'] = read_stats();


   return $data;
}


function get_summary_stats() {

   $header = get_stats_header('summary');

   $data['header'] = $header;

   $data['stats'] = read_stats();

   return $data;
}


function get_stats_header($section) {

   return '<h1>' . ucwords("$section") . '</h1>';
}

function read_stats() {

  $stats_file =  sys_get_temp_dir() . '/puzzle.json';

  if (!file_exists($stats_file))
  	 return false;

  $json = json_decode(file_get_contents($stats_file), true);

  return $json;


}
