<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $title = '';
    public $keywords = '';
    public $description = '';
    public $header = '';
    protected $_users;

    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);
       
        
    }
    
    public function init()
    {
        
        Yii::app()->init;
        
    }

    protected function _breadcrumbsInit($url)
    {

        $retArray = array();

        $controllerId = Yii::app()->controller->id;
        $controllerName = Yii::t('interface', $controllerId);
      
      //  $retArray[$controllerName] = $controllerId;
        $root = Tree::model()->find('url=:url', array(':url' => $url));
        $category = $root->ancestors()->findAll();
        foreach ($category as $value) {
            if (!empty($value['url']))
                $retArray[$value['name']] = array('/page/'. $value['url']);
        }
        
        $this->breadcrumbs = $retArray;
    }

}