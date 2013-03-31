<?php

class NewsController extends Controller
{
    
    public $newsSize = 10;
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
       
        $news = News::model()->find('url=:url', array(':url'=>$url));
        
        if (empty($news))
            throw new CHttpException("Страница $url не найдена", 404);
        
      //  $parentPages = News::model->findAll(); 
        
        $this->title = $news->title;
        $this->keywords = $news->keywords;
        $this->description = $news->description;
        $this->header = $news->header;
        $this->breadcrumbs[] = $news->name;
      
        $menuElement = Tree::model()->find('pageId=:pageId', array(':pageId'=>$news->id));
        $criteria = new CDbCriteria();
        $criteria->limit = "5";
        $criteria->condition = "isShow='1' AND isTopOnSections='1'";
         
        $topItems = $menuElement->with('pages')->descendants()->findAll($criteria);
        
        $criteria = new CDbCriteria();
        $criteria->condition = "isShow='1' AND isTopOnSections='0'";
        $count = $menuElement->with('pages')->descendants()->count($criteria);

        $paggination=new CPagination($count);
        $paggination->pageSize = $this->newsSize;
        $paggination->applyLimit($criteria);
        
        
        $subItems = $menuElement->with('pages')->descendants()->findAll($criteria);
       
        $this->render('view', array(
            'news'=>$news,
            'topItems'=>$topItems,
            'subItems'=>$subItems,
            'paggination'=>$paggination
            ));
    }

}