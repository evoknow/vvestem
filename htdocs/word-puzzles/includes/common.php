<?php

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
