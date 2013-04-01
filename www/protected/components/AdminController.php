<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author devel
 */
class AdminController extends Controller
{

    /**
     * @return array action filters
     */
    public $img;
    public $imgDir = 'pages';
    public $layout = '//layouts/column1';
  

    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);    
        $this->_initHorisontalMenu();
    }
    
    protected function _initHorisontalMenu()
    {
        $controllerName = Yii::t('interface', ucfirst($this->id));
        $controllerSettingsName = Yii::t('interface', ucfirst($this->id . ' settings'));
   
        $this->_horisontalMenu[] = array('label' => Yii::t('interface', $this->module->id), 'url' => array('/' . $this->module->id), 'active'=>(Yii::app()->request->getUrl() == '/admin'));
        if ($this->id != 'default')
            $this->_horisontalMenu[] = array('label' => Yii::t('interface', $controllerName), 'url' => array('/' . $this->module->id.'/'.$this->id), 'active'=>(!strpos(Yii::app()->request->getUrl(), 'settings') && strpos(Yii::app()->request->getUrl(), $this->id)));
        $this->_horisontalMenu[] = array('label' => Yii::t('interface', $controllerSettingsName), 'url' => array('/' . $this->module->id . '/' . $this->id . '/settings'));

    }

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function init()
    {



        $this->img = array(
            'big' => array(
                'width' => '350',
                'height' => '350',
                'watermarck' => '/img/watermark/big.png',
                'path' => '/img/' . $this->imgDir . '/big/'
            ),
            'small' => array(
                'width' => '150',
                'height' => '150',
                'watermarck' => '/img/watermark/small.png',
                'path' => '/img/' . $this->imgDir . '/small/'
            )
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            /*  array('allow', // allow all users to perform 'index' and 'view' actions
              'actions' => array('index', 'view'),
              'users' => array('*'),
              ),
              array('allow', // allow authenticated user to perform 'create' and 'update' actions
              'actions' => array('create', 'update'),
              'users' => array('@'),
              ), */
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'postOnly + delete', 'create', 'update', 'index', 'view', 'dellpic', 'show', 'settings', 'moveNode', 'accessControl'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
            // 'users' => array('*'),
            ),
        );
    }

    protected function _menuList()
    {
        $retArray = array();

        //  $root = Tree::model()->find('controller=:controller OR controller=:controller1', array(':controller' =>$this->id.'_root', ':controller1' =>$this->id.'_menu_root'));
        $root = Tree::model()->find('name=:name', array(':name' => 'root'));

        if (!$root)
            return array();



        $retArray[] = Yii::t('form', 'Do not add to the menu');

        $category = $root->descendants()->findAll();
        foreach ($category as $value) {

            $lft = intval($value['level']);
            $val = '';
            for ($i = 0; $i < $lft; $i++)
                $val .= ' - ';

            $retArray[$value['id']] = $val . $value['name'];
        }

        return $retArray;
    }

    public function actionSettings()
    {
        
        $this->render('application.modules.admin.views.messages.error', 
                array(
                    'title'=>'Notice',
                    'message'=>'In this version, the settings specified in the controller class or a file with options.')
                );
    }

    protected function _menuSelected($ipageId, $controller = 'page')
    {
        $category = Tree::model()->find('pageId=:pageId and controller=:controller', array(':pageId' => $ipageId, ':controller' => $controller));
        if ($category) {
            $parent = $category->parent()->find();

            $treeSelected = array($parent->id => array('selected' => true));
            // var_dump($treeSelected->name, $category->name); die;
            /* foreach ($category as $category_) {
              $parent = $category_->parent()->find('controller=:controller', array(':controller'=>$controller));

              if (empty($hMenuSelected)) {
              $MenuSelected = array($parent->id => array('selected' => true));
              }
              } */
            return $treeSelected;
        }
        return array();
    }

}

?>
