<?php

require_once(__DIR__ ."/calendardates.php");

$cur_date=time();
if (!empty($_POST))
{
    $cur_date=strtotime( $_POST["date"]);
}

$date_obj=new calendardates($cur_date);


$myJSON = json_encode($date_obj); //jsonify's an object



echo "{\"hello\":{\"2\":1, \"3\":2},\"dates\":" . $myJSON . "}";


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




