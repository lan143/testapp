<?php

namespace app\controllers;

use app\forms\PromocodeForm;
use app\models\PromoCode;
use app\models\TariffZone;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;

class PromocodesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        $dataProvider = Yii::createObject([
            'class' => ActiveDataProvider::class,
            'query' => PromoCode::find()
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
        /** @var PromocodeForm $model */
        $model = Yii::createObject([
            'class' => PromocodeForm::class,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Промокод успешно добавлен');

            return $this->redirect(['index']);
        }

        $tariffZones = ArrayHelper::map(TariffZone::find()->all(), 'id', 'name');

        return $this->render('create', [
            'model' => $model,
            'tariffZones' => $tariffZones,
        ]);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate($id)
    {
        $promocode = PromoCode::findOne($id);

        if ($promocode === null) {
            throw new NotFoundHttpException();
        }

        /** @var PromocodeForm $model */
        $model = Yii::createObject([
            'class' => PromocodeForm::class,
            'promocode' => $promocode,
            'scenario' => PromocodeForm::SCENARIO_UPDATE,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Промокод успешно обновлен');

            return $this->redirect(['index']);
        }

        $tariffZones = ArrayHelper::map(TariffZone::find()->all(), 'id', 'name');

        return $this->render('update', [
            'model' => $model,
            'tariffZones' => $tariffZones,
        ]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws ServerErrorHttpException
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $promocode = PromoCode::findOne($id);

        if ($promocode === null) {
            throw new NotFoundHttpException();
        }

        if ($promocode->delete()) {
            return $this->redirect(['index']);
        }

        throw new ServerErrorHttpException();
    }
}
