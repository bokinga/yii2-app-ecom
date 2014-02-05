<?php

namespace app\models\ar;

use opus\ecom\models\BasketDiscountInterface;
use opus\ecom\Basket;


/**
 * This is the model class for table "eco_discount".
 *
 */
class Discount extends base\Discount implements BasketDiscountInterface
{
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @inheritdoc
     */
    public function applyToBasket(Basket $basket, &$basketTotalSum)
    {
        if ($this->type === 'COUPON') {
            $basketTotalSum -= $this->amount;
        }
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
