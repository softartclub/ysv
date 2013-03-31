<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Modules
 *
 * @author devel
 */
class Modules
{
     protected $_mainIconsArray = array(
        'Pages'=>array(
            'controller'=>'/admin/pages',
            'icons'=>'/themes/admin/images/big_icons/icon-list2.png',
            'tableName'=>'pages'
        ),
        'Tree'=>array(
            'controller'=>'/admin/tree/admin',
            'icons'=>'/themes/admin/images/big_icons/icon-tree.png',
            
        ),
       
        'News'=>array(
            'controller'=>'/admin/news',
            'icons'=>'/themes/admin/images/big_icons/news-list2.png',
            'tableName'=>'news'
        ),
       
    );
     
    
     
     public function getModules()
     {
         return $this->_mainIconsArray;
     }
     
     public function getHtml()
     {
         $ret = array();
         foreach($this->_mainIconsArray as $key=>$val) {
             if (isset($val['tableName'])) {
                 $controller = strtolower($key);
                 $val = Yii::t('interface', $key);
                 $ret[$controller] = $val;
             }
         }
         return $ret;
     }
}

?>
