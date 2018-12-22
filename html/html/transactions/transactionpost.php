<?php

class Edits{

  public $tid=array("tid"=>0);
  public $type_id=array("types_id"=>"");
  public $type_info=array("name"=>"", "descr"=>"");
  public $date=array("date"=>"", "startdate"=>"", "enddate"=>"");

  public $interim=array("interim"=>"");

  public $revolving=array("dueday"=>"","amount"=>"","accounttypes_id"=>"");

  public $type;

  function setEdits(array $data){//could use a construct

      $this->tid["tid"]=$data["tid"];
      $this->type_id["types_id"]=$data["types_id"];
      $this->type_info["name"]=$data["name"];

      $this->type=$data["types"];

      foreach ($this->date as $key => $value) {//dates
          $this->date[$key]=strtotime($data[$key]);
      }

      foreach ($this->revolving as $key => $value) {
          $this->revolving[$key]=$data[$key];
      }
      if(!empty($data["interim"]))
        $this->interim["interim"]=$data["interim"]*86400;
  }

  function editTypeData(){

      if(empty($this->type_id["types_id"])){
          return $this->type_info;
      }

      return array_merge($this->type_id,$this->type_info);

  }


  function editRevolvingData(){
    if(empty($this->tid["tid"])){
      return array_merge($this->type_id,$this->revolving,array("startdate"=>$this->date["startdate"],"enddate"=>$this->date["enddate"]),$this->interim);
    }

    return array_merge($this->type_id, $this->revolving,array("startdate"=>$this->date["startdate"],"enddate"=>$this->date["enddate"]),$this->interim, $this->tid);

  }


  function newActualData(){

  }


}



?>
