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
        $this->render('index', array('newsList'=>$newsList));
    }
    
      public function actionView($url)
    {
        $this->_breadcrumbsInit($url);
       
        $page = News::model()->find('url=:url', array(':url'=>$url));
        
        if (empty($page))
            throw new CHttpException("Страница $url не найдена", 404);
        
      //  $parentPages = Pages::model->findAll(); 
        
        $this->title = $page->title;
        $this->keywords = $page->keywords;
        $this->description = $page->description;
        $this->header = $page->header;
        $this->breadcrumbs[] = $page->name;
      
        $menuElement = Tree::model()->find('pageId=:pageId', array(':pageId'=>$page->id));
        $criteria = new CDbCriteria();
        $criteria->limit = "5";
        $criteria->condition = "`news`.isShow='1' AND isTopOnSections='1'";
         
        $topItems = $menuElement->with('news')->parent()->findAll($criteria);
        
        $criteria = new CDbCriteria();
        $criteria->condition = "`news`.isShow='1' AND isTopOnSections='0'";
        $count = $menuElement->with('news')->descendants()->count($criteria);

        $paggination=new CPagination($count);
        $paggination->pageSize = $this->pageSize;
        $paggination->applyLimit($criteria);
        
        
        $subItems = $menuElement->with('news')->children()->findAll($criteria);
       
        $this->render('view', array(
            'news'=>$page,
            'topItems'=>$topItems,
            'subItems'=>$subItems,
            'paggination'=>$paggination
            ));
    }


}