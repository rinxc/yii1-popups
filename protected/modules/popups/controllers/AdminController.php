<?php

class AdminController extends CAdminController
{
    public function init()
    {
        parent::init();
        
        Access::getModuleAccess(Array('module'=>'popups', 'controller' => 'admin', 'exception'=>1));
    }
    
    
    public function actionIndex()
    {
        $this->pageTitle = Yii::t('popups', 'Всплывающие окна');

        $this->breadcrumbs = array(
            $this->pageTitle,
        );

        $Popups = new Popups;
        
        if(isset($_GET['Popups'])){
            $Popups->attributes = $_GET['Popups'];
        }
        
        $this->render('index', compact(array('Popups')));
    }
    
    
    public function actionUpdate($id=0)
    {
        if($id > 0){
            $Popups = Popups::model()->findByPk($id);
            $this->pageTitle = Yii::t('popups', 'Редактирование всплывающего окна').' «' . $Popups->title . '»';
        }
        
        if($Popups === null){
            $Popups = new Popups;
            $this->pageTitle = Yii::t('popups', 'Создание нового всплывающего окна');
        }
        
        $this->breadcrumbs = array(
            Yii::t('popups', 'Всплывающие окна') => Yii::app()->createUrl('/popups/admin'),
            $this->pageTitle,
        );

        if(isset($_POST['Popups'])){
            $Popups->attributes = $_POST['Popups'];
            if($Popups->validate()){
                $Popups->save(false);
                $this->redirect(Yii::app()->createUrl('/popups/admin/view/' . $Popups->id_popups));
            }
        }
        
        $this->render('update', compact(Array(
           'Popups'
        )));
    }
    

    public function actionView($id)
    {
        $Popups = Popups::model()->findByPk($id);

        if($Popups === null){
            $this->redirect(Yii::app()->createUrl('/popups/admin/'));
        }

        $this->pageTitle = Yii::t('popups', 'Просмотр всплывающего окна').' «' . $Popups->title . '»';
        $this->breadcrumbs = array(
            Yii::t('popups', 'Всплывающие окна') => Yii::app()->createUrl('/popups/admin'),
            $this->pageTitle,
        );
        
        $this->render('view', compact(Array(
           'Popups'
        )));
    }


    public function actionDelete($id)
    {
        $Popups = Popups::model()->findByPk($id);
        
        if($Popups !== null){
            $Popups->delete();
        }
        $this->redirect(Yii::app()->createUrl('/popups/admin'));
    }
}