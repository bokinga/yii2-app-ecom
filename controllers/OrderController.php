<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.01.14
 */

namespace app\controllers;


use app\models\ar\Invoice;
use app\models\ar\Order;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
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
     * @param $orderId
     * @return string
     */
    public function actionView($orderId)
    {
        $order = Order::find($orderId);

        return $this->render('view', [
            'order' => $order
        ]);
    }

    /**
     * @return string
     */
    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
        ]);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $orderId
     */
    public function actionNewInvoice($orderId)
    {
        $order = Order::find($orderId);

        $invoice = new Invoice([
            'order_id' => $order->id,
            'due_amount' => $order->due_amount,
            'due_datetime' => (new \DateTime('+10 days'))->format('Y-m-d H:i:s'),
            'created' => new Expression('NOW()')
        ]);
        $invoice->save();
        $this->redirect(['order/view', 'orderId' => $orderId]);
    }
} 