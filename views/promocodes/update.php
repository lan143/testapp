<?php

/*
 * @var yii\web\View $this
 * @var \app\forms\PromocodeForm $model
 * @var array $tariffZones
*/

$this->title = 'Редактирование промокода: ' . $model->name;
?>
<?= $this->render('_form', [
    'model' => $model,
    'tariffZones' => $tariffZones
]) ?>