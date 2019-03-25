    <form action="index.php" method="post">
    <?php
    foreach ($find_a_word -> failure as $eek) {
        /* Knock failed words off the main list */
        unset($find_a_word -> words[$eek]);
    }
    ?>

    <?php
    echo "<div style='padding-top: 30px;'><table style=''><tr><td valign=\"top\" style=\"padding:1em\">";
    echo "<div id=\"solution\" class=\"toggle-hidden\">";
    echo $find_a_word -> outpTableKey();
    echo "</div>";
    echo "<div id=\"solution-sub\">";
    echo $find_a_word -> outpTable($find_a_word -> puzzle);
    echo "</div>";
    echo "</td><td valign='top'><ul class=\"word-list\">";
    foreach ($find_a_word -> words as $word) {
        echo "<li>".htmlspecialchars($word)."</li>";
    }
    echo "</ul></td>";
    echo "</tr></table></div>";   ?>

    <div id="solution-show">
        <input type="submit" name="submit" value="Regenerate" />
        &nbsp; &nbsp; &nbsp;
        <input type="button" onClick="toggle('solution');" value="Show solution" />
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
