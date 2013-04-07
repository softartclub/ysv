<?php

class PagesController extends Controller
{

    public $pageSize = 10;

    public function init()
    {
        
    }

    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "isShow='1' AND isMainPage != '1'";
        $criteria->order = "date";
        $pagesList = Pages::model()->findAll($criteria);
        $this->render('index', array('pagesList' => $pagesList));
    }

    public function actionView($url)
    {
        $this->_breadcrumbsInit($url);

        $page = Pages::model()->find('url=:url', array(':url' => $url));

        if (empty($page))
            throw new CHttpException("Страница $url не найдена", 404);

        //  $parentPages = Pages::model->findAll(); 

        $this->title = $page->title;
        $this->keywords = $page->keywords;
        $this->description = $page->description;
        $this->header = $page->header;
        $controllerName = $this->id;
        $controllerTitle = Yii::t('interface', ucfirst($controllerName));
        $this->breadcrumbs[$controllerTitle] = '/' . $controllerName;
        $this->breadcrumbs[] = $page->name;

        Yii::app()->clientScript->registerMetaTag($this->title, 'title');
        Yii::app()->clientScript->registerMetaTag($this->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($this->description, 'description');
        $this->pageTitle = $this->title;

        $menuElement = Tree::model()->find('pageId=:pageId AND controller=:controller', array(':pageId' => $page->id, ':controller'=>'page'));
        $topItems = null;
        $subItems = null;
        $paggination = null;

        if ($menuElement) {
            $criteria = new CDbCriteria();
            $criteria->limit = "5";
            $criteria->condition = "`pages`.isShow='1' AND isTopOnSections='1'";
            $criteria->order = "`pages`.`date`, `pages`.`id` DESC";
            $topItems = $menuElement->with('pages')->parent()->findAll($criteria);

            $criteria = new CDbCriteria();
            $criteria->condition = "`pages`.isShow='1'";
            $criteria->order = "`pages`.`date`, `pages`.`id` DESC";
            $count = $menuElement->with('pages')->children()->count($criteria);

            $paggination = new CPagination($count);
            $paggination->pageSize = $this->pageSize;
            $paggination->applyLimit($criteria);


            $subItems = $menuElement->with('pages')->children()->findAll($criteria);
        }
        
        $this->render('view', array(
            'page' => $page,
            'topItems' => $topItems,
            'subItems' => $subItems,
            'paggination' => $paggination
        ));
    }

}