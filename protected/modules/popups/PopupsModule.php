<?php

class PopupsModule extends CWebModule
{   

    private $_assetsUrl;
    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        
        // import the module-level models and components
        $this->setImport(array(
            'popups.models.*',
            'popups.components.*',
        ));
    }

    public function publishFile($file){
        return Yii::app()->assetManager->publish(Yii::getPathOfAlias($this->getId() . '.views.assets').$file);
    }

    public function registerScriptFile($file){
        Yii::app()->clientScript->registerScriptFile($this->publishFile('/js/'.$file));
    }

    public function registerCssFile($file){
        Yii::app()->clientScript->registerCssFile($this->publishFile('/css/'.$file));
    }
}
