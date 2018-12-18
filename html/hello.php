<!DOCTYPE html>
<head>
</head>
<html>
<body>
Hello2


<?php

require_once("./database/databaseconnect.php");
require_once("./calendar/transactionhandler.php");

echo "My first PHP script!";

$stmt = $pdo->query("SELECT i.id, i.Start_Date, i.Due_Day, i.Interim_Days, i.Last_Actual, i.Amount, it.Type FROM income_revolving  as i INNER JOIN income_type as it ON i.Type_ID = it.ID;");

echo "<br /> hello test <br />" . json_encode($stmt->fetchAll());



$epoch = 1539226804;
echo date('M/d/Y', $epoch). " <------- is M/d/Y  <br />"; // output as RFC 2822 date - returns local time
$date = new DateTime('10/10/2018'); // format: MM/DD/YYYY
echo $date->format('U');
$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
echo "<br />" . $days[date('w')] . "<nbsp><nbsp>  " .date('M Y');


$transaction_handler=new transaction_handler();
$fds=date(strtotime("Oct 28, 2018"));
$lds=date(strtotime("Dec 1, 2018"));


echo "<br /> These are the dates: $fds :::: $lds";
echo "<br /> These are the dates: " . date("M/d/Y",$fds) . " :::: " . date("M/d/Y",$lds);
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />Here starts the new stuff<br />";

$sql = ("SELECT 
    i.id, i.Start_Date, i.Due_Day, i.Interim_Days, i.Last_Actual, i.End_Date, i.Amount, it.Type 
    FROM income_revolving  as i 
    INNER JOIN income_type as it ON i.Type_ID = it.ID 
    WHERE (i.End_Date >= :fds OR i.End_Date IS NULL) AND (i.Last_Actual < :lds OR i.Last_Actual IS NULL)" );

$transaction_handler->get_revolving($sql,$fds, $lds, $pdo);
echo json_encode($transaction_handler->transactions);echo "<br />";



?>

</body>
</html> 
