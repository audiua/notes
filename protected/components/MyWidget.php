<?php

class MyWidget extends CWidget 
{
	public $mod;
    public function run() 
    {
		$criteria = new CDbCriteria;
		$criteria->compare('note_id', $this->mod->id);

	    $dataProvider = new CActiveDataProvider('Comment', array('criteria'=>$criteria));
		
	    //print_r($dataProvider);

	    if(Yii::app()->user->hasFlash('comment')):
			echo '<div class="flash-success">';
    		echo Yii::app()->user->getFlash('comment'); 
			echo '</div>';
		endif;

		if(Yii::app()->user->hasFlash('comment2')):
			echo '<div class="flash-error">';
    		echo Yii::app()->user->getFlash('comment2'); 
			echo '</div>';
		endif;




	    $this->widget('zii.widgets.CListView',array(
	    	'dataProvider'=>$dataProvider,
			'itemView'=> '_cccc',
			'sortableAttributes'=>array('author'),
		));
    }
}