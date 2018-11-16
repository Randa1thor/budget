

function expenseshtml(){	
	
	this.buildoptions =function(list, listid, hasnew){
		
		var options="";
		
		for(var k in list){
			options+=buildoption(list[k]);
		}
		
		if(hasnew)
		options+="<option value=\"new\">New</option>"
		
		document.getElementById(listid).innerHTML=options;
		
		
	}
	
	function buildoption(item){
		
		return "<option id=\"type" + item.ID + "\" value=\"" + item.Type + "\">" + item.Type + "</option>";
		
		
	}
	
	
	
	
	
	
	
}