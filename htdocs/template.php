<?php

  date_default_timezone_set('America/Los_Angeles');
  
  require_once(__DIR__ . '/word-puzzles/includes/common.php');

  $grade   = 'N/A';

  $student = isset($_REQUEST['student']) ? $_REQUEST['student'] : 'a Student'; 
  $student = ucwords(strtolower($student));
  $teacher = get_input('teacher');

  if (isset($_REQUEST['grade']))
      $grade = get_class_level($_REQUEST['grade']);

?>
<html>
<head>
<base href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/">
<style>

.find-a-word {

   font-size: 1.2em;
   text-align: center;
}

.find-a-word tr {

   border: 1px solid #000;

}

.find-a-word td { 
   width:  35px;
   height: 35px;
   border: 1px solid green;
   padding: 1px;
}

h3 {
  text-align: center;
}

h2 {

  text-align: center;
}

table {
    margin: 0px auto;
}

</style>
</head>
<body>
<table style="width:90%; padding-bottom: 5px;">
<tr>
<td>
<img style="width: 150px;" src="images/vve-official-logo.png">
</td>
<td>
<h2 style="font-size: 2.5em">Valley View Elementary<br>S.T.E.M EXPO 2019</h2>
<?php if (preg_match("/(Teacher|Principal)/i", $grade)): ?>
    <h3>"<?php echo $grade; ?> Edition" Puzzle created by <?php echo $student; ?> <?php echo "($teacher)"; ?></h3>
<?php elseif (!preg_match("/student/i", $student)): ?>
    <h3>Puzzle created by <?php echo $student; ?> <?php echo "($grade - $teacher)"; ?></h3>
<?php else: ?>
   <h3><?php echo $grade . ' Edition'; ?></h3>
<?php endif; ?>

<p style='text-align: center'>Created at <?php echo date('jS F, Y h:i:s a'); ?></p>
</td>
</tr>
</table>
<div>
<?php echo $contents; ?>
</div>
<?php if (0): ?>
<div style="width: 90%; margin-left: auto; margin-right: auto; text-align: justify; font-size: 1.2em;">
<p style="font-weight: bold; text-align: center">
<?php echo !preg_match("/student/i", $student) ? strtoupper($student) . ', ' : ''; ?>THANK YOU FOR VISITING OUR BOOTH TODAY! 
</p>
</div>
<?php endif; ?>

<div style="margin-left: auto; margin-right: auto; width: 90%">
   <div style="float: left"><img style="height: 50px;" src="images/stem-works.jpg"></div>
   <div style="float: right; text-align: right; vertical-align: bottom; padding-top: 5px; color: #000;">
   MADE IN ROCKLIN<br>
   </div>
</div>

</body>
</html>
