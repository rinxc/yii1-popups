<?
$mainCssAssetsUrl = $this->getModule()->publishFile('/css/popups.css');
$animationAssetsURL = $this->getModule()->publishFile('/css/animation/'.$Popups->animation.'.css');
include_once(__DIR__.'/../assets/js/popups.js');
?>


var popups<?=$Popups->id_popups?> = new Popups({
    id_popups: <?=$Popups->id_popups?>,
    title: '<?=$Popups->title?>',
    content: '<?=$Popups->content?>',
    show: <?=$Popups->show?>,
    cssStyleID:'main',
    cssStyleURL: '<?=Yii::app()->request->hostinfo.$mainCssAssetsUrl?>',
    cssAnimID: '<?=$Popups->animation?>',
    cssAnimURL: '<?=Yii::app()->request->hostinfo.$animationAssetsURL?>',
    allow_count: <?=$Popups->allow_count?>,
    countOpenUrl:'<?=Yii::app()->request->hostinfo . "/popups/default/count/" . $Popups->id_popups?>'
});
