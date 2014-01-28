<?php

namespace app\models\ar;

use opus\ecom\models\PurchasableInterface;

/**
 * This is the model class for table "eco_product".
 *
 */
class Product extends base\Product implements PurchasableInterface
{

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getPrice()
    {
        return $this->price;
    }
}
