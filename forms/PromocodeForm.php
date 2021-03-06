<?php

namespace app\forms;

use app\enums\PromoCodeStatusEnum;
use app\models\PromoCode;
use app\models\TariffZone;
use DateTime;
use Yii;
use yii\base\Model;

/**
 * Class PromocodeForm
 * @package app\forms
 */
class PromocodeForm extends Model
{
    const SCENARIO_UPDATE = 'update';

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $date_start;

    /**
     * @var string
     */
    public $date_end;

    /**
     * @var string
     */
    public $client_reward;

    /**
     * @var int
     */
    public $tariff_zone_id;

    /**
     * @var int
     */
    public $status;

    /**
     * @var PromoCode
     */
    private $_promocode;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();

        if ($this->_promocode === null) {
            $this->_promocode = Yii::createObject([
                'class' => PromoCode::class,
                'status' => PromoCodeStatusEnum::ACTIVE,
            ]);

            $this->status = PromoCodeStatusEnum::ACTIVE;
        }
    }

    /**
     * @return PromoCode
     */
    public function getPromocode()
    {
        return $this->_promocode;
    }

    /**
     * @param PromoCode $promocode
     */
    public function setPromocode(PromoCode $promocode)
    {
        $this->_promocode = $promocode;

        $this->setAttributes($promocode->getAttributes($this->getSavedAttributes()));
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string'],
            ['name', 'match', 'pattern' => '/^[a-zA-Z]+$/i'],

            [['date_start', 'date_end'], 'required'],
            [['date_start', 'date_end'], 'date', 'format' => 'php:Y-m-d'],
            ['date_end', 'dateEndValidator'],

            ['client_reward', 'required'],
            ['client_reward', 'number', 'min' => 0.01],

            ['tariff_zone_id', 'required'],
            ['tariff_zone_id', 'in', 'range' => TariffZone::find()->asArray()->select(['id'])->column()],

            ['status', 'required', 'on' => self::SCENARIO_UPDATE],
            ['status', 'in', 'range' => array_keys(PromoCodeStatusEnum::listData())],
            ['status', 'statusValidator'],
        ];
    }

    /**
     * @param string $attribute
     */
    public function statusValidator($attribute)
    {
        if ($this->_promocode->status == PromoCodeStatusEnum::NOT_ACTIVE) {
            $this->addError($attribute, 'Вы не можете редактировать не активный промокод');
        }
    }

    /**
     * @param string $attribute
     */
    public function dateEndValidator($attribute)
    {
        $dateStart = new DateTime($this->date_start);
        $dateEnd = new DateTime($this->date_end);

        if ($dateStart > $dateEnd) {
            $this->addError($attribute, 'Дата окончания не может быть меньше даты начала');
        }
    }

    /**
     * @return bool
     */
    public function save()
    {
        if ($this->validate()) {
            $this->_promocode->setAttributes($this->getAttributes($this->getSavedAttributes()));

            if ($this->_promocode->save()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'client_reward' => 'Вознаграждение клиента',
            'tariff_zone_id' => 'Тарифная зона',
            'status' => 'Статус',
        ];
    }

    /**
     * @return array
     */
    protected function getSavedAttributes()
    {
        return [
            'name',
            'date_start',
            'date_end',
            'client_reward',
            'tariff_zone_id',
            'status',
        ];
    }
}