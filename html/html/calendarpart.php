<?php

require_once("./calendar/calendardates.php");

$cur_date=time();
if (!empty($_POST))
{
    $cur_date=strtotime( $_POST["date"]);
}

$date_obj=new calendardates($cur_date);

if (!isset($myObj))
    $myObj = new stdClass();


$myObj->prev_days = $date_obj->prev_days;
$myObj->first_day = $date_obj->first_day;
$myObj->days = $date_obj->days;
$myObj->prev_month = $date_obj->prev_month_year;
$myObj->day = $date_obj->day;
$myObj->month = $date_obj->month;
$myObj->year = $date_obj->year;
$myObj->next_month = "$date_obj->next_month_year";
$myObj->firstshownday=date("M d Y",$date_obj->get_first_shown_day());
$myObj->lastshownday=date("M d Y",$date_obj->get_last_shown_day());

$myJSON = json_encode($date_obj); //jsonify's an object



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




