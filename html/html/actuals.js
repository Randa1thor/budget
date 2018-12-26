function Actual(){
  this.id;
  this.date;
  this.amount;
  this.type_id;//kind of redundant but probably needed
  this.descr;
  this.affectedaccountid;

  this.createActual=function(obj){
    this.id=obj.id;
    this.date=obj.date;
    this.amount=obj.amount;
    this.type_id=obj.type_id;
    this.descr=obj.descr;
    this.affectedaccountid=obj.affectedaccountid;
  }

  


}
