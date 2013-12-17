<?php

//10.2 вывод комментариев

/*
кеширует тупо без зависимостей
if($this->beginCache('test_', array('duration'=>3600)))
*/
// ставим зависимость по количеству комментариев
if($this->beginCache('listComment', array('dependency'=>array(
    'class'=>'system.caching.dependencies.CDbCacheDependency',
    'sql'=>'SELECT COUNT(*) FROM tb_comment')))) 

{

	foreach($model->comments as $comm)
	{

		echo '<div class = "view">';
			echo CHtml::encode($comm->text);
			echo '<br />';
			echo Yii::app()->dateFormatter->format("dd.MM.yyyy HH:mm:ss", $comm->created);
			echo '<br />';
			echo CHtml::encode($comm->author);
			echo '<br />';
			


			if(Yii::app()->user->id == $model->author->id)
			{
				echo CHtml::link('Delete', array('view', 'delCom'=>$comm->id, 'page'=>$model->id));
			}
			
		echo '</div>';

	}


$this->endCache();
echo 'not';
}
else
{
	echo 'yes';
}

?>