<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.01.14
 */

namespace app\controllers;


use app\models\ar\Order;
use opus\ecom\Component;
use yii\web\Controller;

/**
 * Controller for order-related actions
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package app\controllers
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;

    /**
     * @param $orderId
     * @return string
     */
    public function actionPay($orderId)
    {
        /** @var $ecom Component */
        $ecom = \Yii::$app->ecom;

        $order = Order::find($orderId);

        $buttonsWidget = $ecom->payment->createWidget($order, [
            'buttonWidgetClass' => '\app\components\MyBankButtonWidget'
        ]);

        return $this->render('pay', [
            'widget' => $buttonsWidget,
            'order' => $order,
        ]);
    }

    public function actionBankReturn()
    {
        /** @var $ecom Component */
        $ecom = \Yii::$app->ecom;

        $model = $ecom->payment->handleResponse($_REQUEST, Order::className());

        $this->redirect(['order/view', 'orderId' => $model->id]);
    }

    /**
     * @param $orderId
     */
    public function actionView($orderId)
    {
        var_dump('view order ' . $orderId);
    }
} 