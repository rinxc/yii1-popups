<?php

class DefaultController extends MainController
{
    public function init()
    {
        parent::init();
    }
    
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error){
            if(Yii::app()->request->isAjaxRequest){
                echo $error['message'];
            }else{
                $this->render('error', $error);
            }
        }
    }
    
    public function actionIndex()
    {
        $this->redirect($this->createAbsoluteUrl('/'));
    }
    
    public function actionLogin()
    {
        $LoginForm = new LoginForm;
        
        
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='UsersForm'){
            echo CActiveForm::validate($LoginForm);
            Yii::app()->end();
        }
        
        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $LoginForm->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($LoginForm->validate() && $LoginForm->login()){
                $this->redirect($this->createAbsoluteUrl('/'));
            }
        }
        
        // display the login form
        $this->render('login', compact(array('LoginForm')));
    }
    
    
    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->createUrl('/login'));
    }
    
}