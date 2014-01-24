<?php

namespace app\models\ar;

use opus\ecom\Basket;
use opus\ecom\models\OrderableInterface;
use opus\payment\services\payment\Response;

/**
 * This is the model class for table "eco_order".
 *
 */
class Order extends base\Order implements OrderableInterface
{

    /**
     * This method should load the contents of the basket and save the order with all its item in the database
     *
     * @param Basket $basket
     * @throws \Exception
     * @return boolean
     */
    public function saveFromBasket(Basket $basket)
    {
        $transaction = $this->getDb()->beginTransaction();
        try
        {
            $this->due_amount = $basket->getTotalDue(false);
            if (!$this->save()) {
                throw new \RuntimeException('Could not save order model');
            }

            foreach ($basket->getItems() as $item)
            {
                $model = new OrderLine([
                    'order_id' => $this->id,
                    'product_id' => $item->pkValue,
                    'quantity' => $item->quantity,
                    'due_amount' => $item->price,
                ]);
                if (!$model->save()) {
                    throw new \RuntimeException('Could not save order line model');
                }
            }
            $transaction->commit();
        }
        catch (\Exception $exception)
        {
            $transaction->rollback();
            throw $exception;
        }
    }

    /**
     * Returns the total money due for this order. Should return a value of type double
     *
     * @return double
     */
    public function getTransactionSum()
    {
        return $this->due_amount / 100;
    }

    /**
     * @param Response $response
     * @return OrderableInterface
     */
    public function bankReturn(Response $response)
    {
        $this->status = $response->isSuccessful() ? 'paid' : 'error';
        $this->save();

        return $this;
    }
}
