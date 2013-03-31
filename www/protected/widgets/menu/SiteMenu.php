<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VMenu
 *
 * @author devel
 */
class SiteMenu extends CWidget
{
    protected $_hMenu = '';
    protected function _initMenu($menuName)
    {
        $category = Menu::model()->find('name=:name', array(':menu'=>$menuName));
        
        switch($this->type) {
            case 'open' :
                break;
            case 'active' :
                break;
            default:
               $descendants = $category->children()->findAll();                 
        }
        
       
        if (!empty($descendants)) {
            foreach ($descendants as $item) {
               // $this->items[] = array('label' => $item->name, 'url' => array('/page/'.$item->url), 'active'=>true);
            }
        
        }
    }

}

?>
