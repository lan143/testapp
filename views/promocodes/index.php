<?php

/*
 * @var View $this
 * @var array $tariffZones
 */

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

<div>
    <h3>Search</h3>

    <div id="search-results">
    </div>

    <input type="text" name="search" placeholder="Please enter name..." />
</div>

<div>
    <h3>Activate</h3>

    <form name="activate">
        <input type="text" name="name" placeholder="Please enter name..." />

        <select name="tariff_code">
            <?php foreach($tariffZones as $id => $name): ?>
                <option value="<?= $id ?>"><?= $name ?></option>
            <?php endforeach ?>
        </select>

        <input type="submit" value="Activate" />
    </form>
</div>