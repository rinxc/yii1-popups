<div class="panel panel-primary">
    <div class="panel-heading">
        <?=CHtml::link('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('users', 'Добавить пользователя'), Yii::app()->createUrl("/users/admin/update/"), array('class'=>'btn btn-success'))?>
    </div>
    <div class="table-overflow">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'    =>  'Users-grid',
            'dataProvider' => $Users->search(),
            'filter' => $Users,
            'columns' => array( 
                array(
                    'header' =>'№',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                    'headerHtmlOptions' => array('class'=>'text-center width-30'),
                    'htmlOptions' => array('class'=>' text-center'),
                    
                ),
                array(
                    'header' => Yii::t('users', 'Действие'),
                    'class'=>'CButtonColumn',
                    'template'=>'<span class="width-40 btn-group">{update}</span>',
                    'buttons'=>array
                    (   
                        
                        'update' => array
                        (
                            'options' => Array('class' => 'btn-update btn btn-primary btn-sm', 'title'=>Yii::t('users', 'Редактировать')),
                            'label'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
                            'imageUrl'=>false,
                            'url'=>'Yii::app()->createUrl("/users/admin/update/" . $data->id_users)',
                        ),
                    ),
                    'htmlOptions' => array('class'=>' text-center'),
                    'headerHtmlOptions' => array('class'=>'width-80 text-center'),
                ),
                /*
                array(
                    'name' => 'id_users_groups',
                    'value' => 'Users::UsersGroup($data->id_users_groups)',
                    'filter' =>  Users::UsersGroup(),
                    'type'=>'raw'
                ),
                */
                'login',
                array(
                    'name' => 'active',
                    'value' => 'Users::GetActive($data->active)',
                    'filter' => Users::GetActive(),
                    'type'=>'raw'
                ),
                array(
                    'header' => Yii::t('users', 'Удаление'),
                    'class'=>'CButtonColumn',
                    'template'=>'<span class="width-40 btn-group">{delete}</span>',
                    'buttons'=>array(
                        'delete' => array
                        (
                            'options' => Array('class' => 'btn-delete btn btn-danger btn-sm', 'title'=>Yii::t('users', 'Удалить')),
                            'label'=>'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>',
                            'imageUrl'=>false,
                            'url'=>'Yii::app()->createUrl("/users/admin/delete/", array("id" => $data->id_users))',
                            'click'=>'function(){
                                var targetUrl = $(this).attr("href");
                                AlertConfirm("'.Yii::t('popups', 'Вы действительно хотите удалить данную запись?').'", targetUrl); return false;
                            }',
                        ),
                    ),
                    'htmlOptions' => array('class'=>' text-center'),
                    'headerHtmlOptions' => array('class'=>'width-40 text-center'),
                ),
            ),
        ));
        ?>
    </div>
    
</div>