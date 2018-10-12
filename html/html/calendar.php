<!DOCTYPE html>
 <head>
<link rel="stylesheet" type="text/css" href="calendar.css">
<script src="calendar.js" type="text/javascript"></script>
</head> 
<html>
<body>


Current Date: 

<?php

$cur_date=strtotime("11/10/2018");

echo date('l M d Y', $cur_date);

$cur_month=date('M',$cur_date);
$cur_day=date("d",$cur_date);
$cur_year=date("Y",$cur_date);

$cur_first_day=date("l", strtotime("$cur_year-$cur_month-01"));
$cur_days_in_month=date("t",strtotime("$cur_year-$cur_month"));

echo "<br /> " . $cur_month . " 01 $cur_year: $cur_first_day   Days in Month: $cur_days_in_month";

echo "<br />";




?>

<div class="container">
<i class="prev-month fa fa-chevron-left fa-3x">[<]</i> <i class="next-month fa fa-chevron-right fa-3x">[>]</i>
<br>
<div class="month-year text-center"><h3><?php echo "$cur_month  $cur_year";?></h3></div>
<table class="calendar">
	<tr class='calendarheader'>
    	<th>Sunday</th>
    	<th>Monday</th>
    	<th>Tuesday</th>
    	<th>Wednesday</th>
    	<th>Thursday</th>
    	<th>Friday</th>
    	<th>Saturday</th>
    	<th>Total</th>
	</tr>    
	<tr class="weekone">
    	<td>
    		<table class="innercalendarcell">
    			<tr class="dayofmonth">
    				<td>1</td>
    			</tr>
    			<tr class="calendarinfo">
    				<td>&nbsp</td>
    			</tr>
    		</table>
    	</td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
</tr>        
<tr class="weektwo">
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
</tr>    
<tr class="weekthree">
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
</tr>       
<tr class="weekfour">
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
</tr>    
<tr class="weekfive">
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
</tr>       
<tr class="weeksix">
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
    <td>
    	<table class="innercalendarcell">
    		<tr class="dayofmonth">
    			<td>1</td>
    		</tr>
    		<tr class="calendarinfo">
    			<td>&nbsp</td>
    		</tr>
    	</table>
    </td>
</tr>    
</table>    
</div>


<script>

function mycalendar(){
	this.month;
	this.year;
	this.day;
	this.first_day;
	this.num_of_days;
	this.prev_month;
	this.prev_days;
	this.next_month;
	
	
	this.set_days=function(){
		
		alert('hello');
	}
	
	
	
	
}

var viratKohli = new mycalendar();
viratKohli.set_days();
	

</script>




</body>
</html>