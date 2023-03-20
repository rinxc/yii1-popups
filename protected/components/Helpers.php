<?
class Helpers {

    public static function PublishFile($file){
        return Yii::app()->assetManager->publish(Yii::getPathOfAlias('assetsBasePath').$file);
    }

    public static function RegisterScriptFile($file, $position = CClientScript::POS_BEGIN){
        Yii::app()->clientScript->registerScriptFile(Helpers::PublishFile($file), $position);
    }

    public static function RegisterCssFile($file){
        Yii::app()->clientScript->registerCssFile(Helpers::PublishFile($file));
    }
    
    public static function JsonResponse($data) {
        if(YII_DEBUG){
            foreach (Yii::app()->log->routes as $route){  
                if ($route instanceof CWebLogRoute || $route instanceof CFileLogRoute || $route instanceof YiiDebugToolbarRoute){  
                    $route->enabled = false;
                }  
            }
        }
        header('Content-type: application/json');
        echo Helpers::JsonEncode($data);
        Yii::app()->end();
    }
    
    public static function JsonEncode($string) {
        return preg_replace_callback('/\\\u([0-9a-fA-F]{4})/', create_function('$match', 'return mb_convert_encoding("&#" . intval($match[1], 16) . ";", "UTF-8", "HTML-ENTITIES");'), json_encode($string));
    }
    
    public static function JsonDecode($string) {
        return  json_decode($string, true);
    }
}
?>