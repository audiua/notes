<?php
class NameCommand extends CConsoleCommand {
    
    public function actionClear() {
        Yii::import( 'application.models.Comment' );

          //$sql= "DELETE from sites WHERE Week like '". $_POST['tYear']."'";
           //"DELETE * FROM {{comment}} WHERE text LIKE '%buy%' || text LIKE '%Dear friend%'"; 

        // $comments = Comment::model()->findAll(
        //   't.text like :deprecated',
        //   array( 
        //     ':deprecated' => '%buy%' 
        //   )
        // );

$deprecate = "text like";
$i = count(Yii::app()->params['spam']) - 1;

$sql = '';

foreach(Yii::app()->params['spam'] as $spam)
{
    if($i == 0)
    {
        $sql .= $deprecate ." '%".$spam."%'";
    }
    else
    {
        $sql .= $deprecate." '%".$spam."%' OR " ;
    }
    
    $i--;
}






        Comment::model()->deleteAll($sql);

        // $query = "SELECT * FROM {{comment}} WHERE text LIKE '%buy%'"; 

        // $connection=Yii::app()->db; 
        // $command=$connection->createCommand($query);
      
        // $rows=$command->queryAll();

        // print_r($rows);

        Yii::log('удалил spam', 'info', 'system.*');	
        
    }
}


/*
DELETE FROM bar where

field1 like '%foo%' 
OR
field2 like '%foo%'
OR
...
fieldLast like '%foo%'

*/