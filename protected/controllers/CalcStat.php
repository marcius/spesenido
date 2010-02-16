<?php
    $connection = Yii::app()->db;
    $response->page = 1;
    $response->total = 1;
    $response->records = $connection->createCommand("SELECT count(*) from accounts")->queryScalar();
    $command=$connection->createCommand("SELECT id, name from accounts");
    $reader=$command->query();
    $i=0;
    foreach($reader as $row) {
        $response->rows[$i]['id']=$row[id];
        $response->rows[$i]['cell']=array($row[id],$row[name]);
        $i++;
    } 
    echo json_encode($response);
?>        
