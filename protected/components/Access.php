<?
class Access {
    
    /**
     * getAccessAdmin
     *
     * @return 
     */
    public static function getAccessAdmin(){
        if(!Yii::app()->user->isGuest && Yii::app()->user->attribute['id_users_groups'] == 1){
            return true;
        }else{
            return false;
        }
    }
    
    
    public static function getModuleAccess($settings) {
        
        $access = false;
        
        if(in_array($settings['module'], Array('users','popups'))){
            switch($settings['controller']){
                case "admin":
                    if(Access::getAccessAdmin()){
                        $access = true;
                    }
                break;
            }
        }
        
        if($access){
            return true;
        }else if($settings['exception']){
            throw new CHttpException(403, Yii::t('project','Доступ к модулю закрыт'));
        }else{
            return false;
        }
    }
}



?>