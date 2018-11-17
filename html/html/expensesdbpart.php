<?php 

require_once("./database/databaseconnect.php");

$sql="SELECT e.*, etype.Type, etype.ID as ET_Type_ID
    FROM expense_type as etype 
    LEFT JOIN expense_revolving as e ON e.Type_ID=etype.ID";

$stmt=$pdo->query($sql);

$types= json_encode($stmt->fetchAll());


$sql="SELECT * FROM account";
    
$stmt=$pdo->query($sql);

$accounts= json_encode($stmt->fetchAll());


echo "{\"accounts\":$accounts, \"types\":$types}";


?>


