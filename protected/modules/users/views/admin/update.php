<?
Yii::app()->clientScript->registerPackage('select2');
?>
<?$form = $this->beginWidget('CActiveForm', array('id'=>'UsersForm','clientOptions'=>array('validateOnSubmit'=>false), 'htmlOptions' => array('role'=>'form', 'class' => 'vertical-form')));?>
                              
<div class="panel panel-primary">
    <div class="panel-heading">
        <?=$this->pageTitle ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->labelEx($Users, 'login'); ?>
                    <?= $form->textField($Users, 'login', array('maxlength' => 50, 'class'=>'form-control required'))?>
                    <?= $form->error($Users, 'login'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= ($Users->isNewRecord) ? $form->labelEx($Users, 'password') : Yii::t('users', 'Сменить пароль'); ?>
                    <span class="input-group">
                        <?=$form->textField($Users, 'password', array('value'=>'', 'maxlength' => 50, 'class'=>'form-control required')); ?>
                        <span class="input-group-btn">
                            <button class="btn btn-default" title="<?=Yii::t('users', 'Сгенерировать пароль')?>" id="gen-pass" type="button"><span class="glyphicon glyphicon-cog"></span></button>
                        </span>
                    </span>
                    <?= $form->error($Users, 'password'); ?>
                </div>
            </div>
        </div>
        
       <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?=$form->labelEx($Users, 'active')?>
                    <?=$form->dropDownList($Users, 'active', Users::GetActive(), Array('class'=>'select2  required')) ?>
                    <?= $form->error($Users, 'active'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?=$form->labelEx($Users,'id_users_groups')?>
                    <?=$form->dropDownList($Users,'id_users_groups', Users::UsersGroup(), array('class'=>'select2 required'))?>
                    <?= $form->error($Users, 'id_users_groups'); ?>
                </div>
            </div>
        </div>
        <!-- /box-body -->
    </div>
    
    
    <div class="panel-footer">
        <div class="row">
            <div class="col-xs-6">
                <button onclick="return DiableSubmitButton(this)" class="btn btn-success" type="submit"  id="FormSubmitBtn"><?=Yii::t('users', 'Сохранить')?></button>
            </div>
        </div>
    </div>
    
</div>
<script>
    $(function() {
        //Скрипт генерации паролей
        function str_rand() {
            var result       = '';
            var words        = '0123456789qwertyuipazxcvbnmQWERTYUIPASDFGHJKLZXCVBNM';
            var max_position = words.length - 1;
                for( i = 0; i < 12; ++i ) {
                    position = Math.floor ( Math.random() * max_position );
                    result = result + words.substring(position, position + 1);
                }
            return result;
        }
        $('#gen-pass').click(function() {
            $('#Users_password').val(str_rand());
        });

        if($.fn.select2) {
            $('.select2').select2({
                placeholder: '',
                allowClear: true
            });
         }
    });
</script>
<? $this->endWidget(); ?>