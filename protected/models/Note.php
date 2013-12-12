<?php

/**
 * This is the model class for table "{{note}}".
 *
 * The followings are the available columns in table '{{note}}':
 * @property string $id
 * @property string $title
 * @property string $text
 * @property string $created
 * @property string $author_id
 */
class Note extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{note}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('title, text', 'required'),
			array('title', 'length', 'max'=>255),
			array('id, title, text, created, author_id', 'safe', 'on'=>'mySearch'),// безопасное присваивание
			array('id, title, text, created, author_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'author'=> array(self::BELONGS_TO, 'Author', 'author_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'note_id',
            	'order'=>'comments.created DESC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => Yii::t('lang_uk', 'Title'),
			'text' => Yii::t('lang_uk', 'Text'),
			'created' => Yii::t('lang_uk', 'Created'),
			'author_id' => Yii::t('lang_uk', 'Author_id'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('author_id',$this->author_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Note the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->created = time();
			$this->author_id = Yii::app()->user->id;

			// пишем id автора из арр
		}

		return parent::beforeSave();
	}

	public function afterSave()
	{
		if($this->isNewRecord)
		{
			Yii::log(Yii::app()->user->name.' создал запись: '.$this->title, 'info', 'system.*');
		}
		else
		{
			Yii::log(Yii::app()->user->name.' обновил запись: '.$this->title, 'info', 'system.*');
		}
		
		// пишем в логи 
		// обновлена
		// добавлена
		return parent::afterSave();
	}

	protected function afterDelete()
	{

		// удаляем все комментарии которые прринадлежать удаленной записи
		// пишем лог
		Comment::model()->deleteAll('note_id = '.$this->id);

		Yii::log(Yii::app()->user->name.' удалил запись: '.$this->title, 'info', 'system.*');
	 	
	    return parent::afterDelete();
	    
	}
}
