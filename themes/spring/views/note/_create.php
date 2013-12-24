<?php 
	if($model->isNewRecord)
	{
		$this->menu = array(
			array('label'=>Yii::t('lang_uk', 'Create'),'url'=>array('create'))
		);
	}
	else
	{
		$this->menu = array(
			array('label'=>Yii::t('lang_uk', 'Create'), 'url'=>array('create')),
			array('label'=>Yii::t('lang_uk', 'Update'), 'url'=>array('update', 'id'=>$model->id)),
			array('label'=>Yii::t('lang_uk', 'Delete'), 'url'=>array('delete', 'id'=>$model->id))
		);
	}

	
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
				echo CHtml::submitButton($model->isNewRecord ? Yii::t('lang_uk', 'Save') : Yii::t('lang_uk', 'Update'));
			echo '</div>';

		$this->endWidget();

	?>

</div>