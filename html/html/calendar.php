<!DOCTYPE html>
<html>
<body>


Current Date: <?php ?>

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
<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
}

.innercalendarcell {
    width: 100%;
}

.dayofmonth td{
    text-align:right;
}

</style>
<div class="container">
<i class="prev-month fa fa-chevron-left fa-3x">[<]</i> <i class="next-month fa fa-chevron-right fa-3x">[>]</i>
<br>
<div class="month-year text-center"><h3><?php echo "$cur_month  $cur_year";?></h3></div>
<table class="table table-bordered">
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
    	</table>
    </td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
</tr>        
<tr class="weektwo">
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
</tr>    
<tr class="weekthree">
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
</tr>       
<tr class="weekfour">
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
</tr>    
<tr class="weekfive">
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
</tr>       
<tr class="weeksix">
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
</tr>    
</table>    
</div>


<script>

$(document).ready(function () {

	  //var d = new Date(); should be able to get all this from server

	  function myCalendar() {// slightly built wrong html should be mostly built classes should be able to handle changes
	    var month = <?php echo $cur_month; ?>;
	    var day = <?php echo $cur_day; ?>;
	    var year = <?php echo $cur_year; ?>;
	    
	    // Displays the current month in Strings and the actual year 

		

	  myCalendar();

	  //Navigation Buttons    

	  $('.prev-month').click(function () {
	    $('.month-year').empty();
	    d.setUTCMonth(d.getUTCMonth() - 1);
	    myCalendar();
	  });

	  $('.next-month').click(function () {
	    $('.month-year').empty();
	    d.setUTCMonth(d.getUTCMonth() + 1);
	    myCalendar();
	  });
	});

</script>




</body>
</html>