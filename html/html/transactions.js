
function transaction () {
	this.id;
	this.startdate;
	this.enddate;
	this.amount;
	this.lastactual;
	this.duedate;
	this.interimdays;
	this.type;
	this.affectedaccount;//may change to affected account
	this.type_id;

	this.createTransaction = function (obj){

		this.id=obj.ID;
		//idea is to have both revolving and type not sure if I should relation actuals to type or revolving
		//sqlite does not have right or full joins so I'm thinking relationing to one table is best
		this.startdate=obj.Start_Date;
		this.enddate=obj.End_Date;
		this.amount=obj.Amount;
		this.lastactual=obj.lastactual;
		this.dueday=obj.Due_Day;
		this.interimdays=obj.Interim_Days;
		this.type=obj.Type;
		this.affectedaccountid=obj.Affected_Account_ID;

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

	this.createAccount = function(obj){
		this.type_id=obj.ID;
		this.type=obj.Type;
		this.tag=obj.Tag;
	}
}

function transactionshtml(){

	this.buildoptions =function(list, listid, hasnew, type){

		var options="";

		for(var k in list){
			options+=this.buildoption(list[k],type);
		}

		if(hasnew)
		options+="<option value=\"new\">New</option>"

		document.getElementById(listid).innerHTML=options;
	}

	this.buildoption=function(item, type){
		console.log(JSON.stringify(item));
		return "<option  value=\"" + type + item.type_id + "\">" + item.type + "</option>";
	}


	this.buildEditError=function(id, err){

		document.getElementById(id).innerHTML=err;
	}


}




function transactionhandler(){

	this.expenses;
	this.incomes;
	this.accounts;
	this.transhtml=new transactionshtml();

	//takes an arrayed json due to db obj json.encode
	this.fillExpenses=function(list){
		this.expenses=[];
		for(var k in list){
			var e=new transaction();
			e.createTransaction(list[k]);
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

	this.fillIncomes=function(list){
		this.incomes=[];
		for(var k in list){
			var e=new transaction();
			e.createTransaction(list[k]);
			this.incomes.push(e);
		}
	}



	this.buildhtml=function(expid, accountid){
		this.transhtml.buildoptions(this.expenses,expid,true, "expenses");
		this.transhtml.buildoptions(this.accounts,accountid,false, "accounts");
	}

	this.checkEditErrors=function(editerrorid, value){
		var v=this.splitOptionValue(value);
		obj=this.getTransaction(v[0],v[1]);

		var err="";
		if(!obj.startdate)
			err+=" no start date ";;
		if(!obj.dueday || !obj.interimdays)
			err+=" no cycle/day affected ";
		if(!obj.amount)
			err+= "no amount ";

		this.transhtml.buildEditError(editerrorid,err);
	}

	this.getTransaction=function(type, id){
		//could break out to 3 gets to make it more clear.
		var check;
		if(type=="incomes"){
			check=this.incomes;
		}else if(type=="expenses"){
			check=this.expenses;
		}else{
			check=this.accounts;
		}

		return check.find(o => o.type_id === id);

	}

	this.splitOptionValue=function(value){
		//regex return array[2] with [type][id]
		var re = /(\d+)/;
		return value.split(re);

	}



}




function form(){
	//built with select's at end for lazy programming
	this.selectnames=["types","accounttypes"];
	this.inputnames=["name","startdate","dueday","interim","enddate","tid", "amount","date"];

	this.insertNew=function(){

		console.log(JSON.stringify(this.getInputValues()) + JSON.stringify(this.getSelectValues()));
	}

	this.getInputValues = function (){
		var result={};

		for (var i = 0; i < this.inputnames.length; i++)
		{
				result[this.inputnames[i]]=document.getElementsByName(this.inputnames[i])[0].value;
		}

		return result;
	}

	this.getSelectValues = function (){
		var result={};
		for (var i = 0; i < this.selectnames.length; i++)
		{
				result[this.selectnames[i]]=transhandler.splitOptionValue(document.getElementById(this.selectnames[i])[0].value);
		}

		return result;
	}



}
