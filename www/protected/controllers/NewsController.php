<?php

class NewsController extends Controller
{

    public $pageSize = 10;

    public function init()
    {
        
    }

    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "isShow='1'";
        $criteria->order = "date";
        $newsList = News::model()->findAll($criteria);
        $this->render('index', array('newsList' => $newsList));
    }

    public function actionView($url)
    {
        $this->_breadcrumbsInit($url);

        $page = News::model()->find('url=:url', array(':url' => $url));

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

        $menuElement = Tree::model()->find('pageId=:pageId AND controller=:controller', array(':pageId' => $page->id, ':controller'=>'news'));

        $topItems = null;
        $subItems = null;
        $paggination = null;

        if ($menuElement) {
            $criteria = new CDbCriteria();
            $criteria->limit = "5";
            $criteria->condition = "`news`.isShow='1' AND isTopOnSections='1'";
            $criteria->order = "`news`.`date`, `news`.`id` DESC";
            $topItems = $menuElement->with('news')->parent()->findAll($criteria);

            $criteria = new CDbCriteria();
            $criteria->condition = "`news`.isShow='1'";
            $criteria->order = "`news`.`date`, `news`.`id` DESC";
            $count = $menuElement->with('news')->children()->count($criteria);

            $paggination = new CPagination($count);
            $paggination->pageSize = $this->pageSize;
            $paggination->applyLimit($criteria);
            
            $subItems = $menuElement->with('news')->children()->findAll($criteria);
        }
        
     
        $this->render('view', array(
            'news' => $page,
            'topItems' => $topItems,
            'subItems' => $subItems,
            'paggination' => $paggination
        ));
    }

}