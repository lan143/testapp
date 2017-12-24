<?php

namespace app\modules\api\services;

use app\enums\PromoCodeStatusEnum;
use app\modules\api\models\PromoCode;

/**
 * Class PromocodesService
 * @package app\modules\api\services
 */
class PromoCodesService
{
    /**
     * @param PromoCode $promoCode
     * @return void
     * @throws PromocodesServiceException
     */
    public function activate(PromoCode $promoCode)
    {
        $promoCode->status = PromoCodeStatusEnum::ACTIVE;

        if (!$promoCode->save()) {
            throw new PromocodesServiceException('Cant save promocode');
        }
    }
}