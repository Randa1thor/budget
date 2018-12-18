<?php 

    class calendardates {
        
        var $cur_date;
        var $first_day;//as index of the day of the week not needed for php
        var $days;//max days in current cursor month
        
        
        var $day;
        var $month;
        var $year;
        
        var $prev_days;
        var $prev_month_year;
        
        
        var $next_month_year;
        
		
		function __construct($cur_date) {		
			$this->cur_date = $cur_date;
			
			$prev_date=strtotime('-1 month', $cur_date);
			$next_date=strtotime('next month', $cur_date);
			
			
			$this->month=date('M',$cur_date);
			$this->day=date("d",$cur_date);
			$this->year=date("Y",$cur_date);
			
			
			$this->prev_month_year=date('M Y',$prev_date);
			$this->prev_days=date('t',$prev_date);
			
			
			$this->next_month_year=date('M Y', $next_date);
			
			
			
			$this->first_day=date("w", strtotime("$this->year-$this->month-01"));
			$this->days=date("t",strtotime("$this->year-$this->month"));
			
			
			
		}
		
		function get_first_shown_day(){
		    if($this->first_day==0){
		        return strtotime("1 $this->month $this->year"); 
		    }
		    
		    $counter = $this->prev_days + 1 - $this->first_day;
		        
		    return strtotime("$counter $this->prev_month_year");
		    
		}
		
		function get_last_shown_day(){
		    $counter= 6-date("w", strtotime("$this->year-$this->month-$this->days"));
		    if($counter==0){
		        return strtotime("$this->days $this->month $this->year");
		    }
		    
		    return strtotime("$counter $this->next_month_year");
		}
 
				
 
	}
	
?>