



function form(){
	//built with select's at end for lazy programming
	this.selectnames=["types","accounttypes"];
	this.inputnames=["name","startdate","dueday","interim","enddate","tid", "amount","date"];
  this.transactionhandler=new transactionhandler();


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
		options+="<option value=\"expenses0\">New</option>"

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
		if(!obj.dueday && !obj.interimdays)
			err+=" no cycle/day affected ";
		if(!obj.amount){//best to change to an object get amount;
			err+= "no amount ";
      document.getElementsByName("amount")[0].value="0.00";
    }else{
			console.log("made it to second amount");
      document.getElementsByName("amount")[0].value=obj.amount.substr(0,obj.amount.length-2) + "." + obj.amount.substr(obj.amount.length-2);
    }
    document.getElementsByName("tid")[0].value=obj.tid;

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


		//probably should move to php to catch any data posted to website.
		//correct amount for db insert
		n=result.amount.indexOf(".");

		if(n<0){//-1 no decimal
			result.amount=result.amount+"00";
		}else if(n>result.amount.length-3){
			result.amount=result.amount.substr(0,n)+result.amount.substr(n+1)+"0";
		}else{
			result.amount=result.amount.substr(0,n)+result.amount.substr(n+1);
		}

		return result;
	}

	this.setEditValues = function(){  //not the best way it would be best to define each needed element
		//will need to upgrade this to use array names to make it more modular
		var e = document.getElementById(this.selectnames[0]);
		var id = e.options[e.selectedIndex].value;
		result=this.transactionhandler.splitOptionValue(id);

		trans=this.transactionhandler.getTransaction(result[0],result[1]);//checks for new in transaction.js

		document.getElementsByName("name")[0].value=trans.type;
		document.getElementsByName("startdate")[0].value=this.getReadableDate(trans.startdate);
		document.getElementsByName("dueday")[0].value=trans.dueday;

		if(trans.interimdays!="")
			document.getElementsByName("interim")[0].value=trans.interimdays/86400;
		else {
			document.getElementsByName("interim")[0].value="";
		}

		document.getElementsByName("enddate")[0].value=this.getReadableDate(trans.enddate);
		document.getElementsByName("tid")[0].value=trans.tid;

		this.selectAccount(trans.affectedaccountid);


		if(!trans.amount){//prob need an getAmount somewhere no design for it though with error handling
      document.getElementsByName("amount")[0].value="0.00";
    }else{
			console.log("made it to second amount second method");
      document.getElementsByName("amount")[0].value=trans.amount.substr(0,trans.amount.length-2) + "." + trans.amount.substr(trans.amount.length-2);
    }


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

	this.getReadableDate=function(milidate){

		console.log("milidate: "+milidate);
		if(!milidate || milidate==""){
			return "";
		}


		milidate=milidate+"000";//the difference between php strtotime and javascript date.
		d=new Date();
		d.setTime(milidate);


		return (d.getMonth()+1) + "/" + d.getDate() + "/" + d.getFullYear();
	}



	this.getSelectValues = function (){//might want to break out to individual select retrieval
		var result={};
		for (var i = 0; i < this.selectnames.length; i++)
		{
			var e = document.getElementById(this.selectnames[i]);
			var id = e.options[e.selectedIndex].value;
			var s = this.transactionhandler.splitOptionValue(id);
			result[this.selectnames[i]]=s[0];
			if(s.length<2)//always check length of array
				result[this.selectnames[i]+"_id"]="";
			else
				result[this.selectnames[i]+"_id"]=s[1];

		}

		return result;
	}



}
