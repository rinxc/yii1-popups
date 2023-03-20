<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class CAdminController extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='//layouts/internal';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();
    
    
    public $error = Array();

    public function init(){
        
        if(Yii::app()->user->isGuest AND stripos($_SERVER['REQUEST_URI'], "/login" ) === false){
            $this->redirect(Yii::app()->createUrl('/login'));
        }
        
        Yii::app()->getModule('users');
        Yii::app()->getModule('popups');
        
    }
}