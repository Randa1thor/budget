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

if (!isset($myObj))
    $myObj = new stdClass();

$myObj->prev_days = $cur_prev_month_days;
$myObj->first_day = $cur_first_day;
$myObj->days = $cur_days_in_month;
$myObj->prev_month = date('M Y',$prev_date);
$myObj->day = $cur_day;
$myObj->month = $cur_month;
$myObj->year = $cur_year;
$myObj->next_month = date('M Y',$next_date);

$myJSON = json_encode($myObj); //jsonify's an object



echo "{\"dates\":" . $myJSON . "}";


//find first day of printed week
//find most accurate income to represent 1st week 1st day+
//find actual/revolving bills for income represented before 1st week 1st day
//get actual/revolving bills to next income represent income in total 
//add next income to calendar and do the above




/*echo "{\"prev_days\":$cur_prev_month_days, \"first_day\": $cur_first_day, " .
     "\"days\":$cur_days_in_month, \"prev_month\": \"" . date('M Y',$prev_date) . 
     "\", \"day\": \"$cur_day\", \"month\": \"$cur_month\", \"year\": $cur_year" .
     ", \"next_month\": \"" . date('M Y',$next_date) ."\"}";*/


?>




