<?php
//require_once("vendor/autoload.php");
require_once('includes/common.php');
require_once('includes/stats.php');

$cmd     = $_REQUEST['cmd'];
$results = get_stats();

$class_stats = !empty($results['stats']['class']) ? $results['stats']['class'] : null;
$global      = !empty($results['stats']['global']) ? $results['stats']['global'] : null;

if (!empty($class_stats))
    uasort($class_stats, 'cmp');

if ($cmd == 'challenges') {

    $cnt  = 0;
    $cnt  = !empty($results['principal']) ? $results['principal']['count'] : 0;
    $cnt += !empty($results['teacher'])   ? $results['teacher']['count']   : 0;

} 

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
                <li id="solution" style="background-color: orange;"><a href="/word-puzzles/stats.php?cmd=solutions">Solutions</a>
                </li>
                <li id="printer" style="background-color: green;"><a target=_blank href="http://localhost:631">Printer</a>
            </ul>
        </div>
    </nav>
    <div class="container">
	<div class="main-panel">
            <div class="table-responsive"><?php echo $results['header']; ?></div>

            <?php if ($cmd == 'summary'): ?>
                <table class="table">
                    <tr>
                        <td><h3>Total Puzzles Created</h3></td>
                        <td><h3><?php echo $results['stats']['global']['count']; ?></h3></td>
                       
                    </tr>
                    
                    <?php if ($class_stats): ?>

                    <?php foreach($class_stats as $class => $cdata): ?>
                     
                        <tr>
                            <td><h3><?php echo get_class_name($class); ?></h3></td>
                            <td><h3> <?php echo $cdata['count']; ?></h3></td>
                        </tr>
                    
                    <?php endforeach; ?>

                    <?php endif; ?>    
                </table>
            <?php endif; ?>


            <?php if ($cmd == 'class'): ?>
                <table class="table">
                    <tr>
                        <td><h3>Total Puzzles Created</h3></td>
                        <td><h3><?php echo $results['stats']['global']['count']; ?></h3></td>
                       
                    </tr>
                    
                    <?php if ($class_stats): ?>

                    <?php foreach($class_stats as $class => $cdata): ?>
                     
                        <?php foreach($cdata as $teacher => $data): ?>
                            
                            <?php if ($teacher != 'count'): ?>
                            <tr>
                                <td><h3><?php echo get_class_name($class) . ' - ' . $teacher; ?></h3></td>
                                <td><h3> <?php echo $data['count']; ?></h3></td>
                            </tr>
                           <?php endif; ?>
                        <?php endforeach; ?>
                    
                    <?php endforeach; ?>

                    <?php endif; ?>    
                </table>
            <?php endif; ?>

            <?php if ($cmd == 'challenges'): ?>
                <table class="table">
                    <tr>
                        <td><h3>Total Challenge Puzzles</h3></td>
                        <td><h3><?php echo $cnt; ?></h3></td>
                       
                    </tr>
                    
                    <?php if ($results): ?>

                    <?php foreach($results as $challenge_type => $cdata): ?>
                     
                        <?php foreach($cdata as $teacher => $data): ?>
                            
                            <?php if ($teacher != 'count'): ?>
                            <tr>
                                <td><h3><?php echo ucwords($challenge_type) . ' - ' . $teacher; ?></h3></td>
                                <td><h3> <?php echo $data['count'] ?></h3></td>
                            </tr>
                           <?php endif; ?>
                        <?php endforeach; ?>
                    
                    <?php endforeach; ?>

                    <?php endif; ?>    
                </table>
            <?php endif; ?>


            <?php if ($cmd == 'solutions'): ?>
                <table class="table">
               

                    <?php if ($results['solutions']) foreach($results['solutions'] as $s): ?>
                      <tr>
                     
                        <td><a target=_blank href="/word-puzzles/stats.php?cmd=view_solution&file=<?php echo $s; ?>"><?php echo preg_replace("/solution_puzzle_/", 'Puzzle ', str_replace('.html', '', basename($s))); ?>
                        </td>
                    </tr>                      
                    <?php endforeach; ?>
        
                </table>
            <?php endif; ?>

            <?php if ($cmd == 'view_solution'): ?>
               <div style="text-align: center;"><?php echo $results['contents']; ?></div>
               <br>
               <p style="text-align: center;">
                 <a href="/word-puzzles/stats.php?cmd=solutions">Back to Solutions</a>
               </p>
            <?php endif; ?>

        </div>

	
    </div>
</body>
</html>
