<?php

namespace app\models\ar\base;

/**
 * This is the base model class for table "eco_invoice".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $due_amount
 * @property string $due_datetime
 * @property string $created
 *
 * @property \app\models\ar\Order $order
 * @property \app\models\ar\InvoiceLine[] $invoiceLines
 * @method static \yii\db\ActiveQuery|\app\models\ar\Invoice|null find($q=null)
 */
abstract class Invoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eco_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['order_id', 'due_amount', 'created'], 'required'],
			[['order_id', 'due_amount'], 'integer'],
			[['due_datetime', 'created'], 'safe']
		];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'due_amount' => 'Due Amount',
            'due_datetime' => 'Due Datetime',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getOrder()
    {
        return $this->hasOne(\app\models\ar\Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getInvoiceLines()
    {
        return $this->hasMany(\app\models\ar\InvoiceLine::className(), ['invoice_id' => 'id']);
    }
}
