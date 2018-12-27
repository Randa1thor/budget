<?php

require_once("../database/databaseconnect.php");



//retrieve posted data:
$_POST=(array) json_decode(file_get_contents("php://input",true)) ;


$transaction="";
if($_POST['type']=="expenses"){
  $transaction="expense";
}elseif($_POST['type']=="incomes"){
  $transaction="income";
}else{
  exit;//failure
}

$sql="SELECT ID
    FROM " . $transaction . "_type";

$stmt=$pdo->query($sql);

$type_ids=$stmt->fetchAll();


$actuals=new stdClass();

foreach ($type_ids as $obj) {
    $sql="SELECT * FROM " . $transaction . "_actual WHERE Type_ID==:ID ORDER BY Date DESC LIMIT 25";

    $stmt=$pdo->prepare($sql);
    $stmt->execute(array("ID"=>$obj->ID));
    $string="" . $obj->ID;
    $actuals->$string=$stmt->fetchAll();


}

print_r(json_encode($actuals));





?>
