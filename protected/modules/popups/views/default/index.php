<script type="text/javascript" src="<?=Yii::app()->request->hostinfo?>/popups/default/run/1.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->hostinfo?>/popups/default/run/2.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->hostinfo?>/popups/default/run/3.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->hostinfo?>/popups/default/run/4.js"></script>

<div class="panel panel-primary">
    <div class="panel-heading">
        Демонстрация всплывающих окон
    </div>
    <div class="panel-body">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <button class="btn popups-btn" type="button">Открыть окно 1</button> 
                    <script type="text/javascript">
                    // событие нажатия на кнопку
                    $( ".popups-btn" ).click(function() {
                        // popups1, 1 это id окна - id окна
                        popups1.openPopup();
                    });
                    </script>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button class="btn popups-btn2" type="button">Открыть окно 2</button>
                    <script type="text/javascript">
                    // событие нажатия на кнопку
                    $( ".popups-btn2" ).click(function() {
                        // popups2, 2 это id окна - id окна
                        popups2.openPopup();
                    });
                    </script>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <button class="btn popups-btn3" type="button">Открыть окно 3</button>
                    <script type="text/javascript">
                    // событие нажатия на кнопку
                    document.querySelectorAll('.popups-btn3').forEach( button => {
                        button.onclick = function (e) {
                            // popups3, 3 это id окна
                            popups3.openPopup();
                        }
                    });
                    </script>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button class="btn popups-btn4" type="button">Открыть окно 4</button>
                    <script type="text/javascript">
                    // событие нажатия на кнопку
                    $( ".popups-btn4" ).click(function() {
                        // установка других настроек окна
                        popups4.setSettings({
                            title: 'Смена заголовка окна 4',
                            content: 'Смена содержания окна 4',
                        });
                        // popups4, 4 это id окна - id окна
                        popups4.openPopup();
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>