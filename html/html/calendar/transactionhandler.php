<?php 

class transaction_handler{
    
    var $transactions=array();
    
    
    function get_revolving($sql, $fds, $lds, $pdo){
        // get all revolving where no actuals are > the month..... it takes more logic to add both actuals
        // and revolving so they don't overlap.
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute(['fds' => $fds, 'lds' => $lds]);
        
        while ($row = $stmt->fetch())
        {
            if ($row->Due_Day=="") {
                $this->push_interim($fds, $lds, $row);
            }
            else{
                $this->push_specific_day($fds, $lds, $row);
            }
        }
        
        //interim
        //   get last actual or  start date if null loses accuracy moving from start date is more accurate
        //   subtract last date shown from income date
        //   modelo interim from total
        //   divide 86400 if > 0
        //   use date to move backwards that many days
        //   use date again to move backwards days of interim after first date until < last date shown
    }
    
    
    function push_interim($fds, $lds, $transaction){
        //assumes db query tested end date was >fds
        $check_date=$lds-$transaction->Start_Date;
        $check_date=$lds-$check_date%$transaction->Interim_Days;
        
        echo "<br /> interim start date: " . date("M/d/Y",$transaction->Start_Date);
        
        //could probably pull out test for end date as it is generally not needed
        //only if there are performance issues i guess
        while($check_date>=$fds){
            
            if($check_date<=$transaction->Last_Actual){
                return;
            }
            if($transaction->End_Date!="" and $check_date>$transaction->End_Date){
                $check_date=$check_date-$transaction->Interim_Days;
                continue;
            }
            echo "<br /> interim: " . date("M/d/Y",$check_date);
            $this->transactions[]=$transaction;
            
            $check_date=$check_date-$transaction->Interim_Days;
            
        }
    }
    
    
    
    function push_specific_day($fds, $lds, $transaction){
        //moving backwards from lds assumes sql query tested for actual < lds
        $check_month=date("M",$lds);
        $check_year=date("Y",$lds);
        $check_date=strtotime("$check_month $transaction->Due_Day, $check_year");
        
        //this function is repeated could probably be a loop or recursive
        
        
        if($check_date <= $transaction->Last_Actual){
            return;
        }
        
        if($check_date > $lds){
                
        }else{
           $this->transactions[]=$transaction;
        }
        
        
        
        //check one to two months back if due day is >21  28-7
        $x=0;
        if($transaction->Due_Day>21){
            $x=1;
        }
        
        for($x;$x<2;$x++){
            
            $check_date=strtotime("-1 month",$check_date);
            
            
            if($check_date <= $transaction->Last_Actual){
                return;
            }
            
            if($check_date < $fds){
                
                return;
                
            }else{
                
                $this->transactions[]=$transaction;
                
            }
            
        }
        
        
        
        //should never need another check.  if due day is <22  28-7
        //the lds should always be less than the fds by many days
        //however need to find first income available in first week shown...... logically   
        
        
    }
}


/*

Need first shown date....  
          might be efficient to test for incomes on first shown date......
          
get revolving incomes without end dates < 1 month previous to current month.  
          this system will not support incomes that are not at least monthly.

get actual incomes >= first shown day <=last shown day


SELECT i.id, i.Start_Date, i.Due_Day, i.Interim_Days, i.Last_Actual, i.Amount, i.End_Date, it.Type 
FROM income_revolving  as i 
INNER JOIN income_type as it ON i.Type_ID = it.ID;


probably need to create a class for this date class does most of it though date(-1 week, $cur_date)

86400 a day .... should divide equally in modulo of 1st shown day - start-date 
 */






?>