    
   <form action="index.php" method="post">
    <?php

    require_once('common.php');

    session_start();

    $class = isset($_REQUEST['class']) ? $_REQUEST['class'] : 'N/A';


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

	   $words_per_column =  round($num_words / 5, 0);

	   $word_table = '<div style="padding: 5px; float: left">';

	   foreach($list as $word) {

	      if ($i != 0 && $i % $words_per_column == 0) {
		   $word_table .= '</div><div style="padding: 5px; float: left">';
	      }

	      $word_table .= '<div style="padding: 2px;">' . strtoupper($word) . '</div>';

	      $i++;
	   }

	   $word_table .= "</div><div style='clear: both;'></div></div>";


	   return $word_table;
   }

    ?>

    <h3 style="text-align: center;">Puzzle Created By N/A  (<?php echo get_class_level($class); ?>)</h3>

    <?php
     
    $word_list = explode("\n", get_input('word_list'));
    $width = 50; // count($word_list) >= 10 ? 40 : 40;

    $solution_puzzle  = "<div id='solution' class='toggle-hidden'>";
    $solution_puzzle .= $find_a_word -> outpTableKey();
    $solution_puzzle .= '</div>';

    $puzzle = "<div style='padding-top: 20px; width:$width%; margin:0 auto' id='solution-sub'>";
    $puzzle .= $find_a_word->outpTable($find_a_word->puzzle);
    //$puzzle .= $solution_puzzle;
    $puzzle .= '</div>';
    
    $list = make_word_table($find_a_word->words);

    $word_block = '<br><div style="width: 90%; margin-left: auto; margin-right: auto; border: 2px solid black;">' . $list . '</div><br>';
    echo $puzzle; 
    echo $word_block;
    
    // echo $solution_puzzle;
    $puzzle_file = save_puzzle($puzzle . $word_block); 

    ?>
    
    <div style="text-align: center" id="solution-show">
        <input type="submit" name="submit" value="Regenerate" />
        &nbsp; &nbsp; &nbsp;
        <input type="button" onClick="toggle('solution');" value="Show solution" />
        &nbsp; &nbsp; &nbsp;
	<a class="button" id="print_link" target=_blank href="/print.php?file=<?php echo $puzzle_file; ?>&grade=<?php echo $class; ?>">Print Puzzle</a>
 
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
