<!DOCTYPE html>
 <head>
 <script src="./utilities.js" type="text/javascript"></script>
 <script src="./expenses.js" type="text/javascript"></script>
 </head>
 <html>
 <body>
 
 <div class="title">Expenses</div>
 
 <div id="feedbackdiv"></div>
 
 <div class="typelist">Types
 
 <select id="expensetypes" onchange="editexpense()">
 	<option value="apple">Apple</option>
 	<option value="new">New</option>
 </select>
 <input type="checkbox" value=false id="editchecked" onchange="editexpense()">Edit
 
 <div style="display: none;" id="editexpensediv">
 	<div id="editexpensecontainer">
 		Name <input name="expensename">
 		Start Date <input name="startdate">
 		Due Date <input name="startdate">
 		Interium Date <input name="startdate">(Days)
 		End Date <input name="enddate">
 		<input type="hidden" value="" id="expenseid">
 	</div>
 </div>
 
 
 
 <div class="accountlist">Accounts
 <select id="accounttypes">
 	<option value="apple">Apple</option>
 	<option value="orange">Orange</option>
 </select>
 
 
 
 <div>Amount <input name="amount"></div>
 <div>Date <input name="date"></div>

 <div><input type="submit" value="update"></div>
 
 </div>
 
 
 
 
 
 
 
 <script>

 	document.getElementById("expensetypes").selectedIndex="0";




	function editexpense(){

		if(document.getElementById("expensetypes").value=="new" || document.getElementById("editchecked").checked ==true){
			document.getElementById("editexpensediv").style.display="block";
		}else{
			document.getElementById("editexpensediv").style.display="none";
		}

	}

	



	function loadDoc() {
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
			  
		      console.log( this.responseText);
		      var obj = JSON.parse(this.responseText);	
				
			  var exp=new expenseshandler();
			  exp.fillExpenses(obj.types);
			  exp.fillAccounts(obj.accounts);
			  exp.buildhtml("expensetypes", "accounttypes");
			  
			  
		    }
		  };
		  xhttp.open("POST", "./expensesdbpart.php", true);
		  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	      xhttp.send("");
	      console.log("sending");
		  		
	}

	loadDoc();



 </script>
 </body>
 </html>