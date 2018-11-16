<?php 

require_once("./database/databaseconnect.php");

$sql="SELECT * FROM expense_type";

$stmt=$pdo->query($sql);

$types= json_encode($stmt->fetchAll());


$sql="SELECT * FROM account";
    
$stmt=$pdo->query($sql);

$accounts= json_encode($stmt->fetchAll());


echo "{\"accounts\":$accounts, \"types\":$types}";


?>


