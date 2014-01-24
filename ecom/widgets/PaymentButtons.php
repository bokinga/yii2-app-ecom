<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.01.14
 */

namespace opus\ecom\widgets;

use opus\ecom\models\OrderableInterface;
use opus\ecom\SubComponentTrait;
use opus\payment\services\payment\Transaction;
use opus\payment\services\Payment;
use opus\payment\widgets\PaymentWidget;
use yii\base\Widget;

/**
 * Class PaymentWidget
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package opus\ecom\widgets
 *
 * @property OrderableInterface order
 * @property Payment service
 */
class PaymentButtons extends Widget
{
    use SubComponentTrait;

    /**
     * @var string Override this to customize your payment forms
     */
    public $buttonWidgetClass = '\opus\payment\widgets\PaymentWidget';
    /**
     * @var OrderableInterface
     */
    private $_order;
    /**
     * @var Payment
     */
    private $_service;
    /**
     * @var Transaction
     */
    private $_transaction;


    public function run()
    {
        parent::run();

        foreach ($this->_service->generateForms($this->_transaction) as $form) {
            /** @var $class PaymentWidget */
            $class = $this->buttonWidgetClass;
            echo $class::widget(['form' => $form, 'debug' => false]);
        }
    }

    /**
     * @param \opus\ecom\models\OrderableInterface $order
     * @return PaymentButtons
     */
    public function setOrder(OrderableInterface $order)
    {
        $this->_order = $order;
        return $this;
    }

    /**
     * @param \opus\payment\services\Payment $service
     * @return PaymentButtons
     */
    public function setService(Payment $service)
    {
        $this->_service = $service;
        return $this;
    }

    /**
     * @param \opus\payment\services\payment\Transaction $transaction
     * @return PaymentButtons
     */
    public function setTransaction(Transaction $transaction)
    {
        $this->_transaction = $transaction;
        return $this;
    }
}