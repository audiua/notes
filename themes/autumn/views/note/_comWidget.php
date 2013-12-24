<?php 
	echo '<div class = "view">';
			echo CHtml::encode($data->text);
			echo '<br />';
			echo Yii::app()->dateFormatter->format("dd.MM.yyyy HH:mm:ss", $data->created);
			echo '<br />';
			echo CHtml::encode($data->author);
			echo '<br />';
			


			if(Yii::app()->user->id == $model->author->id)
			{
				echo CHtml::link('Delete', array('view', 'delCom'=>$comm->id, 'page'=>$model->id));
			}
			
		echo '</div>';
	

?>