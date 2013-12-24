<div class="form">

	<?php

		$form = $this->beginWidget('CActiveForm', array(
			'action'=>CHtml::normalizeUrl(array(
				'note/search')),
			'method'=>'post'));

			echo '<div class = "row">';
				echo $form->labelEx($model, 'id');
				echo $form->textField($model, 'id');
			echo '</div>';

			echo '<div class = "row">';
				echo $form->labelEx($model, 'title');
				echo $form->textField($model, 'title');
			echo '</div>';

			echo '<div class = "row">';
				echo $form->labelEx($model, 'author_id');
				echo $form->dropDownList($model,'author_id', Author::all(), array('empty'=>'')); 
			echo '</div>';

			echo '<div class = "row buttons">';
				echo CHtml::submitButton('Искать');
			echo '</div>';

		$this->endWidget();

	?>

</div>