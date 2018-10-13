<?php
$cur_date=time();
if (!empty($_POST))
{
    $cur_date=strtotime( $_POST["date"]);
}
$prev_date=strtotime('-1 month', $cur_date);
$next_date=strtotime('+1 month', $cur_date);


$cur_month=date('M',$cur_date);
$cur_day=date("d",$cur_date);
$cur_year=date("Y",$cur_date);


$cur_prev_month=date('M',$prev_date);
$cur_prev_month_days=date('t',$prev_date);

$cur_first_day=date("w", strtotime("$cur_year-$cur_month-01"));
$cur_days_in_month=date("t",strtotime("$cur_year-$cur_month"));

echo "{\"prev_days\":$cur_prev_month_days, \"first_day\": $cur_first_day, " .
     "\"days\":$cur_days_in_month, \"prev_month\": \"" . date('M Y',$prev_date) . 
     "\", \"day\": \"$cur_day\", \"month\": \"$cur_month\", \"year\": $cur_year" .
     ", \"next_month\": \"" . date('M Y',$next_date) ."\"}";


?>




