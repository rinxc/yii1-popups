<?
$this->getModule()->registerScriptFile('popups.js');
$this->getModule()->registerScriptFile('admin.views.js');

$scriptArrAnimations = [];

$mainCssAssetsUrl = $this->getModule()->publishFile('/css/popups.css');
$scriptArrAnimations[] = "'main'" . ": '".$mainCssAssetsUrl."'";
$animationAssetsURL = $this->getModule()->publishFile('/css/animation/'.$Popups->animation.'.css');
$scriptArrAnimations[] = "'".$Popups->animation."'" . ": '".$animationAssetsURL."'";

Yii::app()->clientScript->registerScript('animationAssetsURL', 'const popupsAnimationUrl = {' . implode(',', $scriptArrAnimations) . '};', CClientScript::POS_HEAD);

?>
             
<div class="panel panel-primary">
    <div class="panel-heading">
        <?=$this->pageTitle ?>
    </div>
    <div class="panel-body">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h3><?=$Popups->getAttributeLabel('title')?></h3>
                    <div id="Popups_title"><?= $Popups->title; ?></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h3><?=$Popups->getAttributeLabel('show')?></h3>
                    <div><?= Popups::GetShow($Popups->show) ?></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h3><?=$Popups->getAttributeLabel('animation')?></h3>
                    <div id="Popups_animation" data-id="<?=$Popups->animation?>"><?= Popups::GetAnimation($Popups->animation) ?></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h3><?=$Popups->getAttributeLabel('allow_count')?></h3>
                    <div><?= Popups::GetAllowCount($Popups->allow_count) ?></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h3><?=$Popups->getAttributeLabel('title')?></h3>
                    <div id="Popups_content"><?= $Popups->content; ?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h3><?=Yii::t('popups', 'Встроить всплывающее окно на сайте')?></h3>
                    <div id="Popups_content"><textarea class="form-control textarea" rows="1" readonly>
&lt;script type="text/javascript" src="<?=Yii::app()->request->hostinfo . "/popups/default/run/" . $Popups->id_popups?>.js"&gt;&lt;/script&gt;</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h3><?=Yii::t('popups', 'Вызов окна с помощью плагина Jquery')?></h3>
                    <div id="Popups_content"><textarea class="form-control textarea" readonly rows="11">
<!-- HTML кнопка вызова на странице -->
<button class="btn popups-btn" type="button"><?=Yii::t('popups', 'Открыть окно')?></button>
 
<script type="text/javascript">
// событие нажатия на кнопку
$( ".popups-btn" ).click(function() {
    // popups<?=$Popups->id_popups?>, <?=$Popups->id_popups?> это id окна - id окна
    popups<?=$Popups->id_popups?>.openPopup(<?=$Popups->id_popups?>);
});
</script>
</textarea>                  


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h3><?=Yii::t('popups', 'Вызов окна с помощью JavaScript')?></h3>
                    <div id="Popups_content"><textarea class="form-control textarea" readonly rows="13">
<!-- HTML кнопка вызова на странице -->
<button class="btn popups-btn" type="button"><?=Yii::t('popups', 'Открыть окно')?></button>
 
<script type="text/javascript">
// событие нажатия на кнопку
document.querySelectorAll('.popups-btn').forEach( button => {
    button.onclick = function (e) {
        // popups<?=$Popups->id_popups?>, <?=$Popups->id_popups?> это id окна
        popups<?=$Popups->id_popups?>.openPopup();
    }
});
</script>
</textarea>                  


                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h3><?=Yii::t('popups', 'Вызов окна с другими настройками окна')?></h3>
                    <div id="Popups_content"><textarea class="form-control textarea" readonly rows="15">
<!-- HTML кнопка вызова на странице -->
<button class="btn popups-btn" type="button"><?=Yii::t('popups', 'Открыть окно')?></button>
<script type="text/javascript">
// событие нажатия на кнопку
$( ".popups-btn" ).click(function() {
    // установка других настроек окна
    popups<?=$Popups->id_popups?>.setSettings({
        title: 'Смена заголовка окна <?=$Popups->id_popups?>',
        content: 'Смена содержания окна <?=$Popups->id_popups?>',
    });
    // popups<?=$Popups->id_popups?>, <?=$Popups->id_popups?> это id окна - id окна
    popups<?=$Popups->id_popups?>.openPopup();
});
</script>
</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <div class="row">
            <div class="col-xs-6">
               <button onclick="return showPopups()" class="btn btn-primary" type="button"  id="FormSubmitBtn"><?=Yii::t('popups', 'Просмотр')?></button>
            </div>
        </div>
    </div>
    
</div>