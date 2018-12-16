
function transaction () {
	this.id;
	this.startdate;
	this.enddate;
	this.amount;
	this.lastactual;
	this.duedate;
	this.interimdays;
	this.type;
	this.affectedaccountid;
	this.type_id;

	this.createTransaction = function (obj){

		this.id=obj.ID;
		//idea is to have both revolving and type not sure if I should relation actuals to type or revolving
		//sqlite does not have right or full joins so I'm thinking relationing to one table is best
		this.startdate=obj.Start_Date;
		this.enddate=obj.End_Date;
		this.amount=obj.Amount;
		this.lastactual=obj.Last_Actual_ID;
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



	this.buildhtml=function(expid, accountid, incid){
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
	this.inputnames=["name","startdate","dueday","interium","enddate","tid", "amount","date"];

	this.insertNew=function(){

		var v=Object.assign(this.getInputValues(),this.getSelectValues());
		console.log(v);
		console.log(v.types[0]);
	}

	this.getInputValues = function (){
		var result={};

		for (var i = 0; i < this.inputnames.length; i++)
		{
				result[this.inputnames[i]]=document.getElementsByName(this.inputnames[i])[0].value;
		}

		return result;
	}

	this.setEditValues = function(transhandler){  //not the best way it would be best to define each needed element
		//will need to upgrade this to use array names to make it more modular
		var e = document.getElementById(this.selectnames[0]);
		var id = e.options[e.selectedIndex].value;
		result=transhandler.splitOptionValue(id);


		trans=transhandler.getTransaction(result[0],result[1]);



		document.getElementsByName("name")[0].value=trans.type;
		document.getElementsByName("startdate")[0].value=trans.startdate;
		document.getElementsByName("dueday")[0].value=trans.dueday;
		document.getElementsByName("interium")[0].value=trans.interimdays;
		document.getElementsByName("enddate")[0].value=trans.enddate;
		document.getElementsByName("tid")[0].value=trans.id;

		this.selectAccount(trans.affectedaccountid);

		document.getElementsByName("amount")[0].value=trans.amount;

			 //theres a better way with input node list couldn't get it to work
			console.log(transhandler.getTransaction(result[0],result[1]));
	}


	this.selectAccount = function(id){
		if(id==0){
			return;
		}
		var sel=document.getElementById("accounttypes");
		var opts = sel.options;
		var val="accounts"+id;
		for (var opt, j = 0; opt = opts[j]; j++) {
				if (opt.value == val) {
					sel.selectedIndex = j;
					break;
				}
			}
	}

	this.getSelectValues = function (){//might want to break out to individual select retrieval
		var result={};
		for (var i = 0; i < this.selectnames.length; i++)
		{
			var e = document.getElementById(this.selectnames[i]);
			var id = e.options[e.selectedIndex].value;
			result[this.selectnames[i]]=transhandler.splitOptionValue(id);
		}

		return result;
	}



}
