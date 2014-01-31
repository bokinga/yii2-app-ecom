<?php

namespace app\models\ar\base;

/**
 * This is the base model class for table "eco_product".
 *
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property string $vat
 *
 * @property \app\models\ar\InvoiceLine[] $invoiceLines
 * @property \app\models\ar\OrderLine[] $orderLines
 * @method static \yii\db\ActiveQuery|\app\models\ar\Product|null find($q=null)
 */
abstract class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eco_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['price'], 'required'],
			[['price'], 'integer'],
			[['vat'], 'number'],
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
            'price' => 'Price',
            'vat' => 'Vat',
        ];
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getInvoiceLines()
    {
        return $this->hasMany(\app\models\ar\InvoiceLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getOrderLines()
    {
        return $this->hasMany(\app\models\ar\OrderLine::className(), ['product_id' => 'id']);
    }
}
