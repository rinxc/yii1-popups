<?php

class AdminController extends CAdminController
{
    
    public function init()
    {
        parent::init();
        
        Access::getModuleAccess(Array('module'=>'users', 'controller' => 'admin', 'exception'=>1));
    }
    
    
    public function actionIndex()
    {
        $this->pageTitle = Yii::t('popups', 'Пользователи');

        $this->breadcrumbs = array(
            $this->pageTitle,
        );

        $Users = new Users;
        
        if(isset($_GET['Users'])){
            $Users->attributes = $_GET['Users'];
        }
        
        $this->render('index', compact(array('Users')));
    }
    

    public function actionUpdate($id=0)
    {
        if($id > 0){
            $Users = Users::model()->findByPk($id);
            $this->pageTitle = Yii::t('users', 'Редактирование пользователя').' «' . $Users->login . '»';
        }
        
        if($Users === null){
            $Users = new Users;
            $this->pageTitle = Yii::t('users', 'Создание нового пользователя');
        }

        $this->breadcrumbs = array(
            Yii::t('users', 'Пользователи системы') => Yii::app()->createUrl("/users/admin"),
            $this->pageTitle,
        );

        if(isset($_POST['Users'])){
            $Users->attributes = $_POST['Users'];
            if($Users->validate()){
                $Users->save(false);
                $this->redirect(Yii::app()->createUrl('/users/admin/'));
            }
        }
        
        $this->render('update', compact(Array(
           'Users'
        )));
    }
    
    
    public function actionDelete($id)
    {
        $Users = Users::model()->findByPk($id);
        if($Users !== null and $id != 1){
            $Users->delete();
        }
        $this->redirect(Yii::app()->createUrl('/users/admin'));
    }
}