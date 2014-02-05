<?php

namespace app\models\ar;

use opus\ecom\models\BasketProductInterface;

/**
 * This is the model class for table "eco_product". Support for VAT and quantities has been implemented in addition to
 * the compulsory methods
 *
 */
class Product extends base\Product implements BasketProductInterface
{
    /**
     * @var int No fancy getter/setter needed, just use a property for that
     */
    public $basketQuantity = 1;

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->name;
    }

    /**
     * Only used to display a number if product list. Not required by ecom component
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the absolute VAT. Used in shopping basket view and accessed via 'vatSum' column
     * @return float
     */
    public function getVatSum()
    {
        return $this->vat * $this->getPrice();
    }

    /**
     * @inheritdoc
     */
    public function getTotalPrice()
    {
        return $this->getPrice() * $this->basketQuantity;
    }

    /**
     * Returns the VAT for a quantity of products. Used in checkout view
     * @return float
     */
    public function getTotalVat()
    {
        return $this->getVatSum() * $this->basketQuantity;
    }

    /**
     * @inheritdoc
     */
    public function serialize()
    {
        return serialize($this->attributes);
    }

    /**
     * @inheritdoc
     */
    public function unserialize($serialized)
    {
        $this->setAttributes(unserialize($serialized), false);
    }
}
