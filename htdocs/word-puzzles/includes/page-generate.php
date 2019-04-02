    
   <form action="index.php" method="post">
    <?php

    require_once('common.php');

    session_start();

    $class = isset($_REQUEST['class']) ? $_REQUEST['class'] : 'N/A';

    $student = get_input('student');

    if (!$student)
	 $student = 'a student';
    else
        $student = ucwords(strtolower($student));

    foreach ($find_a_word -> failure as $eek) {
        /* Knock failed words off the main list */
        unset($find_a_word -> words[$eek]);
    }

    function save_puzzle($puzzle) { 

       $saved       = isset($_SESSION['saved']) ? $_SESSION['saved'] : 1;
       $puzzle_file = tempnam("/tmp", "puzzle-$saved-") . '.html';

       file_put_contents($puzzle_file, $puzzle);

       return $puzzle_file;

    }

     function make_word_table($list) {

	   $i = 0;
	   $word_table = '<div class="list-of-words">';

	   $num_words = count($list);

	   $words_per_column =  max(round($num_words / 8, 0), 1);

	   $word_table = '<div style="padding: 5px; float: left">';

	   foreach($list as $word) {

	      if ($i != 0 && $i % $words_per_column == 0) {
		   $word_table .= '</div><div style="padding: 5px; float: left">';
	      }

	      $word_table .= '<div style="padding: 3px;font-size: 0.9em">' . strtoupper($word) . '</div>';

	      $i++;
	   }

	   $word_table .= "</div><div style='clear: both;'></div></div>";


	   return $word_table;
   }

    ?>

	    <br><h4 style="text-align: center;">
                <?php if (!preg_match("/a\s+student/i", $student)): ?>
		   Puzzle created by <?php echo $student; ?> (<?php echo get_class_level($class); ?>)
                <?php else: ?>
		   <?php echo get_class_level($class); ?> Edition
                <?php endif; ?>
               </h4>

    <?php
     
    $word_list = explode("\n", get_input('word_list'));
    $width = 90; // count($word_list) >= 10 ? 40 : 40;

    $solution_puzzle  = "<div style='padding-top: 20px; width:$width%; margin:0 auto' id='solution'>";
    $solution_puzzle .= $find_a_word -> outpTableKey();
    $solution_puzzle .= '</div>';

    $puzzle = "<div style='padding-top: 20px; width:$width%; margin:0 auto' id='puzzle'>";
    $puzzle .= $find_a_word->outpTable($find_a_word->puzzle);
    $puzzle .= '</div>';

    $list = make_word_table($find_a_word->words);

    $word_block = '<br><div style="width: 90%; margin-left: auto; margin-right: auto; border: 2px solid black;">' . $list . '</div><br>';

    $puzzle_file = save_puzzle($puzzle . $word_block); 

    ?>
    
    <div style="margin-left: auto; margin-right: auto; width: auto;">
<center>
       <div> <?php echo $puzzle;  ?> </div>
        <div id="solution" style="display: none"> <?php echo $solution_puzzle;  ?> </div>
        <div><?php echo $word_block; ?></div>
</center>
    </div>
    
    <div style="text-align: center" id="solution-show">
        <input type="submit" name="submit" value="Regenerate" />
        &nbsp; &nbsp; &nbsp;
        <input type="button" onClick="$('#solution').toggle();$('#puzzle').toggle();" value="Show solution" />
        &nbsp; &nbsp; &nbsp;
	<a class="button" style="border: 1px solid #ccc; background-color: #229FC8; color: white; padding: 8px 15px; border-radius: 3px;" id="print_link" target=_blank 
	   href="/print.php?file=<?php echo $puzzle_file; ?>&student=<?php echo $student; ?>&grade=<?php echo $class; ?>">Print Puzzle</a>
 
    </div>
    <hr/>
    <?php	if (count($find_a_word -> failure) > 0) {
            echo "<p>We couldn't fit all of those words on the puzzle!<ul style=\"color: #f00\">";
        foreach ($find_a_word -> failure as $eek) {
            echo "<li>".$eek."</li>";
        }
            echo "</ul>Press 'regenerate to try again.</p>";
}

        /* All fields here */
        echo field("word_list", join(",", $req_word_list_arr));
        echo field("width", $req_width);
        echo field("height", $req_height);
        echo field("lang", $req_lang);
        echo field("diagonal", $req_diagonal);
        echo field("reverse", $req_reverse);
        echo field("class", $class);
        echo field("student", $student);
        /* Check-box fields, value indicated by presence/absence */
if ($req_fast) {
    echo field("fast", 1);
}
if ($req_slow) {
    echo field("slow", 1);
} ?>
        </form>
<?php function field($field, $value)
{
    return "<input type=\"hidden\" name=\"$field\" value=\"".htmlspecialchars($value)."\" />\n";
}?>
