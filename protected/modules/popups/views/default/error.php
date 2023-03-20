<div class="panel panel-primary">
    <div class="panel-heading">
        <?=Yii::t('yii', 'Ошибка')?>
    </div>
    <div class="panel-body">
        
        <div class="row">
            <div class="col-md-12">
                <?=CHtml::encode($message); ?>
            </div>
        </div>
    </div>
</div>