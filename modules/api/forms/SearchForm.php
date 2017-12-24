<?php

namespace app\modules\api\forms;

use yii\base\Model;

/**
 * Class SearchForm
 * @package app\modules\api\forms
 */
class SearchForm extends Model
{
    /**
     * @var int
     */
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string'],
        ];
    }
}