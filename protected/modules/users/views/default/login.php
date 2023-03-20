<div class="container-fluid">
    <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
        <? $form = $this->beginWidget('CActiveForm', array('id' => 'UsersForm', 'htmlOptions' => array('class' => 'UsersForm', 'role' => 'form')));?>
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h1><?=Yii::t('users','Авторизация')?></h1>
                </div>
                
                <div class="panel-body">
                    <div class="form-group">
                        <?= $form->labelEx($LoginForm, 'login'); ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <?= $form->textField($LoginForm, 'login', array('maxlength' => 50, 'class'=>'form-control required'))?>
                        </div>
                        <?= $form->error($LoginForm, 'login'); ?>
                    </div>
                    
                    <div class="form-group">
                        <?= $form->labelEx($LoginForm, 'password'); ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <?= $form->passwordField($LoginForm, 'password', array('maxlength' => 50, 'class'=>'form-control required'))?>
                        </div>
                        <?= $form->error($LoginForm, 'password'); ?>
                    </div>
                </div>
                
                
                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-lg btn-success"><i class="glyphicon glyphicon-log-in"></i> <?=Yii::t('users','Войти')?></button>
                </div>
            </div>
        <?php $this->endWidget();?>
    </div>
</div>