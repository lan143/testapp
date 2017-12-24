<?php

namespace app\modules\api\controllers;

use app\enums\PromoCodeStatusEnum;
use app\models\TariffZone;
use app\modules\api\BaseController;
use app\modules\api\forms\ActivateForm;
use app\modules\api\forms\SearchForm;
use app\modules\api\models\PromoCode;
use app\modules\api\services\PromoCodesService;
use app\modules\api\services\PromocodesServiceException;
use Yii;
use yii\base\DynamicModel;
use yii\filters\Cors;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Class PromoCodesController
 * @package app\modules\api\controllers
 */
class PromoCodesController extends BaseController
{
    public $modelClass = PromoCode::class;

    /**
     * @var PromoCodesService
     */
    private $promoCodesService;

    /**
     * PromoCodesController constructor.
     * @param $id
     * @param $module
     * @param PromoCodesService $promoCodesService
     * @param array $config
     */
    public function __construct($id, $module, PromoCodesService $promoCodesService, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->promoCodesService = $promoCodesService;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['http://testapp.local'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 3600,
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];

        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    /**
     * @return SearchForm|PromoCode[]
     * @throws \yii\base\InvalidConfigException
     */
    public function actionSearch()
    {
        /** @var SearchForm $searchForm */
        $searchForm = Yii::createObject([
            'class' => SearchForm::class,
        ]);

        if ($searchForm->load(Yii::$app->getRequest()->getQueryParams(), '') && $searchForm->validate()) {
            return PromoCode::find()->andFilterWhere(['name' => $searchForm->name])->all();
        } else {
            return $searchForm;
        }
    }

    /**
     * @return ActivateForm|array|object
     * @throws NotFoundHttpException
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionActivate()
    {
        /** @var ActivateForm $activateForm */
        $activateForm = Yii::createObject([
            'class' => ActivateForm::class,
        ]);

        if ($activateForm->load(Yii::$app->getRequest()->getBodyParams(), '') && $activateForm->validate()) {
            $promoCode = PromoCode::find()
                ->andWhere(['name' => $activateForm->name])
                ->andWhere(['tariff_zone_id' => $activateForm->tariff_zone])
                ->one();

            if ($promoCode) {
                try {
                    $this->promoCodesService->activate($promoCode);

                    return [
                        'client_reward' => $promoCode->client_reward,
                    ];
                } catch (PromocodesServiceException $e) {
                    throw new ServerErrorHttpException($e->getMessage());
                }
            } else {
                throw new NotFoundHttpException();
            }
        } else {
            return $activateForm;
        }
    }
}