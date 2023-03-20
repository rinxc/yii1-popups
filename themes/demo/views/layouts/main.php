<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?= Yii::app()->theme->baseUrl ?>/assets/img/favicon.ico">

    <?= CHtml::cssFile(Yii::app()->theme->baseUrl.'/assets/lib/bootstrap-3.3.2/css/bootstrap.min.css')."\n"?>
    <?= CHtml::cssFile(Yii::app()->theme->baseUrl.'/assets/lib/bootstrap-3.3.2/css/bootstrap-theme.min.css')."\n"?>
    <?= CHtml::cssFile(Yii::app()->theme->baseUrl.'/assets/css/font-awesome/css/font-awesome.min.css')."\n"?>
    <?= CHtml::cssFile(Yii::app()->theme->baseUrl.'/assets/css/global.css')."\n"?>
    
    <?= CHtml::scriptFile(Helpers::PublishFile('/lib/jquery/jquery-3.2.1.min.js'))."\n"?>
    <?= CHtml::scriptFile(Helpers::PublishFile('/lib/bootstrap-3.3.2/js/bootstrap.min.js'))."\n"?>

    <title><?= CHtml::encode($this->pageTitle)?></title>
</head>
<body>
    <?=$content?>
</body>
</html>