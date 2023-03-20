<?php 
$this->beginContent('//layouts/main');
Helpers::RegisterCssFile('/css/main.css');
?>
<div id="container">
    <div id="content">
        <div id="header">&nbsp;</div>
        <div id="pagebody">
            <nav class="navbar navbar-inverse" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    <ul class="nav navbar-nav">
                        <?if(Access::getModuleAccess(Array('module'=>'users', 'controller' => 'admin'))):?>
                            <li><a href="<?=Yii::app()->createUrl('/users/admin/')?>"><?=Yii::t('project','Пользователи')?></a></li>
                        <?endif?>
                        <?if(Access::getModuleAccess(Array('module'=>'users', 'controller' => 'admin'))):?>
                            <li><a href="<?=Yii::app()->createUrl('/popups/admin/')?>"><?=Yii::t('project','Всплывающие окна')?></a></li>
                        <?endif?>
                     </ul>
                    
                    <div class="pull-right">
                        <? if(Yii::app()->user->isGuest):?>
                            <a href="<?=Yii::app()->createUrl('/login')?>" class="btn btn-success navbar-btn"><span class="glyphicon glyphicon-log-in"></span> <?=Yii::t('project','Войти')?></a>
                        <?else:?>
                            <a href="<?=Yii::app()->createUrl('/logout')?>" class="btn btn-warning navbar-btn"><span class="glyphicon glyphicon-log-in"></span> <?=Yii::t('project','Выход')?></a>
                        <?endif?>
                    </div>
                </div>
            </nav>

            <?=$content?>
            
        </div>
    </div>
    <div id="footer">
        <div id="foot">
            <div class="logo"><?=Yii::t('project', 'Всплывающие окна')?></div>
        </div>
    </div><!-- end of #footer -->
</div>
<?php $this->endContent(); ?>