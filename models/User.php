<?php

namespace app\models;

use yii\base\Model;
use yii\web\IdentityInterface;

class User extends Model implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return new self();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        if ($token == 'tumvrtvrtyerty445t45') {
            return new self();
        }

        return null;
    }

    public function validateAuthKey($authKey)
    {
        return true;
    }

    public function getId()
    {
        return 1;
    }

    public function getAuthKey()
    {
        return '543534gfdgdfgdf';
    }
}