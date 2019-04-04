<?php
require_once("vendor/autoload.php");
require_once('includes/common.php');
require_once('includes/stats.php');

$cmd     = $_REQUEST['cmd'];

$results = get_stats();

$class_stats = !empty($results['stats']['class']) ? $results['stats']['class'] : null;

//debug($results);
$global = $results['stats']['global'];

// debug($class_stats);
// if ( $global['last'] &&  $global['start'] )
//    $total_time = $global['last'] - $global['start'];
// else
//    $total_time = null;

uasort($class_stats, 'cmp');


function cmp($a, $b) {

   if ($a['count'] == $b['count']) {

        return 0;
    }

    return ($a['count'] > $b['count']) ? - 1 : 1;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Valley View Elementary S.T.E.M</title>
    <link rel="stylesheet" href="assets/css/word-puzzles.css" />
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/local.js"></script>

</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <ul class="nav navbar-nav">
                <li id="home" style="background-color: #ccc;"><a href="/word-puzzles/index.php">Home</a></li>
                <li id="summary" style="background-color: #9400D3;"><a href="/word-puzzles/stats.php?cmd=summary">Summary</a></li>
                <li id="class" style="background-color: #4B0082;"><a href="/word-puzzles/stats.php?cmd=class">Class</a></li>
                <li id="challenges" style="background-color: #0000FF;"><a href="/word-puzzles/stats.php?cmd=challenges">Challenges</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
	<div class="main-panel">
            <div class="table-responsive"><?php echo $results['header']; ?> </div>

            <?php if ($cmd == 'summary'): ?>
                <table class="table">
                    <tr>
                        <td>Total Puzzles Created</td>
                        <td><h3><?php echo $results['stats']['global']['count']; ?></h3></td>
                       
                    </tr>
                    
                    <?php if ($class_stats): ?>

                    <?php foreach($class_stats as $class => $cdata): ?>
                     
                        <tr>
                            <td><?php echo get_class_name($class); ?></td>
                            <td><h3> <?php echo $cdata['count']; ?></h3></td>
                        </tr>
                    
                    <?php endforeach; ?>

                    <?php endif; ?>    
                </table>
            <?php endif; ?>


            <?php if ($cmd == 'class'): ?>
                <table class="table">
                    <tr>
                        <td>Total Puzzles Created</td>
                        <td><h3><?php echo $results['stats']['global']['count']; ?></h3></td>
                       
                    </tr>
                    
                    <?php if ($class_stats): ?>

                    <?php foreach($class_stats as $class => $cdata): ?>
                     
                        <?php foreach($cdata as $teacher => $data): ?>
                            
                            <?php if ($teacher != 'count'): ?>
                            <tr>
                                <td><?php echo get_class_name($class) . ' - ' . $teacher; ?></td>
                                <td><h3> <?php echo $data['count']; ?></h3></td>
                            </tr>
                           <?php endif; ?>
                        <?php endforeach; ?>
                    
                    <?php endforeach; ?>

                    <?php endif; ?>    
                </table>
            <?php endif; ?>

        </div>

	
    </div>
</body>
</html>
