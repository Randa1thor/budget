function mycalendar(){
	this.month;
	this.year;
	this.day;
	this.first_day;
	this.num_of_days;
	this.prev_month;
	this.prev_days;
	this.next_month;
	
	
	this.set_days=function(month, day, year){
		this.month=month;
		this.day=day;
		this.year=year;		
	}
	
	this.set_first_day=function(first_day){
		this.first_day=first_day;//numeric to fit array Sun(0)-Sat(6)
	}
	
	this.set_prev_days=function(prev_days){
		this.prev_days=prev_days;
	}
	
	this.show=function(){
		alert(this.month + "-" + this.day);
	}
	
	
	
	
	
}