<?php 

foreach($data->comments as $comment)
{
	echo '<div class = "view">';
		echo CHtml::encode($comment->text);
		echo '<br />';
		echo Yii::app()->dateFormatter->format("dd.MM.yyyy HH:mm:ss", $comment->created);
		echo '<br />';
		echo CHtml::encode($comment->author);
		echo '<br />';

		if(Yii::app()->user->id == $data->author->id)
			{
				echo CHtml::link('Delete', array('view', 'delCom'=>$comment->id, 'page'=>$data->id));
			}

	echo '</div>';

	echo 'widget';
	
}
?>