<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property string $id
 * @property string $name
 * @property string $pic
 * @property string $url
 * @property string $header
 * @property string $date
 * @property string $position
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $preview
 * @property string $body
 * @property string $isMainPage
 * @property string $isShow
 * @property string $onMainList
 * @property string $isTopOnMain
 * @property string $isTopOnSections
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, pic, url, header, date, title, keywords, description, preview, body', 'required'),
			array('name, pic, url, header, title, keywords', 'length', 'max'=>255),
			array('position', 'length', 'max'=>10),
			array('isMainPage, isShow, onMainList, isTopOnMain, isTopOnSections', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, pic, url, header, date, position, title, keywords, description, preview, body, isMainPage, isShow, onMainList, isTopOnMain, isTopOnSections', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'pic' => 'Pic',
			'url' => 'Url',
			'header' => 'Header',
			'date' => 'Date',
			'position' => 'Position',
			'title' => 'Title',
			'keywords' => 'Keywords',
			'description' => 'Description',
			'preview' => 'Preview',
			'body' => 'Body',
			'isMainPage' => 'Is Main Page',
			'isShow' => 'Is Show',
			'onMainList' => 'On Main List',
			'isTopOnMain' => 'Is Top On Main',
			'isTopOnSections' => 'Is Top On Sections',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('header',$this->header,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('preview',$this->preview,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('isMainPage',$this->isMainPage,true);
		$criteria->compare('isShow',$this->isShow,true);
		$criteria->compare('onMainList',$this->onMainList,true);
		$criteria->compare('isTopOnMain',$this->isTopOnMain,true);
		$criteria->compare('isTopOnSections',$this->isTopOnSections,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}