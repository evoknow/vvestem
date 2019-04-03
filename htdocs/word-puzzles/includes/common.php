<?php

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

         case 'k' : $class_level = 'K'; break;
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
