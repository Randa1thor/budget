<?php

class Edits{

  public $tid=array("tid"=>0);
  public $type_id=array("types_id"=>"");
  public $type_info=array("name"=>"", "descr"=>"");
  public $date=array("date"=>0);

  public $revolving=array("dueday"=>"","startdate"=>"","interim"=>"","enddate"=>"","amount"=>"","accounttypes_id"=>"");

  public $type="";

  function setEdits(array $data){//could use a construct

      $this->tid["tid"]=$data["tid"];
      $this->type["types_id"]=$data["types_id"];
      $this->type["info"]["name"]=$data["name"];
      $this->date["date"]=$data["date"];
      $this->type=$data["types"];

      foreach ($this->revolving as $key => $value) {
          $this->revolving[$key]=$data[$key];
      }
  }

  function editTypeData(){

      if(empty($this->type_id["types_id"])){
          return $this->type_info;
      }

      return array_merge($this->type_id,$this->type_info);

  }


  function editRevolvingData(){
    if(empty($this->tid["tid"])){
      return array_merge($this->type,$this->revolving);
    }

    return array_merge($this->type, $this->revolving, $this->tid);

  }


  function newActualData(){

  }


}



?>
