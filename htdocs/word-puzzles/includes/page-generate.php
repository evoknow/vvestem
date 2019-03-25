    
   <form action="index.php" method="post">
    <?php

    session_start();

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

    ?>

    <?php
    $puzzle = "<div style='padding-top: 50px;'>";
    $puzzle .= '<table><tr>';
    $puzzle .= "<div id='solution' class='toggle-hidden'>";
    $puzzle .= $find_a_word -> outpTableKey();
    $puzzle .= '</div><br>';
    $puzzle .= "<div id='solution-sub'>";
    $puzzle .= $find_a_word->outpTable($find_a_word->puzzle);
    $puzzle .= '</div>';
    $puzzle .= '</td>';
    $puzzle .= '</tr></table></div>';
    

    $list = "<ul class='word-list'>";

    foreach ($find_a_word->words as $word) {
        $list .= "<li>".htmlspecialchars($word)."</li>";
    }

    $list .= "</ul>";

    $puzzle .= $list;
    echo $puzzle; 
    $puzzle_file = save_puzzle($puzzle); 

    ?>
    
    <div id="solution-show">
        <input type="submit" name="submit" value="Regenerate" />
        &nbsp; &nbsp; &nbsp;
        <input type="button" onClick="toggle('solution');" value="Show solution" />
        &nbsp; &nbsp; &nbsp;
	<a id="print_link" href="/print.php?file=<?php echo $puzzle_file; ?>">Print Puzzle</a>
 
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
