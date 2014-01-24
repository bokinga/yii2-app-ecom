<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.01.14
 */

namespace app\components;


use opus\ecom\Component;
use opus\ecom\models\OrderableInterface;
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
    public function finalizeTransaction(OrderableInterface $order, Transaction $transaction)
    {
        $transaction->setComment('Example comment');
        $transaction->setReference('123');
    }
}