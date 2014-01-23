<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 23.01.14
 */

namespace app\controllers;


use opus\ecom\Basket;
use yii\web\Controller;

/**
 * Class BasketController
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package app\controllers
 */
class BasketController  extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        /** @var $basket Basket */
        $basket = \Yii::$app->ecom->basket;

        $params = [
            'basket' => $basket,
        ];
        return $this->render('index', $params);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        /** @var $basket Basket */
        $basket = \Yii::$app->ecom->basket;
        $basket->remove($id);
        $this->redirect('basket');
    }

    public function actionAddToBasket($id)
    {


    }
} 