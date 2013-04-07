<?php

class SiteController extends Controller
{

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionTestmenu()
    {
        $this->render('testmenu');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        // top news
        $criteria = new CDbCriteria();
        $criteria->condition = "isShow=:isShow AND isTopOnMain=:isTopOnMain";
        $criteria->params = array(':isShow' => '1', ':isTopOnMain' => '1');
        $criteria->order = "`t`.`date`, `t`.`id` DESC";
        $criteria->limit = 10;
        $mainTopNews = News::model()->findAll($criteria);
        // last news
        $criteria = new CDbCriteria();
        $criteria->condition = " isShow=:isShow AND  onMainList=:onMainList";
        $criteria->params = array(':isShow' => '1', ':onMainList' => '1');
        $criteria->order = "`t`.`date`, `t`.`id` DESC";
        $criteria->limit = 10;
        $mainLastNews = News::model()->findAll($criteria);

        //top pages
        $criteria = new CDbCriteria();
        $criteria->condition = "isShow=:isShow AND isTopOnMain=:isTopOnMain";
        $criteria->params = array(':isShow' => '1', ':isTopOnMain' => '1');
        $criteria->order = "`t`.`date`, `t`.`id` DESC";
        $criteria->limit = 10;
        $mainTopPages = Pages::model()->findAll($criteria);

        // last pages
        $criteria = new CDbCriteria();
        $criteria->condition = " isShow=:isShow AND  onMainList=:onMainList";
        $criteria->params = array(':isShow' => '1', ':onMainList' => '1');
        $criteria->order = "`t`.`date`, `t`.`id` DESC";
        $criteria->limit = 10;
        $mainLastPages = Pages::model()->findAll($criteria);


        //main pages

        $criteria = new CDbCriteria();
        $criteria->condition = " isShow=:isShow AND isMainPage=:isMainPage";
        $criteria->params = array(':isMainPage' => '1', ':isShow' => '1');
        $criteria->order = "`t`.`date`, `t`.`id` DESC";
        $criteria->limit = 10;

        $mainPages = Pages::model()->findAll($criteria);
        if (!empty($mainPages) && $mainPages[0]->isMainPage == '1') {

            $this->title = $mainPages[0]->title;
            $this->keywords = $mainPages[0]->keywords;
            $this->description = $mainPages[0]->description;
            $this->header = $mainPages[0]->header;

            Yii::app()->clientScript->registerMetaTag($this->title, 'title');
            Yii::app()->clientScript->registerMetaTag($this->keywords, 'keywords');
            Yii::app()->clientScript->registerMetaTag($this->description, 'description');
            $this->pageTitle = $this->title;
        }

        $this->render('index', array(
            'mainPages' => $mainPages,
            'mainTopPages' => $mainTopPages,
            'mainLastPages' => $mainLastPages,
            'mainTopPages' => $mainTopPages,
            'mainTopNews' => $mainTopNews,
            'mainLastNews' => $mainLastNews,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', Yii::t('message', 'Thank you for contacting us. We will respond to you as soon as possible.'));
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionSitemap()
    {
        $data = array();
        
        $this->render('sitemap', array('data' => $data));
    }

}