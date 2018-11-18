<!DOCTYPE html>
 <head>
 <script src="./utilities.js" type="text/javascript"></script>
 <script src="./expenses.js" type="text/javascript"></script>
 </head>
 <html>
 <body>
 
 <div class="title">Expenses</div>
 
 <div id="feedbackdiv"></div>
 
 <div class="typelist">Types</div>
 
 <select id="transtypes" onchange="edittrans()">
 	<option value="apple">Apple</option>
 	<option value="new">New</option>
 </select>
 <input type="checkbox" value=false id="editchecked" onchange="edittrans()">Edit<div id="transactionerror"></div>
 
 <div style="display: none;" id="edittransdiv">
 	<div id="edittranscontainer">
 		Name <input name="transname">
 		Start Date <input name="startdate">
 		Due Date <input name="dueday">
 		Interium Date <input name="interim">(Days)
 		End Date <input name="enddate">
 		<input type="hidden" value="" id="transid">
 	</div>
 </div>
 
 
 
 <div class="accountlist">Accounts</div>
 <select id="accounttypes">
 	<option value="apple">Apple</option>
 	<option value="orange">Orange</option>
 </select>

 
 
 <div>Amount <input id="amount" name="amount"></div>
 <div>Date <input id="date" name="date"></div>

 <div><input type="submit" value="update" onclick="updateTransactions()"></div>
 
 
 
 
 
 
 
 
 
 <script>
	//really need to create a function to handle all of this so that eliminates global variables.
 	document.getElementById("transtypes").selectedIndex="0";
	var transhandler=new transactionhandler();
	var transtypes = document.getElementById("transtypes");
	

	function edittrans(){
		clearEdit();

		if(document.getElementById("transtypes").value=="new" || document.getElementById("editchecked").checked ==true){

			document.getElementById("edittransdiv").style.display="block";
			if(document.getElementById("transtypes").value=="new")
				return;
			editNotSaved();
			


		}else{
			
			document.getElementById("edittransdiv").style.display="none";
			checkSelected();
		}

	}


	function editNotSaved(){
		document.getElementById("transactionerror").innerHTML="Not saved";
	}


	function checkSelected(){
		
		  var str = transtypes.options[transtypes.selectedIndex].value;
		  transhandler.checkEditErrors("transactionerror",str);
	}

	function clearEdit(){
		document.getElementById("transactionerror").innerHTML="";
		clearChildren(document.getElementById("edittranscontainer"));
	}


	function updateTransactions(){
		
	}

	



	function loadDoc() {
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
			  
		      console.log( this.responseText);
		      var obj = JSON.parse(this.responseText);	
				
			  
			  transhandler.fillExpenses(obj.expenses);
			  transhandler.fillAccounts(obj.accounts);
			  transhandler.fillIncomes(obj.incomes);
			  transhandler.buildhtml("transtypes", "accounttypes");

			  checkSelected();
			  
			  
		    }
		  };
		  xhttp.open("POST", "./transactiondbpart.php", true);
		  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	      xhttp.send("");
	      console.log("sending");
		  		
	}

	loadDoc();



 </script>
 </body>
 </html>