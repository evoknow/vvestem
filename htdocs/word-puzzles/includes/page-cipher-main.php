	<h2><?php echo htmlspecialchars($page_title); ?></h2>
    <form action="cipher.php" method="post">
        <p>This is a <b>word cipher</b>, which will encode phrases using a simple substitution cipher. The resulting puzzle is called a &quot;<a href="http://en.wikipedia.org/wiki/Cryptogram">Cryptogram</a>&quot;.</p>

        <p>Type in the text to encode:</p>
        <ul class="radio-list">
            <textarea rows=3 cols=80 name="text">The quick brown fox jumps over the lazy dog.</textarea>
        </ul>

        <p>Please select puzzle language:</p>

        <?php
        use Mike42\WordPuzzles\FindAWord;

        $fw_lang = FindAWord::supportedLanguages();
        foreach ($fw_lang as $lang) {
            $sel_lang[$lang -> code] = $lang -> name;
        } ?>
        <ul class="radio-list">
            <li><?php echo select("lang", $sel_lang, 'en'); ?>
        </ul>

        <p>Other options:</p>
        <ul class="radio-list">
            <li><?php echo checkbox("hint", "Include hint", 1);?></li>
            <li style="display: none;"><?php echo checkbox("symbol", "Use symbols instead of letters", 0);?></li>
        </ul>
    
        <div class="form-group">
            <button type="submit" name="submit">Next step <i class="glyphicon glyphicon-chevron-right"></i> </button>
        </div>
    </form>
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
    $str = "<select name=\"$field\">";
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
