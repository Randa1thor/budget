// TODO: Everything to do with Actuals
/*
  Get Actuals based on name?
  Show actuals based on selection
  allow editing of Actuals

  if type name is updated update retrieved actuals
    intend to use limit for effeciency
  


 */
 //really need to create a function to handle all of this so that eliminates global variables.


 //var transtypes = document.getElementById("types");//global variables are bad should put into an object
 //really this whole thing should be in transactionhtml.js and this should just set if it is expenses or incomes
 //could leave the ajax though it'd make sense to keep it here or another object
 var frm=new form();



 function edittrans(){
   clearEdit();
   var e=document.getElementById("types");

   if(e.options[e.selectedIndex].text=="New"){
     //check if new or editing

     document.getElementById("edittransdiv").style.display="block";
     document.getElementsByName("updatebtn")[0].value="Add New";
     //show editing div if new leave blank
     return


  }else if(document.getElementById("editchecked").checked ==true){
       document.getElementById("edittransdiv").style.display="block";
       editNotSaved();

       frm.setEditValues();
       document.getElementsByName("updatebtn")[0].value="Edit";

   }else{

     document.getElementById("edittransdiv").style.display="none";
     checkSelected();
     document.getElementsByName("updatebtn")[0].value="Save";
   }

 }


 function editNotSaved(){
   document.getElementById("transactionerror").innerHTML="Not saved";
 }


 function checkSelected(){
     var transtypes = document.getElementById("types");
     var str = transtypes.options[transtypes.selectedIndex].value;
     frm.checkEditErrors("transactionerror",str);
 }

 function clearEdit(){

   frm.clearEdits();
   //document.getElementById("transactionerror").innerHTML="";
   //::TODO:: replace clearChildren with form edit clear so that location of elements is not important.
   //::TODO:: is done!
   //clearChildren(document.getElementById("edittranscontainer"));//lazy <~~ clear
 }


 function updateTransactions(){

     var v={"edits":"","action":""};
     v.edits=frm.insertNew();

     if(v.edits.types_id==0){
       v.action="new";
     }
     else {
       v.action="update";
     }

     v.edits=JSON.stringify(v.edits);
     console.log(v);
     loadDoc(JSON.stringify(v),postedDataResponse);

 }





 function postedDataResponse(data){
   console.log(data);
   var obj=JSON.parse(data);
   frm.updateTransaction(obj);
   var index=document.getElementById("types").selectedIndex;
   frm.buildhtml("types");
   document.getElementById("types").selectedIndex=index;
 }


 function firsttime(data){
   console.log( data);
   var obj = JSON.parse(data);

   frm.fillTransactions(obj.accounts, obj.incomes, obj.expenses);

   frm.buildhtml("types", "accounttypes");

   checkSelected();

   edittrans();

 }

 function updateCallback(data){}


 function loadDoc(data, callback) {
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {

         callback(this.responseText);

       }
     };
     xhttp.open("POST", "../html/transactions/transactiondbpart.php", true);
     xhttp.setRequestHeader("Content-type", "application/json");
       xhttp.send(data);
       console.log("sending");

 }

 loadDoc("",firsttime);
