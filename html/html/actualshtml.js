function ActualTable(){
  this.actual_container="actuals";
  this.actuals;


  this.fillActuals=function(list){
    this.actuals=JSON.parse(list);
  }

  this.buildhtml=function(id){

    var self=this;
    var s="<tr> <td style=\"display: none;\">ID</td> <td>Date</td> <td>Amount</td> <td>Account</td> </tr>";
    
    if(this.actuals && id>0){
      this.actuals[id].forEach(function(element){
        s+="<tr>";
        s=s+"<td style=\"display: none;\">"+element["ID"]+"</td>";
        s=s+"<td>"+self.getReadableDate(element["Date"])+"</td>";
        s=s+"<td>"+self.displayAmount(element["Amount"])+"</td>";
        s=s+"<td>"+self.selectAccount(element["Affected_Account_ID"])+"</td>";
        s+="</tr>";

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
