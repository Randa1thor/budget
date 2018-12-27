function ActualTable(){
  this.actual_container="actuals";
  this.actuals;
  // IDEA:
  //this.row_container="<tr>";//should probably use some kind of array for adjustable html mapping.


  this.fillActuals=function(list){
    this.actuals=JSON.parse(list);
  }

  this.buildhtml=function(id){

    var self=this;
    var s="<caption> Expense Data </caption><tr class=\"table_header\"> <th style=\"display: none;\">ID</td> <th>Date</td> <th>Amount</td> <th>Account</td> </tr>";

    if(this.actuals && id>0){

      this.actuals[id].forEach(function(element){
        if(element["ID"]){//data directly from database

          s+="<tr>";
          s=s+"<td style=\"display: none;\">"+element["ID"]+"</td>";
          s=s+"<td>"+self.getReadableDate(element["Date"])+"</td>";
          s=s+"<td>"+self.displayAmount(element["Amount"])+"</td>";
          s=s+"<td>"+self.selectAccount(element["Affected_Account_ID"])+"</td>";
          s+="</tr>";
        }else{ //data from php class
          s+="<tr>";
          s=s+"<td style=\"display: none;\">"+element["id"]+"</td>";
          s=s+"<td>"+self.getReadableDate(element["date"])+"</td>";
          s=s+"<td>"+self.displayAmount(element["amount"])+"</td>";
          s=s+"<td>"+self.selectAccount(element["affectedaccount_id"])+"</td>";
          s+="</tr>";
        }

      });
    }

    document.getElementById(this.actual_container).innerHTML=s;

  }

  this.displayAmount=function(amount){
    if(!amount){//prob need an getAmount somewhere no design for it though with error handling
      return "";
    }else if(amount!=0){
      return amount.substr(0,amount.length-2) + "." + amount.substr(amount.length-2);
    }else{
			return "";
		}
  }


  this.selectAccount = function(id){
		if(id==0){
			return;
		}
		var sel=document.getElementById("affectedaccount");
		var opts = sel.options;
		var val="accounts"+id;
		for (var opt, j = 0; opt = opts[j]; j++) {
				if (opt.value == val) {
					return opt.text;
				}
			}
	}


  this.pushActual=function (id, data){
    this.actuals[id].push(data);
  }


  this.getReadableDate=function(milidate){

		if(!milidate || milidate==""){
			return "";
		}


		milidate=milidate+"000";//the difference between php strtotime and javascript date.
		d=new Date();
		d.setTime(milidate);


		return (d.getMonth()+1) + "/" + d.getDate() + "/" + d.getFullYear();
	}


}
