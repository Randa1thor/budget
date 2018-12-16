
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





function transactionhandler(){

	this.expenses;
	this.incomes;
	this.accounts;
	//this.transhtml=new transactionshtml();

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
