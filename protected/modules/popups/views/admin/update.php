<?
$this->getModule()->registerScriptFile('popups.js');
$this->getModule()->registerScriptFile('admin.update.js');
Yii::app()->clientScript->registerPackage('select2');

$scriptArrAnimations = [];
$mainCssAssetsUrl = $this->getModule()->publishFile('/css/popups.css');
$scriptArrAnimations[] = "'main'" . ": '".$mainCssAssetsUrl."'";

$arrCssAnimation = array_keys(Popups::getAnimation());

foreach($arrCssAnimation as $key){
    $animationAssetsURL = $this->getModule()->publishFile('/css/animation/'.$key.'.css');
    $scriptArrAnimations[] = "'".$key."'" . ": '".$animationAssetsURL."'";
}
Yii::app()->clientScript->registerScript('animationAssetsURL', 'const popupsAnimationUrl = {' . implode(',', $scriptArrAnimations) . '};', CClientScript::POS_BEGIN);

?>

<?$form = $this->beginWidget('CActiveForm', array('id'=>'PopupsForm','clientOptions'=>array('validateOnSubmit'=>false), 'htmlOptions' => array('role'=>'form', 'class' => 'vertical-form')));?>
                              
<div class="panel panel-primary">
    <div class="panel-heading">
        <?=$this->pageTitle ?>
    </div>
    <div class="panel-body">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->labelEx($Popups, 'title'); ?>
                    <?= $form->textField($Popups, 'title', array('maxlength' => 100, 'class'=>'form-control required'))?>
                    <?= $form->error($Popups, 'title'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?=$form->labelEx($Popups, 'show')?>
                    <?=$form->dropDownList($Popups, 'show', Popups::GetShow(), Array('class'=>'select2 required')) ?>
                    <?= $form->error($Popups, 'show'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?=$form->labelEx($Popups, 'animation')?>
                    <?=$form->dropDownList($Popups, 'animation', Popups::GetAnimation(), Array('class'=>'select2 required')) ?>
                    <?= $form->error($Popups, 'animation'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?=$form->labelEx($Popups, 'allow_count')?>
                    <?=$form->dropDownList($Popups, 'allow_count', Popups::GetAllowCount(), Array('class'=>'select2 required')) ?>
                    <?= $form->error($Popups, 'allow_count'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= $form->labelEx($Popups, 'content'); ?>
                    <?= $form->textArea($Popups, 'content', array('rows' => 6, 'cols' => 50, 'class'=>'form-control required'));?>
                    <?= $form->error($Popups, 'content'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <div class="row">
            <div class="col-xs-6">
                <button onclick="return DiableSubmitButton(this)" class="btn btn-success" type="submit"  id="FormSubmitBtn"><?=Yii::t('popups', 'Сохранить')?></button> | 
                <button onclick="return showPopups()" class="btn btn-primary" type="button"  id="FormSubmitBtn"><?=Yii::t('popups', 'Просмотр')?></button>
            </div>
        </div>
    </div>
    
</div>

<? $this->endWidget(); ?>