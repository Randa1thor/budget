function form(){
	//built with select's at end for lazy programming
	this.selectnames=["types","accounttypes"];
	this.inputnames=["name","startdate","dueday","interim","enddate","tid", "amount","date"];
  this.transactionhandler=transactionhandler();


  this.fillTransactions=function (accounts, incomes, expenses){
      this.transactionhandler.fillIncomes(incomes);
      this.transactionhandler.fillAccounts(accounts);
      this.transactionhandler.fillExpenses(expenses);
  }

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


  this.buildhtml=function(expid, accountid, incid){
		this.buildoptions(this.transactionhandler.expenses,expid,true, "expenses");
		this.buildoptions(this.transactionhandler.accounts,accountid,false, "accounts");
	}

	this.checkEditErrors=function(editerrorid, value){
		var v=this.transactionhandler.splitOptionValue(value);
		obj=this.transactionhandler.getTransaction(v[0],v[1]);

		var err="";
		if(!obj.startdate)
			err+=" no start date ";;
		if(!obj.dueday || !obj.interimdays)
			err+=" no cycle/day affected ";
		if(!obj.amount)
			err+= "no amount ";

		this.buildEditError(editerrorid,err);
	}









	this.insertNew=function(){

		var v=Object.assign(this.getInputValues(),this.getSelectValues());
		return v;
	}

	this.getInputValues = function (){
		var result={};

		for (var i = 0; i < this.inputnames.length; i++)
		{
				result[this.inputnames[i]]=document.getElementsByName(this.inputnames[i])[0].value;
		}

		return result;
	}

	this.setEditValues = function(){  //not the best way it would be best to define each needed element
		//will need to upgrade this to use array names to make it more modular
		var e = document.getElementById(this.selectnames[0]);
		var id = e.options[e.selectedIndex].value;
		result=this.transactionhandler.splitOptionValue(id);


		trans=this.transactionhandler.getTransaction(result[0],result[1]);



		document.getElementsByName("name")[0].value=trans.type;
		document.getElementsByName("startdate")[0].value=trans.startdate;
		document.getElementsByName("dueday")[0].value=trans.dueday;
		document.getElementsByName("interim")[0].value=trans.interimdays;
		document.getElementsByName("enddate")[0].value=trans.enddate;
		document.getElementsByName("tid")[0].value=1;//trans.id;

		this.selectAccount(trans.affectedaccountid);

		document.getElementsByName("amount")[0].value=trans.amount;

			 //theres a better way with input node list couldn't get it to work
			console.log(this.transactionhandler.getTransaction(result[0],result[1]));
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
			var s = this.transactionhandler.splitOptionValue(id);
			result[this.selectnames[i]]=s[0];
			result[this.selectnames[i]+"_id"]=s[1];

		}

		return result;
	}



}
