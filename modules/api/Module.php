<?php

namespace app\modules\api;

use Yii;
use yii\web\JsonParser;

/**
 * Class Module
 * @package app\modules\api
 */
class Module extends \yii\base\Module
{
    /**
     * @var string
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->request->parsers['application/json'] = JsonParser::class;
    }
}