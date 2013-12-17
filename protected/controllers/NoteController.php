<?php

class NoteController extends Controller
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


	public function filters()
	{
	    return array(
	        'accessControl',
	    );
	}


	public function accessRules()
	{
		return array(

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('create', 'update', 'delete'),
				'roles'=>array('author'),
			),
			
			array('deny',  // deny all users
				'actions'=>array('create', 'update', 'delete'),
				'users'=>array('*'),
			),
		);
	}



	public function actionIndex()
	{
		$criteria = new CDbCriteria;

		$dataProvider = new CActiveDataProvider('Note', array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>10),
			
		));

		$this->render('index', array('dataProvider'=>$dataProvider));
	}

	public function actionView()
	{

		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			$model = Note::model()->findByPk($id);

			$this->render('view', array('model'=>$model, 'comment'=>Comment::model())); //10.2 $comment
		}

		if(isset($_GET['comment']))
		{
			$id = $_GET['id'];
			$model = Note::model()->findByPk($id);

			$this->render('view', array('model'=>$model, 'comment'=>$_GET['comment'])); //10.2 $comment
		}
	}

	public function loadModel($id)
	{
		$model = Note::model()->findByPk($id);

		if($model == null)
		{
			
			throw new CHttpException(404, 'no page');
		}

		return $model;
	}

	public function actionCreate()
	{
		$model = new Note('create');
		//$model->scenario='create';

		if(isset($_POST['Note']))
		{
			$model->attributes = $_POST['Note'];
			if($model->save())
			{
				$this->redirect(array('view', 'id'=>$model->id));
			}
		}
		
		$this->render('create', array('model'=>$model));
	}

	public function actionUpdate($id)
	{

		$model = Note::model()->findByPk($id);

		if(Yii::app()->user->id == $model->author_id)
		{
			if(isset($_POST['Note']))
			{
				$model->attributes = $_POST['Note'];
				if($model->save())
				{
					Yii::app()->user->setFlash('update','Страница обновлена!');
					$this->redirect(array('view', 'id'=>$model->id));
				}
			}
			
			$this->render('create', array('model'=>$this->loadModel($id)));
		}
		else
		{
			Yii::app()->user->setFlash('update','Можно обновлять только свои заметки!');
			$this->redirect(array('view', 'id'=>$model->id));
		}

		
	}

	public function actionDelete($id)
	{
		$model = $this->loadModel($id);

		if(Yii::app()->user->id == $model->author_id)
		{
			$result = $model->delete();

			if($result > 0)
			{
				Yii::app()->user->setFlash('delete','Страница <b>'.$model->title.'</b> удалена!');
			}

			$criteria = new CDbCriteria;

			$dataProvider = new CActiveDataProvider('Note', array(
				'criteria'=>$criteria,
				'pagination'=>array('pageSize'=>10),
				
			));

			$this->render('index', array('dataProvider'=>$dataProvider));
		}
		else
		{
			$criteria = new CDbCriteria;

			$dataProvider = new CActiveDataProvider('Note', array(
				'criteria'=>$criteria,
				'pagination'=>array('pageSize'=>10),
				
			));

			Yii::app()->user->setFlash('delete','Удалять чужие заметки не разрешенно!');
			$this->render('index', array('dataProvider'=>$dataProvider));
		}



		
		
			
	}

	public function actionSearch()
	{
		if(isset($_POST['Note']))
		{
			//$model = new Note('mySearch');
			//$model->attributes = $_POST['Note'];
			//print_r($model->attributes);
			//$model->id = $_POST['Note']['id'];
			//$model->title = $_POST['Note']['title'];


			$criteria = new CDbCriteria;
			$criteria->compare('id', $_POST['Note']['id']);
			$criteria->compare('title', $_POST['Note']['title']);
			$criteria->compare('author_id', $_POST['Note']['author_id']);

		    $dataProvider = new CActiveDataProvider('Note', array('criteria'=>$criteria));
			$dataProvider->model->scenario = 'mySearch';
			$dataProvider->model->attributes = $_POST['Note'];

		    $this->render('index', array('dataProvider'=>$dataProvider));
		}
		else if(isset($_GET['author']))
		{
			$criteria=new CDbCriteria;
			$criteria->condition='author_id = :author';
			$criteria->params=array(':author'=>(int)$_GET['author']);
			$dataProvider = new CActiveDataProvider('Note', array('criteria'=>$criteria));

			$this->render('index', array('dataProvider'=>$dataProvider));
		}
		
	}


}