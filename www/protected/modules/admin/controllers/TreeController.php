<?php

class TreeController extends AdminController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    protected $_modules;

    /**
     * @return array action filters
     */
    public function init()
    {
        $this->_modules = new Modules();
    }

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public $CQtreeGreedView = array(
        'modelClassName' => 'Tree', //название класса
        'adminAction' => '/admin/tree/admin' //action, где выводится QTreeGridView. Сюда будет идти редирект с других действий.
    );

    public function actions()
    {
        return array(
            //  'create' => 'ext.QTreeGridView.actions.Create',
            // 'update' => 'ext.QTreeGridView.actions.Update',
            'delete' => 'ext.QTreeGridView.actions.Delete',
            'moveNode' => 'ext.QTreeGridView.actions.MoveNode',
            'makeRoot' => 'ext.QTreeGridView.actions.MakeRoot',
        );
    }

   

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
    
    public function actionShow($id, $show)
    {
        if(Yii::app()->request->isAjaxRequest){
            try {
                $tree = $this->loadModel($id);
                $tree->isShow = $show;
                
                try {
                    $tree->saveNode();
                } catch(Excaption $e) {
                    echo $e->getMessage();
                }
                
            } catch (Excaption $e) {
                echo $e->getMessage();
            }
            
            echo 'ok'; 
            
            Yii::app()->end();
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Tree();
        $model1 = new Tree();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);



        if (isset($_POST['Tree'])) {

            $model->attributes = $_POST['Tree'];
            $model->controller = $_POST['Tree']['controller']; // !!!!!!!!!!!1
            $model->url = 'h_menu';

            $model1->attributes = $_POST['Tree'];
            $model1->controller = $_POST['Tree']['controller']; // !!!!!!!!!!!1
            $model1->url = 'v_menu';

            if ($model->validate()) {

                $root = Tree::model()->find('name=:name', array(':name' => 'root'));

                if (!$root) {
                    $rootModel = new Tree();
                    $rootModel->name = 'root';
                    $rootModel->controller = '';
                    $rootModel->tableName = '';

                    try {
                        $rootModel->saveNode();
                    } catch (Exception $e) {
                        throw new CHttpException($e->getMessage());
                    }
                    $root = Tree::model()->find('name=:name', array(':name' => 'root'));
                }

                if ($root) {

                    if (!($horisontalMenu = Tree::model()->find('name=:name', array(':name' => $model->horisontalMenuName)))) {

                        $horisontalMenu = new Tree();
                        $horisontalMenu->name = $model->horisontalMenuName;
                        $horisontalMenu->controller = '';
                        $horisontalMenu->tableName = '';

                        try {
                            $horisontalMenu->appendTo($root);
                        } catch (Exception $e) {
                            throw new CHttpException($e->getMessage());
                        }
                    }

                    if (!($verticalMenu = Tree::model()->find('name=:name', array(':name' => $model->verticalMenuName)))) {

                        $verticalMenu = new Tree();
                        $verticalMenu->name = $verticalMenu->verticalMenuName;
                        $verticalMenu->controller = '';
                        $verticalMenu->tableName = '';

                        try {
                            $verticalMenu->appendTo($root);
                        } catch (Exception $e) {
                            throw new CHttpException($e->getMessage());
                        }
                    }
                }


                if (isset($_POST['Tree']['isHorisontalMenu'])) {
                    $horisontalMenu = Tree::model()->find('name=:name', array(':name' => $horisontalMenu->horisontalMenuName));
                    $model->appendTo($horisontalMenu);
                }

                if (isset($_POST['Tree']['isVerticalMenu'])) {
                    $verticalMenu = Tree::model()->find('name=:name', array(':name' => $horisontalMenu->verticalMenuName));
                    $model1->appendTo($verticalMenu);
                }


                $this->redirect(array('view', 'id' => $model->id));
            }
        }





        $this->render('create', array(
            'model' => $model,
            'modules' => $this->_modules
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Tree'])) {
            if (empty($_POST['Tree']['url']))
                $_POST['Tree']['url'] = $_POST['Tree']['name'];

            $translite1 = new Translite();
            $model->url = $translite1->rusencode($_POST['Tree']['url']);

            $model->attributes = $_POST['Tree'];

            if ($model->saveNode())
                $this->redirect(array('view', 'id' => $model->id));
        }
        $isHorisontalMenu = false;
        $isVerticalMenu = false;
        
        $parent = $model->parent()->find();
       
        if (!in_array($model->name, array('root', 'Horisontal menu', 'Vertical menu'))) {
            $horisontalMenu = Tree::model()->find('name=:name', array(':name' => 'Horisontal menu'));
            $isHorisontalMenu = $horisontalMenu->children()->exists('name=:name', array(':name' => $model->name));
            
            $verticalMenu = Tree::model()->find('name=:name', array(':name' => 'Vertical menu'));
            $isVerticalMenu = $verticalMenu->children()->exists('name=:name', array(':name' => $model->name));
        }


        $this->render('update', array(
            'model' => $model,
            'modules' => $this->_modules,
            'isHorisontalMenu' => $isHorisontalMenu,
            'isVerticalMenu' => $isVerticalMenu,
            'parent'=>($parent !== null ? $parent->name : null)
            ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->deleteNode();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Tree');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Tree('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Tree']))
            $model->attributes = $_GET['Tree'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Tree the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Tree::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Tree $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'menu-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
