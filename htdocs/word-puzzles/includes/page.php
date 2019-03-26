<?php
require_once("vendor/autoload.php");
use Mike42\WordPuzzles\FindAWord;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Valley View Elementary S.T.E.M</title>
    <link rel="stylesheet" href="assets/css/word-puzzles.css" />
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <ul class="nav navbar-nav">
                <li style="background-color: #ccc;"><a href="/word-puzzles/index.php">Home</a></li>
                <li style="background-color: #9400D3;"><a href="/word-puzzles/index.php?class=k">Kindergarten</a></li>
                <li style="background-color: #4B0082;"><a href="/word-puzzles/index.php?class=1">1st Grade</a></li>
                <li style="background-color: #0000FF;"><a href="/word-puzzles/index.php?class=2">2nd Grade</a></li>
                <li style="background-color: #00FF00;"><a style="color: black;" href="/word-puzzles/index.php?class=3">3rd Grade</a></li>
                <li style="background-color: #FFFF00;"><a style="color: black;" href="/word-puzzles/index.php?class=4">4th Grade</a></li>
                <li style="background-color: #FF7F00;"><a href="/word-puzzles/index.php?class=5">5th Grade</a></li>
                <li style="background-color: #FF0000;"><a href="/word-puzzles/index.php?class=6">6th Grade</a></li>
                <li style="background-color: #41d6c3;"><a href="/word-puzzles/index.php?class=t">Teacher</a></li>
                <li style="background-color: #152934;"><a href="/word-puzzles/index.php?class=p">Principal</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="main-panel"><?php include("page-".$page_script.".php"); ?>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/local.js"></script>
</body>
</html>
