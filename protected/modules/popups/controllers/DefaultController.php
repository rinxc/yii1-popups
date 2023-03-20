<?php

class DefaultController extends MainController
{
    
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
        $this->render('index');
    }

    public function actionRun($id)
    {
        if(YII_DEBUG){
            foreach (Yii::app()->log->routes as $route){  
                if ($route instanceof CWebLogRoute || $route instanceof CFileLogRoute || $route instanceof YiiDebugToolbarRoute){  
                    $route->enabled = false;
                }  
            }
        }
        $Popups = Popups::model()->findByPk($id);

        if($Popups === null){
            $this->redirect(Yii::app()->createUrl('/popups/admin/'));
        }
        header('Content-type: text/javascript');
        $this->renderPartial('run', compact(Array(
           'Popups'
        )));
        Yii::app()->end();
    }

    public function actionCount($id)
    {
        $Popups = Popups::model()->findByPk($id);
        $data['status'] = 'error';
        if($Popups !== null){
            $Popups->count += 1;
            if($Popups->save(false)){
                $data['status'] = 'ok';
            }
        }
        Helpers::JsonResponse($data);
        Yii::app()->end();
    }
}