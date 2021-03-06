<?php

namespace app\models;

use app\enums\PromoCodeStatusEnum;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "promo_codes".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_start
 * @property string $date_end
 * @property string $client_reward
 * @property integer $status
 * @property integer $tariff_zone_id
 *
 * @property-read TariffZone $tariffZone
 * @property-read string $statusName
 */
class PromoCode extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%promo_codes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['date_start', 'date_end'], 'safe'],
            [['client_reward'], 'number'],
            [['status', 'tariff_zone_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTariffZone()
    {
        return $this->hasOne(TariffZone::class, ['id' => 'tariff_zone_id']);
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return PromoCodeStatusEnum::getLabel($this->status);
    }
}
