<?php


class jsTree extends CWidget
{
    public $menu;
    public function init()
    {
        $this->render('jstree', array('menu'=>$this->menu));
    }
}

