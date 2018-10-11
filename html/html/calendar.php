<!DOCTYPE html>
<html>
<body>


Current Date: <?php echo date('l M d Y')?>
<?php
$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');

$cur_month=date('M');
$cur_day=date("d");
$cur_year=date("Y");

$cur_first_day=date("l", strtotime("$cur_year-$cur_month"));
$cur_days_in_month=date("t",strtotime("$cur_year-$cur_month"));

echo "<br />" . $cur_first_day;

echo "<br />";




?>

</body>
</html>