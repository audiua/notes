<?php 
	$this->menu = array(
		array('label'=>'Create', 'url'=>array('create')),
		array('label'=>'Update', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete', 'url'=>array('delete', 'id'=>$model->id)),

	);
?>

<div class="form">

	<?php

		$form = $this->beginWidget('CActiveForm');

			echo $form->errorSummary($model);

			echo '<div class = "row">';
				echo $form->labelEx($model, 'title');
				echo $form->textField($model, 'title');
			echo '</div>';

			echo '<div class = "row">';
				echo $form->labelEx($model, 'text');
				echo $form->textArea($model, 'text', array('rows'=>10, 'cols'=>80));
			echo '</div>';

			echo '<div class = "row buttons">';
				echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Обновить');
			echo '</div>';

		$this->endWidget();

	?>

</div>