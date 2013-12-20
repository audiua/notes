
<div class = "view">
	<?php echo CHtml::encode($data->id); ?>
	<br />
	<?php echo CHtml::encode($data->text); ?>
	<br />
	<?php echo Yii::app()->dateFormatter->format("dd.MM.yyyy HH:mm:ss", $data->created); ?>
	<br />
	<?php echo CHtml::encode($data->author).'<br />'; 


	if(Yii::app()->user->checkAccess('author'))
			{
				echo CHtml::link('Delete', array('comment/delete', 'id'=>$data->id, 'page'=>$data->note_id));
			}
	?>

</div>