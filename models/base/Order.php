<?php

namespace app\models\base;

/**
 * This is the base model class for table "eco_order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $status
 * @property string $created
 *
 * @property \app\models\Invoice[] $invoices
 * @property \app\models\User $user
 * @property \app\models\OrderLine[] $orderLines
 * @property \app\models\Payment[] $payments
 * @method static \yii\db\ActiveQuery|\app\models\Order|null find($q=null)
 */
abstract class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eco_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['user_id', 'status', 'created'], 'required'],
			[['user_id'], 'integer'],
			[['created'], 'safe'],
			[['status'], 'string', 'max' => 20]
		];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getInvoices()
    {
        return $this->hasMany(\app\models\Invoice::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getOrderLines()
    {
        return $this->hasMany(\app\models\OrderLine::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getPayments()
    {
        return $this->hasMany(\app\models\Payment::className(), ['order_id' => 'id']);
    }
}
