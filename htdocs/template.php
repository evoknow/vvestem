<?php

  require_once(__DIR__ . '/word-puzzles/includes/common.php');

  $grade   = 'N/A';

  $student = isset($_REQUEST['student']) ? $_REQUEST['student'] : 'Student'; 

  if (isset($_REQUEST['grade']))
      $grade = get_class_level($_REQUEST['grade']);


?>
<html>
<head>
<base href="http://localhost/">
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
   border: 1px solid #000;
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
<table style="width: 75%; padding-bottom: 05px;">
<tr>
<td>
<img style="width: 150px;" src="images/vve-logo.png">
</td>
<td>
<h2>Valley View Elementary S.T.E.M Expo 2019</h2>
<h3>Puzzle created by <?php echo $student; ?> <?php echo '(' . $grade . ')'; ?></h3>
<p style='text-align: center'>Created at <?php echo date('jS F, Y h:i:s a'); ?></p>
</td>
</tr>
</table>
<div>
<?php echo $contents; ?>
</div>

</body>
</html>
