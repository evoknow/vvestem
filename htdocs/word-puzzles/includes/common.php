<?php

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('America/Los_Angeles');

function get_class_name($c) {

  switch ($c) {

     case 't' : $name = "Teachers's Challenge"; break;
     case 'p' : $name = "Principal's Challenge"; break;
     case 'k' : $name = 'Kindergarten'; break;
     case '1' : $name = '1st Grade'; break;
     case '2' : $name = '2nd Grade'; break;
     case '3' : $name = '3rd Grade'; break;
     case '4' : $name = '4th Grade'; break;
     case '5' : $name = '5th Grade'; break;
     case '6' : $name = '6th Grade'; break;
     case 'k' : $name = 'Kindergarten'; break;
     default : $name = "N/A";

  }

  return $name;


}
function get_header() {

   $student = get_input('student');
   $teacher = get_input('teacher');
   $class   = get_input('class');
   $grade   = get_input('grade');

   if (empty($class))
       $class = $grade;

   $level = get_class_level($class);

   if (!in_array($class, ['p', 't'])) {

	   if ($student && $teacher && $level)
	       $header = "Puzzle created by $student ($level - $teacher)";
	   elseif ($student)
		   $header = "Puzzle created by $student";
	   elseif ($teacher && $level)
	       $header = "Puzzle created by a student ($level - $teacher)";
	   else
	       $header = 'Puzzle created at: ' . date('l, F jS Y');
   } else {
 
      if ($class == 'p') {
          $header = "Principal's Challenge Puzzle for <student> <teacher>";
      } else {
	  $header = "Teacher's Challenge Puzzle for <student> <teacher>";
      }

      $student = !empty($student) ? $student : 'student';
      $teacher = !empty($teacher) ? '(' . $teacher . ')' : '';

      $header = preg_replace("/<student>/i", $student, $header);
      $header = preg_replace("/<teacher>/i", $teacher, $header);

   }

   return ucwords($header);

}

function update_play_stats() {
  
   $stats_file =  sys_get_temp_dir() . '/puzzle.json';

   //unlink($stats_file);

   if (!file_exists($stats_file)) 
   {
      $json['global']['count'] = 0;
      $json['global']['start'] = time();
   } 
   else 
   {
       $json = file_get_contents($stats_file);
       $json = json_decode($json, true);
   }

   $json['global']['count']++;

   $class   = get_input('class');
   $teacher = get_input('teacher');
   $student = get_input('student');

   $json['class'][$class]['count']++;
   $json['class'][$class][$teacher]['count']++;
   $json['class'][$class][$teacher]['students'][$student]++;
   $json['global']['last'] = time();


   file_put_contents($stats_file, json_encode($json));
   return $json['global']['count'];

}


function get_class_level($class) {

   switch($class) {

         case 'k' : $class_level = 'Kindergarten'; break;
         case '1' : $class_level = '1st Grade'; break;
         case '2' : $class_level = '2nd Grade'; break;
         case '3' : $class_level = '3rd Grade'; break;
         case '4' : $class_level = '4th Grade'; break;
         case '5' : $class_level = '5th Grade'; break;
         case '6' : $class_level = '6th Grade'; break;
         case 't' : $class_level = 'Teacher'; break;
         case 'p' : $class_level = 'Principal'; break;
         default  : $class_level = '&nbsp';
    }

    return $class_level;
}


function get_input($x) {

    return isset($_REQUEST[$x]) ? $_REQUEST[$x] : '';

}


function debug($x) {

   echo '<PRE>';
   print_r($x);
   echo '</PRE>';
   exit;
}
