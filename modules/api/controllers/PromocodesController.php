<?php

namespace app\modules\api\controllers;

use app\enums\PromoCodeStatusEnum;
use app\models\TariffZone;
use app\modules\api\BaseController;
use app\modules\api\models\PromoCode;
use Yii;
use yii\base\DynamicModel;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Class PromocodesController
 * @package app\modules\api\controllers
 */
class PromocodesController extends BaseController
{
    public $modelClass = PromoCode::class;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [];
    }

    /**
     * @return PromoCode[]|DynamicModel
     */
    public function actionSearch()
    {
        $form = new DynamicModel(['name']);
        $form->addRule('name', 'required');
        $form->addRule('name', 'string');
        $form->setAttributes(Yii::$app->getRequest()->getQueryParams());

        if ($form->validate()) {
            return PromoCode::find()->andFilterWhere(['name' => $form->name])->all();
        } else {
            return $form;
        }
    }

    /**
     * @return array|DynamicModel
     * @throws NotFoundHttpException
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionActivate()
    {
        $form = new DynamicModel(['name', 'tariff_zone']);
        $form->addRule('name', 'required');
        $form->addRule('name', 'string');
        $form->addRule('tariff_zone', 'required');
        $form->addRule('tariff_zone', 'in', ['range' => TariffZone::find()->asArray()->select(['id'])->column()]);
        $form->setAttributes(Yii::$app->getRequest()->getBodyParams());

        if ($form->validate()) {
            $promocode = PromoCode::find()
                ->andWhere(['name' => $form->name])
                ->andWhere(['tariff_zone_id' => $form->tariff_zone])
                ->one();

            if ($promocode) {
                $promocode->status = PromoCodeStatusEnum::ACTIVE;

                if ($promocode->save()) {
                    return [
                        'client_reward' => $promocode->client_reward,
                    ];
                } else {
                    throw new ServerErrorHttpException();
                }
            } else {
                throw new NotFoundHttpException();
            }
        } else {
            return $form;
        }
    }
}