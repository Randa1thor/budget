

function expense(){
	this.id;
	this.startdate;
	this.enddate;
	this.amount;
	this.lastactual;
	this.duedate;
	this.interimdays;
	this.type;
	this.withdrawlaccount;//may change to affected account
	this.type_id;
	
	this.createExpense=function(obj){
		
		this.id=obj.ID;
		//idea is to have both revolving and type not sure if I should relation actuals to type or revolving
		//sqlite does not have right or full joins so I'm thinking relationing to one table is best
		this.startdate=obj.Start_Date;
		this.enddate=obj.End_Date;
		this.amount=obj.Amount;
		this.lastactual=obj.lastactual;
		this.duedate=obj.Due_Date;
		this.interimdays=obj.Interim_Days;
		this.type=obj.Type;
		this.withdrawlaccountid=obj.Withdrawl_Account_ID;
		
		if(obj.Type_ID){
			this.type_id=obj.Type_ID;			
		}else{
			this.type_id=obj.ET_Type_ID
		}
		
		
		
		
	}
	
}

function account(){
	this.type_id;
	this.type;
	this.tag;
	
	this.createAccount=function(obj){
		this.type_id=obj.ID;
		this.type=obj.Type;
		this.tag=obj.Tag;
	}
}

function expenseshtml(){	
	
	this.buildoptions =function(list, listid, hasnew){
		
		var options="";
		
		for(var k in list){
			options+=this.buildoption(list[k]);
		}
		
		if(hasnew)
		options+="<option value=\"new\">New</option>"
		
		document.getElementById(listid).innerHTML=options;		
	}
	
	this.buildoption=function(item){
		console.log(JSON.stringify(item));
		return "<option id=\"type" + item.type_id + "\" value=\"" + item.type + "\">" + item.type + "</option>";
		
		
	}	
	
}




function expenseshandler(){
	
	this.expenses;
	this.accounts;
	this.exphtml=new expenseshtml();
	
	//takes an arrayed json due to db obj json.encode
	this.fillExpenses=function(list){
		this.expenses=[];
		for(var k in list){
			var e=new expense();
			e.createExpense(list[k]);
			this.expenses.push(e);
		}
	}
	
	this.fillAccounts=function(list){
		this.accounts=[];
		for(var k in list){
			var a=new account();
			a.createAccount(list[k]);
			this.accounts	.push(a);
		}
	}
	
	this.buildhtml=function(expid, accountid){
		this.exphtml.buildoptions(this.expenses,expid,true);
		this.exphtml.buildoptions(this.accounts,accountid,false);
	}
	
	
	
}






