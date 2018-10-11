 <!DOCTYPE html>
<html>
<body>
Hello2
<?php
echo "My first PHP script!";
echo file_exists(__DIR__."/budget.sqlite3");
$myPDO = new PDO("sqlite:".__DIR__."/budget.sqlite3");
$result = $myPDO->query("SELECT Type FROM expense_type");
print "These are types\n";
    foreach($result as $row)
    {
        print "Type: ".$row['Type'] . "\n";
    }
$epoch = 1539226804;
echo date('M/d/Y', $epoch). "<br />"; // output as RFC 2822 date - returns local time
$date = new DateTime('10/10/2018'); // format: MM/DD/YYYY
echo $date->format('U');
$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
echo "<br />" . $days[date('w')] . "<nbsp><nbsp>  " .date('M Y');
?>

</body>
</html> 
