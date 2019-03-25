<?php

  $student = isset($_REQUEST['student']) ? $_REQUEST['student'] : 'Anonymous'; 
  $grade   = isset($_REQUEST['grade']) ? $_REQUEST['grade'] : 'N/A'; 
  $contents = date('Y-m-d H:i:s A');

?>
<style>

.find-a-word {

   font-size: 1.2em;
   text-align: center;
}

.find-a-word tr {

   border: 1px solid #000;

}

.find-a-word td { 
   width: 40px;
   height: 40px;
   border: 1px solid red;
}

h3 {
  text-align: center;
}

h2 {

  text-align: center;
}

</style>
<table style="width: 100%;padding-bottom: 15px;">
<tr>
<td>
<img style="width: 90px;" src="http://valleyviewptc.com/files/2018/08/VV-logo-color-300x300.png">
</td>
<td>
<h2>Valley View Elementary S.T.E.M Expo 2019</h2>
<h3>Puzzle Created By <?php echo $student; ?> - <?php echo $grade; ?></h3>
</td>
</tr>
</table>

<?php echo $contents; ?>
