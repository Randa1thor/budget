<?php

require_once("./database/databaseconnect.php");


//take post if post get if new type or record or both

$v=(array) json_decode(file_get_contents("php://input",true)) ;
//$v = json_decode(stripslashes(file_get_contents("php://input",true)));
//echo $v;

if (!empty($v))
{
    print_r($v);
    echo "recieved json \n";
    if($v['action']=="new"){

      //should test for duplicate names!  {feature}  db could refuse by making field unique still have to catch and display error
        $sql="INSERT INTO expense_type
        (Type, Description)
        Values (:name, null)";

        $stmt= $dpo->prepare($sql);
        $stmt->execute($v);

        $v["types_id"] = $db->lastInsertId();
        $v["action"]="update";//causes it to fall through

    }//this falls through to update transactions not my favorite but it works

    $sql="";//probably a bottle neck strings that resize are problems
    if($v["action"]=="update"){//needs to make sure there is even anything worth updating
        echo "updating \n";
        if(empty($v["tid"])){



          echo "new insert\n";
          $sql = "INSERT INTO expense_revolving
          (Amount, Type_ID, Affected_Account_ID)
          VALUES (:amount,:types_id,:accounttypes_id)";
        }
        else{
          $sql = "UPDATE expense_revolving
          SET Due_Day=:dueday, Start_Date=:startdate, Interim_Days=:interim, Amount=:amount, Type_ID=:types_id, Description=null, Affected_Account_ID=:accounttypes_id, End_Date=:enddate
          WHERE id=:tid";
        }



        $age = array("amount"=>"3500", "types_id"=>"2", "accounttypes_id"=>"1", "something"=>"2");
        print_r($v);
        try {
          $stmt= $pdo->prepare($sql);
          $stmt->execute($age);
        } catch (\PDOException $e) {
             throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }


        if(empty($v["tid"])){
          $v["tid"] = $pdo->lastInsertId();
        }
        echo $v["tid"];
    }
    exit;
}



$sql="SELECT e.*, etype.Type, etype.ID as ET_Type_ID
    FROM expense_type as etype
    LEFT JOIN expense_revolving as e ON e.Type_ID=etype.ID";

$stmt=$pdo->query($sql);

$expenses= json_encode($stmt->fetchAll());


$sql="SELECT * FROM account";

$stmt=$pdo->query($sql);

$accounts= json_encode($stmt->fetchAll());



$sql="SELECT e.*, etype.Type, etype.ID as ET_Type_ID
    FROM income_type as etype
    LEFT JOIN income_revolving as e ON e.Type_ID=etype.ID";

$stmt=$pdo->query($sql);

$incomes= json_encode($stmt->fetchAll());


echo "{\"accounts\":$accounts, \"expenses\":$expenses, \"incomes\":$incomes}";


?>
