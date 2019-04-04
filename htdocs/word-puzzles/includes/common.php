<?php

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

function update_play_counter() {
  
   $counter_file =  sys_get_temp_dir() . '/puzzle.play.json';

   if (!file_exists($counter_file)) 
   {
      $json = ['count' => 0];
   } 
   else 
   {
       $json = file_get_contents($counter_file);
       $json = json_decode($json, true);
   }


   $json['count']++;

   file_put_contents($counter_file, json_encode($json));
   return $json['count'];

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
