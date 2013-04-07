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
                'watermark' => '/img/watermark/wm_350_350.png',
                'path' => '/img/' . $this->imgDir . '/big/'
            ),
            'small' => array(
                'width' => '150',
                'height' => '150',
                'watermark' => '/img/watermark/wm_150_150.png',
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
                'actions' => array('admin', 'delete', 'create', 'update', 'index', 'view', 'dellpic', 'show', 'settings', 'moveNode', 'accessControl'),
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
            
            if ($value['name'] == 'Vertical menu' || $value['name'] == 'Horisontal menu')
                $value['name'] = Yii::t('form', $value['name']);

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
    
    protected function _deletePic($pic) {
    
        if (is_file(Yii::app()->params->webroot.$this->img['big']['path'].$pic)) {
            @unlink(Yii::app()->params->webroot.$this->img['big']['path'].$pic);
        }
        
        if (is_file(Yii::app()->params->webroot.$this->img['small']['path'].$pic)) {
            @unlink(Yii::app()->params->webroot.$this->img['small']['path'].$pic);
        }
    }


    protected function _savePic($model)
    {
        $pic = CUploadedFile::getInstance($model, 'pic');

        if ($pic) {

            $CUploadedFileResize = new CUploadedFileResize($pic);
            $CUploadedFileResize->width = $this->img['big']['width'];
            $CUploadedFileResize->height = $this->img['big']['height'];
            $CUploadedFileResize->watermark = $this->img['big']['watermark'];
            $CUploadedFileResize->saveResize($this->img['big']['path'] . $pic->getName());


            $CUploadedFileResize = new CUploadedFileResize($pic);
            $CUploadedFileResize->width = $this->img['small']['width'];
            $CUploadedFileResize->height = $this->img['small']['height'];
            $CUploadedFileResize->watermark = $this->img['small']['watermark'];
            $CUploadedFileResize->saveResize($this->img['small']['path'] . $pic->getName());

            $model->pic = $pic->getName();
        }
    }


}

?>
