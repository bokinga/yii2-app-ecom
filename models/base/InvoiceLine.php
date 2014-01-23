<?php

namespace app\models\base;

/**
 * This is the base model class for table "eco_invoice_line".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $order_line_id
 * @property integer $product_id
 * @property string $item_quantity
 * @property string $item_label
 * @property string $due_amount
 *
 * @property \app\models\Product $product
 * @property \app\models\Invoice $invoice
 * @property \app\models\OrderLine $orderLine
 * @method static \yii\db\ActiveQuery|\app\models\InvoiceLine|null find($q=null)
 */
abstract class InvoiceLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eco_invoice_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['invoice_id', 'item_quantity', 'item_label', 'due_amount'], 'required'],
			[['invoice_id', 'order_line_id', 'product_id'], 'integer'],
			[['item_quantity'], 'number'],
			[['item_label', 'due_amount'], 'string', 'max' => 255]
		];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'order_line_id' => 'Order Line ID',
            'product_id' => 'Product ID',
            'item_quantity' => 'Item Quantity',
            'item_label' => 'Item Label',
            'due_amount' => 'Due Amount',
        ];
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
    public function getInvoice()
    {
        return $this->hasOne(\app\models\Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getOrderLine()
    {
        return $this->hasOne(\app\models\OrderLine::className(), ['id' => 'order_line_id']);
    }
}
