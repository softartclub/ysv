<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property string $id
 * @property string $level
 * @property string $name
 * @property string $url
 * @property string $header
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $preview
 * @property string $body

 */
class Pages extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Pages the static model class
     */
    
    public $isShow = '1';
    
    public function init()
    {
        $this->date = date('Y-m-d');
    }
    
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, body', 'required'),
            array('isShow, isMainPage, onMainList, isTopOnSections, isTopOnMain', 'length', 'max'=>1),
            array('name, url, header, title, keywords', 'length', 'max' => 255),
            array('description', 'length', 'max' => 1000),
            array('body', 'required'),
            array('preview, body', 'safe'),
            array('date', 'date', 'format'=>'yyyy-mm-dd'),
            array('pic', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('name, url, header, title, keywords, description, preview, body, isMainPage, isShow', 'safe', 'on' => 'search'),
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
            'pic' => Yii::t('form', 'Picture'),
            'isShow' => Yii::t('form', 'Is Show'),
            'name' => Yii::t('form', 'Name'),
            'url' => Yii::t('form', 'Url'),
            'date' => Yii::t('form', 'Date'),
            'header' => Yii::t('form', 'Header'),
            'title' => Yii::t('form', 'Title'),
            'keywords' => Yii::t('form', 'Keywords'),
            'description' => Yii::t('form', 'Description'),
            'preview' => Yii::t('form', 'Preview'),
            'body' => Yii::t('form', 'Body'),
            'isMainPage' => Yii::t('form', 'isMainPage'),
            'onMainList' => Yii::t('form', 'On Main List'),
            'isTopOnMain' => Yii::t('form', 'Is Top On Main'),
            'isTopOnSections' => Yii::t('form', 'Is Top On Sections'),
            'author' => Yii::t('form', 'Author'),
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
       
        $criteria->compare('name', $this->name, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('header', $this->header, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('keywords', $this->keywords, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('preview', $this->preview, true);
        $criteria->compare('body', $this->body, true);


        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}