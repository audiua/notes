
<?php 
	echo '<div class = "view">';
	echo CHtml::encode($data->id);
	echo '<br />';
	echo '<h3>'.CHtml::link(
		CHtml::encode($data->title), 
		array('view', 'id'=>$data->id), 
		array('htmlOptions', 'target'=>'_blank')
		).'</h3>';
	echo '<br />';
	echo CHtml::encode($data->text);
	echo '<br />';
	echo Yii::app()->dateFormatter->format("dd.MM.yyyy HH:mm:ss", $data->created);
	echo '<br />';
	
	echo '<b>'.CHtml::link(
		CHtml::encode($data->author->login), 
		array('search', 'author'=>$data->author_id), 
		array('htmlOptions', 'target'=>'_blank')
		).'</b>';

	echo '</div>';
	

?>






