<?php

namespace app\enums;

use yii2mod\enum\helpers\BaseEnum;

class PromoCodeStatusEnum extends BaseEnum
{
    const NOT_ACTIVE = 0;
    const ACTIVE   = 1;

    /**
     * @var array
     */
    public static $list = [
        self::NOT_ACTIVE => 'Не активен',
        self::ACTIVE => 'Активен',
    ];
}