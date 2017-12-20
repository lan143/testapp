<?php

/*
 * @var yii\web\View $this
 * @var \app\forms\PromocodeForm $model
 * @var array $tariffZones
*/

$this->title = 'Добавить промокод';
?>
<?= $this->render('_form', [
    'model' => $model,
    'tariffZones' => $tariffZones
]) ?>