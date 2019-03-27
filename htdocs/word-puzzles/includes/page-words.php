	<h2><?php echo htmlspecialchars($page_title); ?></h2>
<?php
use Mike42\WordPuzzles\FindAWord;

$class = isset($_REQUEST['class']) ? $_REQUEST['class'] : 'k';

$word_source = get_input('word_source');

if ($word_source != 'dict' && $class) {
    $word_list_str = join("\n", get_words($class));
} else {

	$findAWord = new FindAWord();
	$lang      = 'en';

	if ($findAWord->loadDictionary($lang)) {

	    $findAWord->loadWords([], 10);

            $word_list_str = join("\n", $findAWord->words);

	} else {
        }
}

function get_words($class) {
  
   $file = realpath($_SERVER['DOCUMENT_ROOT'] . '/../' .  'words.class.'. $class . '.txt');
    
   if (!file_exists($file)) 
       return null;
   
   $list = array_values(array_filter(explode("\n",file_get_contents($file))));
   return $list;

}

if ($word_source == "dict") {
    echo "<p>Please check this list of words.</p>";
} else {
    echo "<p>Please enter the list of words below, one per line:</p>";
} ?>
        <form action="index.php" method="post">

            <div class="form-group">
                <textarea cols=35 rows=15 name="word_list"><?php echo htmlspecialchars($word_list_str); ?></textarea>
            </div>

            <div class="form-group">
		<input type=text name="student" id="student" style="width:100%; padding: 5px;" value="" placeholder="Type Your First Name">
            </div>


            <div class="form-group">
                <button type="submit" name="submit">Make puzzle <i class="glyphicon glyphicon-chevron-right"></i> </button>
            </div>
            <?php echo field("width", $req_width);
                echo field("height", $req_height);
                echo field("lang", $req_lang);
                echo field("diagonal", $req_diagonal);
                echo field("reverse", $req_reverse);
                echo field("class", $_REQUEST['class']);
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
    return "<input type=\"hidden\" name=\"$field\" value=\"".htmlspecialchars($value)."\" />";
}?>
