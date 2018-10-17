<!DOCTYPE html>
 <head>
<link rel="stylesheet" type="text/css" href="calendar.css">
<script src="calendar.js" type="text/javascript"></script>
</head> 
<html>
<body>
<?php

$cur_date=time();

$cur_month=date('M',$cur_date);
$cur_day=date("d",$cur_date);
$cur_year=date("Y",$cur_date);
echo strtotime("10/1/2018") . "<br />";
?>

<div class="container">
<div id="test"></div>
<i class="prev-month fa fa-chevron-left fa-3x" onclick="loadDoc(-1)">[<]</i> <i class="next-month fa fa-chevron-right fa-3x" onclick="loadDoc(1)">[>]</i>
<br>
<div class="month-year text-center"><h3><?php echo "$cur_month  $cur_day $cur_year";?></h3></div>

	<div class="wrapper">
  <main>
    <div class="toolbar">
      <div class="toggle">
        <div class="toggle__option">week</div>
        <div class="toggle__option toggle__option--selected">month</div>
      </div>
      <div class="current-month" id="current_month">June 2016</div>
    </div>
    <div class="calendar">
      <div class="calendar__header">
        <div>sun</div>
        <div>mon</div>	
        <div>tue</div>
        <div>wed</div>
        <div>thu</div>
        <div>fri</div>
        <div>sat</div>
        <div>total</div>
      </div>
      <div class="calendar__week" id="p1">
      </div>
	
</div>


<script>

var someobj=<?php require_once('./calendarpart.php');?>

var mycal = new mycalendar();

mycal.set_all(someobj.dates);

mycal.cal_builder.set_day_html("<div class=\"calendar__day day\">","</div>");

mycal.cal_builder.set_total_html("<div class=\"calendar__day day\">","</div>");

document.getElementById('p1').innerHTML = mycal.show();


function loadDoc(d) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
		  
	      document.getElementById("test").innerHTML = this.responseText;
	      var obj = JSON.parse(this.responseText);	
			
		  mycal.set_all(obj.dates);
		  
		  document.getElementById('p1').innerHTML = mycal.show();
		  document.getElementById('current_month').innerHTML=mycal.month + "  " +mycal.year
	    }
	  };
	  xhttp.open("POST", "calendarpart.php", true);
	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	  if(d>0){
	  	xhttp.send("date="+mycal.next_month);
	  }else{
		  xhttp.send("date="+mycal.prev_month);
	  }		
	}

function loadDocs() {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
		  
	     // document.getElementById("ajax").innerHTML = this.responseText;
	      var obj = JSON.parse(this.responseText);	
			
		  mycal.set_all(obj);
		  
		  document.getElementById('p1').innerHTML = mycal.show();
		  document.getElementById('current_month').innerHTML=mycal.month + "  " +mycal.year
	    }
	  };
	  xhttp.open("POST", "calendarpart.php", true);
	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xhttp.send("date="+mycal.prev_month);
	}





</script>




</body>
</html>