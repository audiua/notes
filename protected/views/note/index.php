<?php

$this->breadcrumbs=array(
	'List',
);

$this->menu = array(
	array('label'=>Yii::t('lang_uk', 'Create'), 'url'=>array('create')),

);

$this->renderPartial('_search', array('model'=>$dataProvider->model));

if(Yii::app()->user->hasFlash('delete')):

echo '<div class="flash-success">';
    echo Yii::app()->user->getFlash('delete'); 
echo '</div>';

endif;

$this->widget('zii.widgets.CListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=> '_note',
		'sortableAttributes'=>array('title','id', 'author_id'),
	));

?>
