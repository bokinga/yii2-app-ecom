<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 23.01.14
 */

namespace opus\ecom;

use app\models\Product;

/**
 * Class EcomComponent
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package ecom
 */
class Component extends \yii\base\Component
{
    /**
     * @var array
     */
    public $purchasableTypes;
    /**
     * @var string|\opus\ecom\Basket
     */
    public $basket = '\opus\ecom\Basket';

    /**
     * @var string|\opus\ecom\Formatter
     */
    public $formatter = '\opus\ecom\Formatter';

    public function init()
    {
        $this->basket = \Yii::createObject($this->basket, [
            'session' => \Yii::$app->session,
            'component' => $this,
        ]);
        $this->formatter = \Yii::createObject($this->formatter);

//        $this->test();
    }

    private function test()
    {
//        $prices = [100, 200, 500, 1000, 5000, 10000, 12345, 99999999];
//        foreach ($prices as $price) {
//            $p = new Product();
//            $p->price = $price;
//            $p->save();
//        }


        $product = Product::find()->one();
        $this->basket->add($product, ['quantity' => 2]);
    }
}