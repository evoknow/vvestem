<?php

  date_default_timezone_set('America/Los_Angeles');
  
  require_once(__DIR__ . '/word-puzzles/includes/common.php');

  $grade   = 'N/A';

  $student = isset($_REQUEST['student']) ? $_REQUEST['student'] : 'a Student'; 

  $student = ucwords(strtolower($student));

  if (isset($_REQUEST['grade']))
      $grade = get_class_level($_REQUEST['grade']);


?>
<html>
<head>
<base href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/">
<style>

.find-a-word {

   font-size: 1.4em;
   text-align: center;
}

.find-a-word tr {

   border: 1px solid #000;

}

.find-a-word td { 
   width:  40px;
   height: 40px;
   border: 1px solid green;
   padding: 10px;
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
<img style="width: 150px;" src="images/vve-logo.png">
</td>
<td>
<h2 style="font-size: 2em">Valley View Elementary<br>S.T.E.M Expo 2019</h2>
<?php if (!preg_match("/student/i", $student)): ?>
    <h3>Puzzle created by <?php echo $student; ?> <?php echo '(' . $grade . ' edition)'; ?></h3>
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

</body>
</html>
