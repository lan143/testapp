<?php

namespace app\modules\api\models;

use yii\helpers\ArrayHelper;

class PromoCode extends \app\models\PromoCode
{
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'date_start',
            'date_end',
            'client_reward',
            'tariff_zone' => 'tariffZone',
            'status_name' => 'statusName',
        ];
    }
}