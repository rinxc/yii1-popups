<?php 
$this->beginContent('//layouts/main');
/*bootbox всплывающие модальные окна */
Helpers::RegisterScriptFile('/plugins/bootbox/bootbox.min.js');
Helpers::RegisterScriptFile('/plugins/bootbox/bootbox.ru.js');

Helpers::RegisterScriptFile('/js/admin.js');
Helpers::RegisterScriptFile('/js/lang/'.Yii::app()->language.'.js');
Helpers::RegisterCssFile('/css/admin.css');

?>
<div id="container">
    <div id="content">
        <div id="header">&nbsp;</div>
        <div id="pagebody">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    <ul class="nav navbar-nav">
                        <li><a href="/"><?=Yii::t('project','Главная')?></a></li>
                        <?if(Access::getModuleAccess(Array('module'=>'users', 'controller' => 'admin'))):?>
                            <li><a href="<?=Yii::app()->createUrl('/users/admin/')?>"><?=Yii::t('users','Пользователи')?></a></li>
                        <?endif?>
                        <?if(Access::getModuleAccess(Array('module'=>'users', 'controller' => 'admin'))):?>
                            <li><a href="<?=Yii::app()->createUrl('/popups/admin/')?>"><?=Yii::t('popups','Всплывающие окна')?></a></li>
                        <?endif?>
                     </ul>
                    
                    <div class="pull-right">
                        <a href="<?=Yii::app()->createUrl('/logout')?>" class="btn btn-warning navbar-btn"><span class="glyphicon glyphicon-log-in"></span> <?=Yii::t('users','Выход')?></a>
                    </div>
                </div>
            </nav>
            
            <? if(isset($this->breadcrumbs)):?>
                <? $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
                    'tagName' => 'ul',
                    'activeLinkTemplate'   => '<li><a href="{url}">{label}</a></li>',
                    'inactiveLinkTemplate' => '<li>{label}</li>',
                    'separator' => '',
                    'homeLink' => '',
                    'htmlOptions' => array('class'=>'breadcrumb')
                )); ?>
            <?endif?>
            
            
            <?=$content?>
            
            <hr />
            <div id="notifications"></div>
        </div>
    </div>
    <div id="footer">
        <div id="foot">
            <div class="logo"><?=Yii::app()->name?></div>
        </div>
    </div><!-- end of #footer -->
</div>

<div class="loading modal in" style="z-index:100001; overflow: hidden; display: block;" aria-hidden="false">
    <div class="modal-loading"></div><!-- /.modal-dialog -->
</div>
<div class="loading modal-backdrop in" style="z-index:100000; width:100%; height:100%; overflow: hidden; display: block;"></div>
<script>
$(function() {
    $('.loading').hide();
});
</script>
<?php $this->endContent(); ?>