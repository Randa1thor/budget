<?php

require_once("../database/databaseconnect.php");
require_once("../transactions/transactionpost.php");


//retrieve posted data:
$_POST=(array) json_decode(file_get_contents("php://input",true)) ;

//$_POST = json_decode(stripslashes(file_get_contents("php://input",true)));

/* if something was posted otherwise treat as fresh db transaction grab
      test if new/update/actual transaction
      New
        insert type [name, Description]
        get inserted id
        use update to create revolving with new type

      update
        test if has transaction
        yes
          update changes to already created transaction
        no
          insert changes

      actual
        put into actual table with date
*/

if (!empty($_POST))
{
    //whole process may error probably need to catch for errors or malformed posted data.


    $edits=new Edits();
    $edits->setEdits((array) json_decode($_POST["edits"]));

    //var_dump(get_object_vars($v));

    $transaction="";
    if($edits->type=="expenses"){
      $transaction="expense";
    }elseif($edits->type=="incomes"){
      $transaction="income";
    }else{
      exit;//failure
    }


    echo "recieved json \n";
    if($_POST['action']=="new"){
      echo "making new type";
      //IDEA:should test for duplicate names!  {feature}  db could refuse by making field unique still have to catch and display error
        $sql="INSERT INTO " . $transaction . "_type
        (Type, Description)
        Values (:name, :descr)";

        $stmt= $dpo->prepare($sql);
        $stmt->execute($edits->editTypeData());

        $edits->type_id["types_id"]  = $db->lastInsertId();
        $_POST["action"]="update";//causes it to fall through

    }//this falls through to update transactions not my favorite but it works
    //// IDEA: would all work better as an object then rather than fall through could call method specifically

    $sql="";//probably a bottle neck strings that resize are problems
    if($_POST["action"]=="update"){//needs to make sure there is even anything worth updating


        echo "updating \n";

        print_r($edits);

        if(empty($edits->tid["tid"])){



          echo "new insert\n";
          $sql = "INSERT INTO " . $transaction . "_revolving
          (Due_Day, Start_Date, Interim, Amount, Type_ID, Affected_Account_ID, Description, End_Date)
          VALUES (:dueday, :startdate, :interim, :amount, :types_id,:accounttypes_id, null, :enddate)";


        }
        else{
          $sql = "UPDATE " . $transaction . "_revolving
          SET Due_Day=:dueday, Start_Date=:startdate, Interim_Days=:interim, Amount=:amount, Type_ID=:types_id, Description=null, Affected_Account_ID=:accounttypes_id, End_Date=:enddate
          WHERE id=:tid";
        }


        echo "revolving data: ";
        print_r($edits->editRevolvingData());
        try {
          $stmt= $pdo->prepare($sql);
          $stmt->execute($edits->editRevolvingData());
        } catch (\PDOException $e) {
             throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }


        if(empty($edits->tid["tid"])){
          $edits->tid["tid"] = $pdo->lastInsertId();
        }
        echo $edits->tid["tid"];
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
