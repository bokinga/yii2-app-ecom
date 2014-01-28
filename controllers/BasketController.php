<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 23.01.14
 */

namespace app\controllers;


use app\models\ar\Discount;
use app\models\ar\Order;
use app\models\ar\Product;
use app\models\ar\User;
use app\models\BasketModel;
use opus\ecom\Basket;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;

/**
 * Controller for basket actions
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package app\controllers
 */
class BasketController  extends Controller
{
    /**
     * @var Basket
     */
    protected $basket;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->basket =  \Yii::$app->ecom->basket;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new BasketModel;

        if ($_POST && $model->load($_POST))
        {
            // create order
            $order = new Order([
                'user_id' => $model->userId,
                'status' => 'new',
                'created' => new Expression('NOW()'),
            ]);

            $this->basket->createOrder($order);
            $this->redirect(['payment/pay', 'orderId' => $order->id]);
        }


        $params = [
            'basket' => $this->basket,
            'users' => ArrayHelper::map(User::find()->all(), 'id', 'name'),
            'model' => $model,
        ];
        return $this->render('index', $params);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $this->basket->remove($id);
        $this->redirect('basket/index');
    }

    /**
     * @param $id
     */
    public function actionAddProduct($id)
    {
        $product = Product::find($id);
        $this->basket->add($product);
        $this->redirect('site/index');
    }

    /**
     * @param $id
     */
    public function actionAddDiscount($id)
    {
        $discount = Discount::find($id);
        $this->basket->add($discount);
        $this->redirect('basket/index');
    }

    public function actionClear()
    {
        $this->basket->clear(true);
        $this->redirect('basket/index');
    }
} 