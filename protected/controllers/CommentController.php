<?php

class CommentController extends Controller
{

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}

	public function actionDelete($id, $page)
	{
		if(isset($_GET['id']))
		{
			$note = Note::model()->findByPk($page);
			$comment = Comment::model()->findByPk($id);

			if(Yii::app()->user->id == $note->author_id)
			{
				
				$comment = Comment::model()->findByPk($id)->delete();
				if($comment > 0)
				{
					Yii::app()->user->setFlash('comment','Комментарий успешно удален!');
					$this->redirect(array('note/view','id'=>$page));
				}
			}
			else
			{
				Yii::app()->user->setFlash('comment2','Нельзя удалять чужие комменты');
				$this->redirect(array('note/view','id'=>$page));
			}
		}
	}

	public function actionCreate()
	{
		if(isset($_POST['Comment']))
		{
			$comment = new Comment;

			if(Yii::app()->user->isGuest)
			{
				$comment->scenario = 'Guest';
			}

			$comment->attributes = $_POST['Comment'];

			if($comment->save())
			{
				Yii::app()->user->setFlash('comment','Комментарий успешно добавлен!');
				$this->redirect(array('note/view','id'=>$_POST['Comment']['note_id']));
			}
			else
			{
				Yii::app()->user->setFlash('comment','Комментарий не добавлен!');
				$this->redirect(array('note/view','id'=>$_POST['Comment']['note_id']));
			}
		}
	}
}