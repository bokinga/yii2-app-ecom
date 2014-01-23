<?php

namespace app\models\base;

/**
 * This is the base model class for table "eco_order_line".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $quantity
 *
 * @property \app\models\InvoiceLine[] $invoiceLines
 * @property \app\models\Product $product
 * @property \app\models\Order $order
 * @method static \yii\db\ActiveQuery|\app\models\OrderLine|null find($q=null)
 */
abstract class OrderLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eco_order_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['order_id', 'product_id', 'quantity'], 'required'],
			[['order_id', 'product_id'], 'integer'],
			[['quantity'], 'number']
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
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getInvoiceLines()
    {
        return $this->hasMany(\app\models\InvoiceLine::className(), ['order_line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getProduct()
    {
        return $this->hasOne(\app\models\Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getOrder()
    {
        return $this->hasOne(\app\models\Order::className(), ['id' => 'order_id']);
    }
}
