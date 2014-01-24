<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.01.14
 */

namespace opus\ecom;

use app\models\ar\Order;
use opus\ecom\models\OrderableInterface;
use opus\ecom\widgets\PaymentButtons;
use opus\payment\PaymentHandlerBase;
use opus\payment\services\payment\Response;
use opus\payment\services\payment\Transaction;
use yii\db\ActiveRecord;

/**
 * Class Payment
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package opus\ecom
 *
 * @property \opus\payment\services\Payment $service
 */
abstract class Payment extends PaymentHandlerBase
{
    use SubComponentTrait;

    /**
     * @var array
     */
    public $params;

    /**
     * @var string
     */
    public $widgetClass = 'opus\ecom\widgets\PaymentButtons';

    /**
     * @var \opus\payment\services\Payment
     */
    private $_service;

    /**
     * Returns the configuration array
     */
    public function getConfiguration($key = null)
    {
        return $this->params;
    }

    /**
     * This is a convenience method for generating a payment widget that generates all payment forms (using self::$widgetClass)
     *
     * @param OrderableInterface $order
     * @param array $widgetOptions
     * @return PaymentButtons
     */
    public function createWidget(OrderableInterface $order, $widgetOptions = [])
    {
        $transaction = $this->createTransaction($order);

        /** @var $widget PaymentButtons */
        $widget = \Yii::createObject($this->widgetClass,
            [
                'transaction' => $transaction,
                'service' => $this->service
            ] + $widgetOptions);
        return $widget;
    }

    /**
     * Creates a new transaction based on an order. Also calls opus\ecom\Component::finalizeTransaction
     *
     * @param OrderableInterface $order
     * @return Transaction
     */
    public function createTransaction(OrderableInterface $order)
    {
        $transaction = $this
            ->createService(self::SERVICE_PAYMENT)
            ->createTransaction($order->getPrimaryKey(), $order->getTransactionSum());

        $this->component->finalizeTransaction($order, $transaction);
        return $transaction;
    }

    /**
     * @param array $request
     * @param $arClassName
     * @return OrderableInterface|ActiveRecord
     * @throws \InvalidArgumentException
     */
    public function handleResponse(array $request, $arClassName)
    {
        /** @var $response Response */
        $response = $this->service->handleResponse($request); // throws exceptions on error
        $transaction = $response->getTransaction();

        if ($elementId = $transaction->getTransactionId(null))
        {
            $orderModel = $arClassName::find($elementId);
            if ($orderModel instanceof OrderableInterface)
            {
                return $orderModel->bankReturn($response);
            }
        }
        throw new \InvalidArgumentException('Invalid data, order not found');
    }

    /**
     * @return \opus\payment\services\Payment
     */
    protected function getService()
    {
        if (!isset($this->_service)) {
            $this->_service = $this->createService(self::SERVICE_PAYMENT);
        }
        return $this->_service;
    }
}