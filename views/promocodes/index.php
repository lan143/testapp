<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Test App';
?>
<div class="site-index">
    <p>
        <?= Html::a('Добавить промокод', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => '№',
                'attribute' => 'id',
            ],
            [
                'label' => 'Дата начала',
                'attribute' => 'date_start',
            ],
            [
                'label' => 'Дата окончания',
                'attribute' => 'date_end',
            ],
            [
                'label' => 'Вознаграждение клиента',
                'attribute' => 'client_reward',
            ],
            [
                'label' => 'Тарифная зона',
                'attribute' => 'tariffZone.name',
            ],
            [
                'label' => 'Статус',
                'attribute' => 'statusName',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
