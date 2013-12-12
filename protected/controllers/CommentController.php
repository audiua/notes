<?php

class CommentController extends Controller
{

	public function actionDelete($id)
	{
		$model = Comment::model()->findByPk($id);

		$result = $model->delete();

		if($result > 0)
		{
			Yii::app()->user->setFlash('delete','Комментарий удален!');
		}

		print_r($model);
		$this->render('/note/view', array('model'=>$model, 'comment'=>$comment)); //
	}
		

}