<?php

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

?>