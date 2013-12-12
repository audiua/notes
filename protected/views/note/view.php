<?php

$this->breadcrumbs=array(
	$model->title,
);

$this->menu = array(
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'Update', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete', 'url'=>array('delete', 'id'=>$model->id)),

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

?>
