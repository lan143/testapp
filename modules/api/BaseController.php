<?php

namespace app\modules\api;

use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

/**
 * Class BaseController
 * @package app\modules\api
 */
class BaseController extends ActiveController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['bearerAuth'] = [
            'class' => HttpBearerAuth::class,
        ];

        return $behaviors;
    }
}