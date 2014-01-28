<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 27.01.14
 */

namespace app\controllers;


use app\models\ar\Order;
use app\models\ar\Payment;
use opus\ecom\Component;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Class PaymentController
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package app\controllers
 */
class PaymentController extends Controller
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
        $order = Order::find($orderId);

        return $this->render('pay', [
            'order' => $order,
        ]);
    }

    public function actionBankReturn()
    {
        /** @var $ecom Component */
        $ecom = \Yii::$app->ecom;

        /** @var $model Order */
        $model = $ecom->payment->handleResponse($_REQUEST, Order::className());

        $this->redirect(['order/view', 'orderId' => $model->id]);
    }

    /**
     * @return string
     */
    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Payment::find(),
        ]);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $paymentId
     * @return string
     */
    public function actionView($paymentId)
    {
        $payment = Payment::find($paymentId);
        return $this->render('view', [
            'payment' => $payment,
        ]);
    }
} 