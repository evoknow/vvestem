<?php

  $student = isset($_REQUEST['student']) ? $_REQUEST['student'] : 'Anonymous'; 
  $grade   = isset($_REQUEST['grade']) ? $_REQUEST['grade'] : 'N/A'; 


?>
<html>
<head>
<style>

.find-a-word {

   font-size: 1.2em;
   text-align: center;
}

.find-a-word tr {

   border: 1px solid #000;

}

.find-a-word td { 
   width:  40px;
   height: 40px;
   border: 1px solid red;
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
<table style="width: 90%;border: 1px solid green; padding-bottom: 15px;">
<tr>
<td>
<img style="width: 100px;" src="http://valleyviewptc.com/files/2018/08/VV-logo-color-300x300.png">
</td>
<td>
<h2>Valley View Elementary S.T.E.M Expo 2019</h2>
<h3>Puzzle Created By <?php echo $student; ?> - <?php echo $grade; ?></h3>
</td>
</tr>
</table>
<h2>Your Word Search Puzzle </h2>
<p style='text-align: center'>Created at the Valley View Elementary S.T.E.M. Expo <?php echo date('m/d/y h:i:s a'); ?></p>
<div style="margin-left: auto;margin-right: auto;">
<?php echo $contents; ?>
</div>

</body>
</html>
