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
class VMenu extends CMenu
{

    /**
     * 
     * @var string open | close | active
     */
    public $name = 'Vertical menu';
    public $type = 'open';
    public $deep = 2;

    protected function renderMenu($items)
    {
        $category = Tree::model()->find('name=:name', array(':name' => $this->name));
        if (count($items) || $category) {
            echo CHtml::openTag('ul', $this->htmlOptions) . "\n";
            if (count($items))
                $this->renderMenuRecursive($items);
            if ($category)
                $this->initNodes($category);
            echo CHtml::closeTag('ul');
        }
    }

    protected function initNodes($category)
    {

        if ($category) {
            if ($this->type == 'close') {
                $menuElements = $category->children()->findAll();
            } elseif ($this->type == 'open') {
                $menuElements = $category->descendants()->findAll();
            } else {
                throw new Excaptio('Chose menu type (open or close)');
            }

            if ($menuElements) {
                $isOpenTag = true;
                $isCloseTag = true;
                $level = 0;
                $isFirstMenu = true;
                $deepCounter = 0;

                foreach ($menuElements as $n => $category) {
                 if ($category->isShow == '1') {
                    if ($category->level == $level)
                        echo CHtml::closeTag('li') . "\n";
                    else if ($category->level > $level) {
                        if (!$isOpenTag)
                            echo CHtml::openTag('ul') . "\n";
                        else
                            $isOpenTag = false;
                        
                    } else {
                        echo CHtml::closeTag('li') . "\n";

                        for ($i = $level - $category->level; $i; $i--) {
                            //  if (!$isCloseTag)
                            echo CHtml::closeTag('ul') . "\n";
                            // else 
                            $isCloseTag = false;
                            echo CHtml::closeTag('li') . "\n";
                        }
                    }

                    $isHeadmenu = ($category->url == 'h_menu' || $category->url == 'v_menu');

                    if ($isHeadmenu)
                        echo CHtml::openTag('li', array('class' => $category->url));
                    else
                        echo CHtml::openTag('li');

                    if ($category->url == 'v_menu') {
                        if (!$isFirstMenu) {
                            echo CHtml::openTag('div', array('class' => 'menu_slider'));
                            echo CHtml::closeTag('div');
                        }
                        $isFirstMenu = false;
                    }

                    if ($category->url == 'v_menu') 
                        echo CHtml::openTag('div');
                  

                    echo $this->renderMenuItem(array(
                        'url' => '/' . $category->controller . '/' . (!$isHeadmenu ? $category->url : ''),
                        'label' => $category->name
                    ));

                    if ($category->url == 'v_menu') 
                        echo CHtml::closeTag('div');
                    
                        $level = $category->level;
                
                 }
                    
                }

                // for ($i = $level; $i; $i--) {
                // echo CHtml::closeTag('li') . "\n";
                // echo CHtml::closeTag('ul') . "\n";
                // }
            }
        }
    }

}

