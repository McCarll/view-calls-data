<?php
require_once 'db.php';
ini_set("max_execution_time", "1000"); 
if(isset($_POST['getCalls'])){
    $temp = $_POST['dates'];
    getCalls($temp); 
}
if(isset($_POST['getStore'])){
    getStore($test); 
}
if(isset($_POST['sendDates'])){
    $from = $_POST['dateFrom'];
    $to = $_POST['dateTo'];
    sendDates($from, $to); 
}

//$today="2012/12/22";
//while($today != $data2){    
//    for($i = 0; $i < 24; $i++){//проход по времени в сутки
//        $element = 1; 
//        $result = mysql_query("SELECT DATE_FORMAT(moment,'%Y/%m/%d %H:%m') as eurodate from systemcall where type = 'answer' "
//                . "and moment >= ' ".$today ." ".$i.":00'  and moment <= ' ".$today ."  ".$i.":59'");                        
//        if(!$row = mysql_fetch_assoc($result)){
//            $list[$i] = 0;                
//        }else{
//            $list[$i] += mysql_num_rows($result);
//        }
////        echo $i.': '.$list[$i].'<br>';
//    }
//    $days--;
//    $today=strftime("%Y/%m/%d", strtotime("$today +1 day"));
//}        
//        for($i = 0; $i < 24; $i++){
//            if($list[$i] != 0){
////                $list[$i] = round($list[$i]/(count),1);
//                $list[$i] = round($list[$i]/($count),1);
//            }                
//           echo $i .' :'.$list[$i].'<br>';
//       } 
////    }
       
mysql_close($link);

function getCalls($data){
    $list = array(); 
    for($i = 0; $i < 24; $i++){
        $result = mysql_query("SELECT DATE_FORMAT(moment,'%Y/%m/%d %H:%m') "
        . " as eurodate from systemcall where type = 'answer' and moment >= '".$data." ".$i.":00'  and moment <= '".$data." ".$i.":59';");
//        . " as eurodate from systemcall where type = 'answer' and moment >= '2012/12/22 15:00'  and moment <= '2012/12/22 15:59'");
        if(!mysql_fetch_assoc($result)){
            $list[$i] = 0;
        }else{
            $list[$i] = mysql_num_rows($result);
        }
    }        
//    header('Content-type: application/json');
    echo json_encode($list);
}

function getStore(){
    $result = mysql_query("SELECT DATE_FORMAT(moment,'%Y/%m/%d') as eurodate from systemcall where  type ='answer' ;");
    $i = 0; $temp = null; $list = array();
    while ($row = mysql_fetch_assoc($result)) {        
        if ($row > $temp){
            $list[$i] = $row['eurodate'];
            $i++;
        }
        $temp = $row;
    }
//    header('Content-type: application/json');
    echo json_encode($list);
}

function sendDates($from, $to){  
    while($from != $to){    
        for($i = 0; $i < 24; $i++){//проход по времени в сутки 
            $result = mysql_query("SELECT DATE_FORMAT(moment,'%Y/%m/%d %H:%m') as eurodate from systemcall where type = 'answer' "
                    . "and moment >= ' ".$from ." ".$i.":00'  and moment <= ' ".$from ."  ".$i.":59'");                        
            if(!$row = mysql_fetch_assoc($result)){
                $list[$i] = 0;                
            }else{
                $list[$i] += mysql_num_rows($result);
            }
//            echo json_encode($list);
        }
    $today=strftime("%Y/%m/%d", strtotime("$today +1 day"));
    }  
    $days = date('d', strtotime($to)) - date('d', strtotime($from));
    for($i = 0; $i < 24; $i++){
        if($list[$i] != 0){
            $list[$i] = round($list[$i]/($days),1);
        }
    }    
//    header('Content-type: application/json');
    echo json_encode($list);
}
?>
