<?php

use app\enums\PromoCodeStatusEnum;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*
 * @var yii\web\View $this
 * @var \app\forms\PromocodeForm $model
 * @var array $tariffZones
*/

$disabledArr = !$model->getPromocode()->isNewRecord && $model->status == PromoCodeStatusEnum::NOT_ACTIVE
    ? ['disabled' => 'true'] : [];
?>
<?php $form = ActiveForm::begin(); ?>

<?php if ($model->hasErrors()): ?>
    <div class="alert alert-danger">
        <?= $form->errorSummary($model) ?>
    </div>
<?php endif ?>

<?= $form->field($model, 'name')->textInput($disabledArr) ?>

<?= $form->field($model, 'date_start')->textInput(ArrayHelper::merge(['type' => 'date'], $disabledArr)) ?>

<?= $form->field($model, 'date_end')->textInput(ArrayHelper::merge(['type' => 'date'], $disabledArr)) ?>

<?= $form->field($model, 'client_reward')->textInput(ArrayHelper::merge([
    'type' => 'number', 'min' => 0, 'step' => 0.01], $disabledArr)) ?>

<?= $form->field($model, 'tariff_zone_id')->dropDownList($tariffZones, ArrayHelper::merge([
    'prompt' => 'Не выбрано',
], $disabledArr)) ?>

<?php if (!$model->getPromocode()->isNewRecord): ?>
    <?= $form->field($model, 'status')->dropDownList(PromoCodeStatusEnum::listData(), ArrayHelper::merge([
        'prompt' => 'Не выбрано',
    ], $disabledArr)) ?>
<?php endif ?>

<div class="form-group" style="margin-top: 10px;">
    <?= Html::submitButton($model->getPromocode()->isNewRecord ? 'Добавить' : 'Обновить',
        ArrayHelper::merge(['class' => $model->getPromocode()->isNewRecord ? 'btn btn-success' : 'btn btn-primary'], $disabledArr)) ?>
</div>

<?php ActiveForm::end(); ?>