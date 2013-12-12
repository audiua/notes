<?php

$this->breadcrumbs=array(
	$model->title,
);


$this->menu = array(
			array('label'=>Yii::t('lang_uk', 'Create'), 'url'=>array('create')),
			array('label'=>Yii::t('lang_uk', 'Update'), 'url'=>array('update', 'id'=>$model->id)),
			array('label'=>Yii::t('lang_uk', 'Delete'), 'url'=>array('delete', 'id'=>$model->id))
		);

if(Yii::app()->user->hasFlash('update')):

echo '<div class="flash-success">';
    echo Yii::app()->user->getFlash('update'); 
echo '</div>';

endif;


$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'text',
		'created'=>array(
			'name'=>'created',
			'value'=>Yii::app()->dateFormatter->format("dd.MM.yyyy HH:mm:ss", $model->created),
		),
		'author_id'=>array(
			'name'=>'author_id',
			'value'=>$model->author->login,
		),
)));

if(Yii::app()->user->hasFlash('comment')):

echo '<div class="flash-success">';
    echo Yii::app()->user->getFlash('comment'); 
echo '</div>';

endif;

echo $this->renderPartial('_comment', array('model'=>$comment));

echo $this->renderPartial('_comView', array('model'=>$model));



?>
