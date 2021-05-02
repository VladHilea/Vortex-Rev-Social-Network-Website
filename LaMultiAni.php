<?php 
$name = "Vlad";
$age = 16;
$dtA = new DateTime('04/03/2018 3:00PM');
$dtB = date_default_timezone_set('Europe/Bucharest');

if($dtA > $dtB) {
	$age ++;
}



?>

<h1>La multi ani, <?php echo $name; ?></h1>
<h2><?php echo $age;  ?> ani</h2>