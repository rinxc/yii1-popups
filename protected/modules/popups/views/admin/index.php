<div class="panel panel-primary">
    <div class="panel-heading">
        <?=CHtml::link('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('popups', 'Добавить всплывающее окно'), Yii::app()->createUrl("/popups/admin/update/"), array('class'=>'btn btn-success'))?>
    </div>
    <div class="table-overflow">
        <?php 

        $this->widget('zii.widgets.grid.CGridView', array(
            'id'    =>  'Popups-grid',
            'dataProvider' => $Popups->search(),
            'filter' => $Popups,
            'columns' => array( 
                array(
                    'header' =>'№',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                    'headerHtmlOptions' => array('class'=>'text-center width-30'),
                    'htmlOptions' => array('class'=>' text-center'),
                ),
                
                array(
                    'header' => Yii::t('popups', 'Действие'),
                    'class'=>'CButtonColumn',
                    'template'=>'<span class="width-120 btn-group">{view}{update}</span>',
                    'buttons'=>array
                    (   
                        'view'=>array(
                            'options' => array(
                                'class' => 'btn-view btn btn-success btn-sm',
                                'title' => Yii::t('popups', 'Просмотр'),
                            ),
                            'label'=>'<i class="glyphicon glyphicon-search"></i>',
                            'imageUrl'=>false,
                            'url'=>'Yii::app()->createUrl("/popups/admin/view/".$data->id_popups)',
                        ),
                        'update' => array
                        (
                            'options' => array(
                                'class' => 'btn-update btn btn-primary btn-sm', 
                                'title'=>Yii::t('popups', 'Редактировать')
                            ),
                            'label'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
                            'imageUrl'=>false,
                            'url'=>'Yii::app()->createUrl("/popups/admin/update/" . $data->id_popups)',
                        ),
                    ),
                    'htmlOptions' => array('class'=>' text-center'),
                    'headerHtmlOptions' => array('class'=>'width-80 text-center'),
                ),
                'id_popups',
                'title',
                array(
                    'name' => 'show',
                    'value' => 'Popups::GetShow($data->show)',
                    'filter' => Popups::GetShow(),
                    'type'=>'raw'
                ),
                array(
                    'name' => 'animation',
                    'value' => 'Popups::GetAnimation($data->animation)',
                    'filter' => Popups::GetAnimation(),
                    'type'=>'raw'
                ),
                array(
                    'header' => Yii::t('popups', 'Показы'),
                    'name' => 'allow_count',
                    'value' => '$data->allow_count ? $data->count : Popups::GetAllowCount($data->allow_count)',
                    'filter' => Popups::GetAllowCount(),
                    'type'=>'raw'
                ),
                array(
                    'header' => Yii::t('popups', 'Удаление'),
                    'class'=>'CButtonColumn',
                    'template'=>'<span class="width-40 btn-group">{delete}</span>',
                    'buttons'=>array(
                        'delete' => array
                        (
                            'options' => Array('class' => 'btn-delete btn btn-danger btn-sm', 'title'=>Yii::t('popups', 'Удалить')),
                            'label'=>'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>',
                            'imageUrl'=>false,
                            'url'=>'Yii::app()->createUrl("/popups/admin/delete/".$data->id_popups)',
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