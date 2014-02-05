<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.01.14
 */

namespace app\components;

use app\models\ar\Discount;
use opus\ecom\Basket;
use opus\ecom\Component;
use opus\ecom\models\OrderInterface;
use opus\payment\services\payment\Transaction;

/**
 * Class MyEcomComponent
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package app\components
 */
class MyEcomComponent extends Component
{
    /**
     * @inheritdoc
     */
    public function finalizeTransaction(OrderInterface $order, Transaction $transaction)
    {
        $transaction->setComment('Example comment');
        $transaction->setReference('123');
    }

    /**
     * Overridden to support "percentage" type discounts that have to be calculated after the total price. This could
     * be done in Discount model's 'applyToBasket' method as well, but we want it to be applied AFTER any other discounts
     * so it's here
     *
     * @param int $price
     * @param Basket $basket
     * @return int
     */
    public function finalizeBasketPrice($price, Basket $basket)
    {
        foreach ($basket->getItems(Basket::ITEM_DISCOUNT) as $model) {
            /** @var $model Discount */
            if ($model instanceof Discount) {
                if ($model->type === 'PERCENT') {
                    $price *= (100 - $model->amount) / 100;
                }
            }
        }
        return ceil($price);
    }
}