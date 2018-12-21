
 //really need to create a function to handle all of this so that eliminates global variables.


 //var transtypes = document.getElementById("types");//global variables are bad should put into an object

 var frm=new form();



 function edittrans(){
   clearEdit();
   var e=document.getElementById("types");

   if(e.options[e.selectedIndex].text=="New" || document.getElementById("editchecked").checked ==true){
     //check if new or editing
     document.getElementById("edittransdiv").style.display="block";
     //show editing div if new leave blank
     if(e.options[e.selectedIndex].text=="New")
       return;
     editNotSaved();

     frm.setEditValues();

   }else{

     document.getElementById("edittransdiv").style.display="none";
     checkSelected();
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
   document.getElementById("transactionerror").innerHTML="";
   //::TODO:: replace clearChildren with form edit clear so that location of elements is not important.
   clearChildren(document.getElementById("edittranscontainer"));//lazy <~~ clear
 }


 function updateTransactions(){
     var f=new form();
     var v={"edits":"","action":""};
     v.edits=f.insertNew();



     if(v.edits.types_id==0){
       v.action="new";
     }
     else {
       v.action="update";
     }

     v.edits=JSON.stringify(v.edits);

     console.log("Printing s: ");
     console.log(JSON.stringify(v));

     loadDoc(JSON.stringify(v),console.log);

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
