	<h2><?php echo htmlspecialchars($page_title); ?></h2>
<?php
use Mike42\WordPuzzles\FindAWord;

if ($req_word_source == "dict") {
        $fw_lang = FindAWord::supportedLanguages();
        echo "<p>Please check this list of words. These are from an <b>".$fw_lang[$req_lang] -> name."</b> dictionary.</p>";
} else {
    echo "<p>Please enter the list of words below, one per line:</p>";
} ?>
        <form action="scramble.php" method="post">
            <div class="form-group">
                <textarea cols=35 rows=15 name="word_list"><?php echo htmlspecialchars($word_list_str); ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Make puzzle <i class="glyphicon glyphicon-chevron-right"></i> </button>
            </div>
        </form>

<?php function field($field, $value)
{
    return "<input type=\"hidden\" name=\"$field\" value=\"".htmlspecialchars($value)."\" />";
}?>
