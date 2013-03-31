<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property string $id
 * @property integer $level
 * @property integer $lft
 * @property integer $rgt
 * @property integer $root
 * @property string $name
 */
class Tree extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Menu the static model class
     */
    public $horisontalMenuName = 'Horisontal menu';
    public $verticalMenuName = 'Vertical menu';

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tree';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function behaviors()
    {
        return array(
            'tree' => array(
                'class' => 'NestedSetBehavior',
               
               // 'hasManyRoots' => true,
            ),
        );
    }

    public function rules()
    {
        return array(
            array('name', 'required'),
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
            'level' => Yii::t('form', 'Level'),
            'name' => Yii::t('form', 'Name'),
            'controller' => Yii::t('form', 'Module name'),
            'isHorisontal' => Yii::t('form', 'Is create horisontal menu'),
            'isVertical' => Yii::t('form', 'Is create vertical menu'),
            'isHorisontalEdit' => Yii::t('form', 'Is update in horisontal menu'),
            'isVerticalEdit' => Yii::t('form', 'Is update in vertical menu'),
            'isShow' => Yii::t('form', 'Is Show'),
            
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

        $criteria->order = $this->tree->hasManyRoots
                           ?$this->tree->rootAttribute . ', ' . $this->tree->leftAttribute
                           :$this->tree->leftAttribute;

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>60)
                ));
    }

}