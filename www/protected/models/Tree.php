<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tree
 *
 * @author devel
 */
class Tree extends CActiveRecord
{
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
    
    public function behaviors()
    {
        return array(
            'tree' => array(
                'class' => 'NestedSetBehavior',
               // 'hasManyRoots' => true,
            ),
        );
    }
    
    public function relations()
    {
        return array(
            'pages'=>array(self::HAS_ONE, 'Pages','', 'on'=>'pages.id=t.pageId'),
            'news'=>array(self::HAS_ONE, 'News','', 'on'=>'news.id=t.pageId'),
            );
        
    }
}

?>
