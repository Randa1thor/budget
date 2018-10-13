function mycalendar(){
	
	this.month;
	this.year;
	this.day;
	this.first_day;
	this.num_of_days;
	this.prev_month;
	this.prev_days;
	this.next_month;
	this.cal_builder=new calendarbasichtml();
	
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
	
	this.set_max_days=function(num_of_days){
		this.num_of_days=num_of_days;
	}
	
	this.set_prev_month=function(prev_month){
		this.prev_month=prev_month;
	}
	
	this.set_next_month=function(next_month){
		this.next_month=next_month;
	}
	
	this.set_all=function(obj){//must have all variables
		  this.set_prev_days(obj.prev_days);
		  this.set_first_day(obj.first_day);
		  this.set_max_days(obj.days);
		  this.set_prev_month(obj.prev_month);
		  this.set_days(obj.month, obj.day, obj.year);
		  this.set_next_month(obj.next_month);
	}
	
	this.show=function(){
		var counter = this.prev_days + 1 - this.first_day;
		var divs=[];
		
		
		//previous month if any
		for (counter; counter<(this.prev_days+1); counter++){
			divs.push(this.build_day(counter));
		}
		
		
		counter=1;//restart to first of the month
		
		var i=this.first_day;//starting at day of week
		
		for (i; i < 7; i++) {//finish first week must always have at least one day of current month
		    divs.push(this.build_day(counter));
		    counter++;
		} 
		
		
		//build month break at last day carry variable i to finish out last week
		
		while(counter<this.num_of_days+1){
			divs.push(this.build_total());
			for (i=0; i<7; i++){
				divs.push(this.build_day(counter));
				counter++;
				if(counter>this.num_of_days){
					break;
				}
			}			
		}
		
		counter=1;  //next month start to finish out last week
		i+=1;
		for (i; i < 7; i++) {//finish last week must always have at least one day of current month
		    divs.push(this.build_day(counter));
		    counter++;
		} 
		
		divs.push(this.build_total());
		
		return divs.join('\n');
	}
	
	
	this.build_day=function(day){
		return ""+this.cal_builder.pre_day + day + this.cal_builder.post_day;
	}
	
	this.build_total=function(){
		return ""+this.cal_builder.pre_total + "&nbsp" + this.cal_builder.post_total;
	}
	
}



function calendarbasichtml(){
	
	this.pre_calendar;
	this.pre_week;
	this.pre_day="";
	
	this.post_calendar;
	this.post_week="";
	this.post_day="";
	
	this.pre_total="";
	this.post_total="";
	
	
	
	this.set_week_html=function(pre, post){
		this.pre_week=pre;
		this.post_week=post;
	}
	
	this.set_day_html=function(pre, post){
		this.pre_day=pre;
		this.post_day=post;
	}
	
	this.set_calendar_html=function(pre, post){
		this.pre_calendar=pre;
		this.post_calendar=post;
	}	
	
	
	this.set_total_html=function(pre, post){
		this.pre_total=pre;
		this.post_total=post;
	}
	
}



