<?php 

require_once("./database/databaseconnect.php");


//take post if post get if new type or record or both
if (!empty($_POST))
{
    if($_POST['action']=="update"){
        
    }
    
    if($_POST['action']=="new"){
        
    }
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


