<?php

namespace app\models\ar;

use yii\web\IdentityInterface;

/**
 * This is the model class for table "eco_user".
 *
 */
class User extends base\User implements IdentityInterface
{


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return User::find($id);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $authKey == $this->id;
    }
}
