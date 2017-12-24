<?php

namespace app\modules\api\forms;

use app\models\TariffZone;
use yii\base\Model;

/**
 * Class ActivateForm
 * @package app\modules\api\forms
 */
class ActivateForm extends Model
{
    /**
     * @var int
     */
    public $name;

    /**
     * @var int
     */
    public $tariff_zone;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string'],

            ['tariff_zone', 'required'],
            ['tariff_zone', 'in', 'range' => TariffZone::find()->asArray()->select(['id'])->column()],
        ];
    }
}