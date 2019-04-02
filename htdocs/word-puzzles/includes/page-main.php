<?php

   $class = isset($_REQUEST['class']) ? $_REQUEST['class'] : 'k';
   
   switch($class) {

      case '1' :  $size = 10; $words = 10; break;
      case '2' :  $size = 10; $words = 10; break;
      case '3' :  $size = 12; $words = 12; break;
      case '4' :  $size = 13; $words = 15; break;
      case '5' :  $size = 13; $words = 15; break;
      case '6' :  $size = 13; $words = 15; break;
      case 't' :  $size = 16; $words = 16; break;
      case 'p' :  $size = 16; $words = 16; break;
      default  :  $size = 8; $words = 5;
   }

?>

<div style="padding: 10px; width: 100%;">
<h2><?php echo htmlspecialchars($page_title); ?></h2>
<div style="width: 50%; float: left;">
        <form action="index.php" role="form" class="form-inline" method="post">
            <p>My puzzle will be:</p>
            <ul class="radio-list">
            <?php	for ($i = $find_a_word -> c_min_words; $i <= $find_a_word -> c_max_words; $i++) { /* Contents of word select box */
                    $sel_words[$i] = $i;
}
for ($i = $find_a_word -> c_min_size; $i <= $find_a_word -> c_max_size; $i++) { /* Contents of size box */
    $sel_size[$i] = $i;
}   ?>
                <li><?php echo select("width", $sel_size, $size); ?> x <?php echo select("height", $sel_size, $size); ?> squares, with <?php echo select("word_count", $sel_words, $words); ?> words.</li>
            </ul>
            <p>The words will come from:</p>
            <ul class="radio-list">
                <?php unset($nums);
                for ($i = 1; $i < 250; $i++) {
                    $nums[$i] = $i;
                }?>
                <li><?php echo radio("word_source", "dict", "The dictionary", 0);?></li>
                <li><?php echo radio("word_source", "list", "I will type in a list of words", 1);?></li>
            </ul>
            <div class="toggle toggle-hidden" id="more-options-show">(<a href="JavaScript: void{}" onClick="toggle('more-options')">show</a>)</div>
            <div class="toggle toggle-hidden" id="more-options-hide">(<a href="JavaScript: void{}" onClick="toggle('more-options')">hide</a>)</div>
            <div id="more-options" class="toggle-hidden">
                <p>Word search language:</p>
                <?php
                use Mike42\WordPuzzles\FindAWord;

                $fw_lang = FindAWord::supportedLanguages();
                foreach ($fw_lang as $lang) {
                        $sel_lang[$lang -> code] = $lang -> name;
                } ?>
                <ul class="radio-list">
                    <li><?php echo select("lang", $sel_lang, 'en'); ?>
                </ul>
                <p>Use diagonal words:</p>
                <ul class="radio-list">
                    <li><?php echo radio("diagonal", "half", "Half the time <i>(default)</i>", 1);?></li>
                    <li><?php echo radio("diagonal", "sometimes", "Only if you need to", 0);?></li>
                    <li><?php echo radio("diagonal", "never", "Never", 0);?></li>
                </ul>
                <p>Reverse words:</p>
                <ul class="radio-list">
                    <li><?php echo radio("reverse", "half", "Half the time <i>(default)</i>", 1);?></li>
                    <li><?php echo radio("reverse", "sometimes", "Only if you need to", 0);?></li>
                    <li><?php echo radio("reverse", "never", "Never", 0);?></li>
                </ul>
                <p>Advanced options: <sup><a href="?action=info#special">[info]</a></sup></p>
                <ul class="radio-list">
                    <li><?php echo checkbox("fast", "Use fast mode (for making large puzzles)", 0); ?></li>
                    <li><?php echo checkbox("slow", "Try to switch off PHP's time limit (".ini_get('max_execution_time')." seconds)", 0); ?></li>
                </ul>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Next step <i class="glyphicon glyphicon-chevron-right"></i> </button>
            </div>

           <input type=hidden name="class" value="<?php echo isset($_REQUEST['class']) ? $_REQUEST['class'] : 'k'; ?>">
        </form>
</div>
<div style="margin: 30px; padding: 35px;">
<?php if ($class == '4'): ?>
<img style="margin-left: 10%; align: center;" src="/images/fieldtrip.png">
<h3 style="padding-top: 15px; text-align: center">The 4th graders are on a field trip today!</h3>
<?php else: ?>
<img style="width: 40%; margin-left: 10%; align: center;" src="/images/puzzle.gif">
<?php endif; ?>
</div>
</div>
<?php function radio($field, $value, $caption, $selected = 0)
{
    static $count = 0;
    $id = $field.$count++;
    if ($selected) {
        $checked = " checked=\"checked\"";
    } else {
        $checked = "";
    }
    return "<input type=\"radio\" name=\"$field\" value=\"$value\"$checked id=\"$id\"/> <label for=\"$id\">$caption</label>";
}
function checkbox($field, $caption, $selected = 0)
{
    if ($selected) {
        $checked = " checked=\"checked\"";
    } else {
        $checked = "";
    }
    return "<input type=\"checkbox\" name=\"$field\" $checked id=\"$field\" /> <label for=\"$field\">$caption</label>";
}
function select($field, $options, $selected = 0)
{
    $str = "<select class=\"form-control\" name=\"$field\" id=\"select-$field\">";
    foreach ($options as $id => $caption) {
        if ($id == $selected) {
            $sel = " selected=\"1\"";
        } else {
            $sel = "";
        }
        $str .= "	<option value=\"".htmlspecialchars($id)."\"$sel>".htmlspecialchars($caption)."</option>\n";
    }
    $str .= "</select>";
    return $str;
} ?>
