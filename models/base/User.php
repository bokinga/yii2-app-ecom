<?php

namespace app\models\base;

/**
 * This is the base model class for table "eco_user".
 *
 * @property integer $id
 * @property string $name
 *
 * @property \app\models\Order[] $orders
 * @property \app\models\Payment[] $payments
 * @method static \yii\db\ActiveQuery|\app\models\User|null find($q=null)
 */
abstract class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eco_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['name'], 'string', 'max' => 255]
		];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getOrders()
    {
        return $this->hasMany(\app\models\Order::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getPayments()
    {
        return $this->hasMany(\app\models\Payment::className(), ['user_id' => 'id']);
    }
}
