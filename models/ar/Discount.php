<?php

namespace app\models\ar;

use opus\ecom\models\PurchasableInterface;

/**
 * This is the model class for table "eco_discount".
 *
 */
class Discount extends base\Discount implements PurchasableInterface
{
    /**
     * Returns the label for the purchasable item (displayed in basket etc)
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        $price = 0;
        if ($this->type === 'COUPON') {
            $price = -$this->amount;
        }
        return $price;
    }
}
