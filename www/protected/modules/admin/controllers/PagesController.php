<?php

class PagesController extends AdminController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
   

    
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Pages;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $menu = new Tree();


        if (isset($_POST['Pages'])) {

            try {
                $metaTagsData1 = new MetaTagsData($_POST['Pages']);
            } catch (Exception $e) {
                throw new Exception($e->getMessage(), $e->getCode());
            }

            $model->attributes = $metaTagsData1->getData();
 
           
            if ($model->validate()) {

                $pic = CUploadedFile::getInstance($model, 'pic');
              

                if ($pic) {

                    $CUploadedFileResize = new CUploadedFileResize($pic);
                    $CUploadedFileResize->width = $this->img['big']['width'];
                    $CUploadedFileResize->height = $this->img['big']['height'];
                    $CUploadedFileResize->saveResize($this->img['big']['path'] . $pic->getName());

                    $CUploadedFileResize = new CUploadedFileResize($pic);
                    $CUploadedFileResize->width = $this->img['small']['width'];
                    $CUploadedFileResize->height = $this->img['small']['height'];
                    $CUploadedFileResize->saveResize($this->img['small']['path'] . $pic->getName() );

                    $model->pic = $pic->getName() ;
                }



                if (Pages::model()->exists('url=:url', array(':url' => $model->attributes['url'])))
                    throw new CHttpException(Yii::t('message', 'Url {url} already exists', array('{url}' => $model->attributes['url'])));

                try {
                    $model->save();
                } catch (Exception $e) {
                    throw new CHttpException($e->getMessage());
                }



                if (is_numeric($_POST['Tree']['tree']) && $_POST['Tree']['tree'] != '0') {

                    $parentMenu = Tree::model()->findByPk($_POST['Tree']['tree']);
                    $menu->name = $model->attributes['name'];
                    $menu->pageId = $model->getPrimaryKey();
                    $menu->url = $model->attributes['url'];
                    $menu->controller = 'page';
                    $menu->tableName = 'pages';
                    try {
                        $menu->appendTo($parentMenu);
                    } catch (Exception $e) {
                        throw new CHttpException($e->getMessage());
                    }
                }

                $this->redirect(array('view', 'id' => $model->getPrimaryKey()));
            }
        }


        $this->render('create', array(
            'model' => $model,
            'tree' => $menu,
            'treeSelected' => array(),
            'treeList' => $this->_menuList(),
            'img' => $this->img
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $activeElement = Tree::model()->find('pageId=:pageId', array(':pageId' => $model->id));
        $isElementExists = true;
        if (!$activeElement) {
            $activeElement = Tree::model();
            $isElementExists = false;
        }


        if (isset($_POST['Pages'])) {

            try {
                $metaTagsData1 = new MetaTagsData($_POST['Pages']);
            } catch (Exception $e) {
                throw new Exception($e->getMessage(), $e->getCode());
            }

            $model->attributes = $metaTagsData1->getData();



            if ($model->validate()) {

                $pic = CUploadedFile::getInstance($model, 'pic');


                if ($pic) {

                    $CUploadedFileResize = new CUploadedFileResize($pic);
                    $CUploadedFileResize->width = $this->img['big']['width'];
                    $CUploadedFileResize->height = $this->img['big']['height'];
                    $CUploadedFileResize->saveResize($this->img['big']['path'] . $pic->getName());

                    $CUploadedFileResize = new CUploadedFileResize($pic);
                    $CUploadedFileResize->width = $this->img['small']['width'];
                    $CUploadedFileResize->height = $this->img['small']['height'];
                    $CUploadedFileResize->saveResize($this->img['small']['path'] . $pic->getName());

                    $model->pic = $pic->getName();
                }

                try {
                    $model->save();
                } catch (Exception $e) {
                    throw new CHttpException($e->getMessage());
                }

                if (is_numeric($_POST['Tree']['tree'])) { 
                    
                    $selectedElement = null;
                    
                    if ($_POST['Tree']['tree'] != '0') { 
                        try {
                            $selectedElement = Tree::model()->findByPk($_POST['Tree']['tree']);
                        } catch (Exception $e) { 
                            throw new CHttpException($e->getMessage());
                        }
                        
                        

                        try {
                            if ($isElementExists) {

                                $activeElement->name = $model->attributes['name'];
                                $activeElement->pageId = $model->id;
                                $activeElement->url = $model->attributes['url'];
                                $activeElement->controller = 'page';
                                $activeElement->tableName = 'pages';
                                //$activeElement->moveAsFirst($selectedElement);

                                try {
                                    //$menu->save($selectedElement);
                                    $activeElement->saveNode();
                                } catch (Exception $e) {
                                    throw new CHttpException($e->getMessage());
                                }
                            } else {
                                $menu = new Tree();
                                $menu->name = $model->attributes['name'];
                                $menu->pageId = $model->id;
                                $menu->url = $model->attributes['url'];
                                try {
                                    $menu->appendTo($selectedElement);
                                } catch (Exception $e) {
                                    throw new CHttpException($e->getMessage());
                                }
                            }
                        } catch (Exception $e) {
                            throw new CHttpException($e->getMessage());
                        }
                    } else {
                        
                        $isTree = Tree::model()->exists('pageId=:pageId', array(':pageId'=>$model->id));
                        
                        
                        try {
                            
                            if ($isTree) {
                                $activeElement->deleteNode();
                            } else {
                                $model->save();
                            }
                            
                            
                        } catch (Exception $e) {
                            throw new CHttpException($e->getMessage());
                        }
                    }
                }



                $this->redirect(array('view', 'id' => $model->id));
            }
        }


        $this->render('update', array(
            'model' => $model,
            'tree' => $activeElement,
            'treeSelected' => $this->_menuSelected($model->id),
            'treeList' => $this->_menuList(),
            'img' => $this->img
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Pages');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Pages('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Pages']))
            $model->attributes = $_GET['Pages'];

        $this->render('admin', array(
            'model' => $model,
            'users' => $this->_users
        ));
    }

    public function actionDellpic($id)
    {
        if (!is_numeric($id))
            throw new CHttpException('Error index');
        $criteria = new CDbCriteria();
        $criteria->select = 'pic';
        $criteria->condition = $id;
        $pic = Pages::model()->findByPk($criteria->condition);
        $deletedFiles = '';


        if ($pic && !empty($pic->pic)) {
            foreach ($this->img as $type => $info) {
                if (is_file($_SERVER['DOCUMENT_ROOT'] . $info['path'] . $pic->pic)) {
                    @chmod($_SERVER['DOCUMENT_ROOT'] . $info['path'] . $pic->pic, 066);
                    @unlink($_SERVER['DOCUMENT_ROOT'] . $info['path'] . $pic->pic);
                    $deletedFiles .= $info['path'] . $pic->pic . '<br>';
                }
            }
        }
        $model = $this->loadModel($id);
        $model->pic = '';
        if (!$model->save())
            throw new CHttpException('Error 2');

        $this->render('dellpic', array('id' => $id, 'deletedFiles' => $deletedFiles));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Pages the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Pages::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Pages $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pages-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
