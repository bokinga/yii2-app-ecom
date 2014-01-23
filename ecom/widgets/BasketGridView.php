<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 23.01.14
 */

namespace opus\ecom\widgets;

use opus\ecom\Basket;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use Yii;

/**
 * Class BasketGridView
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package opus\ecom\widgets
 */
class BasketGridView extends GridView
{
    /**
     * @var Basket
     */
    public $basket;

    /**
     * @inheritdoc
     */
    public $formatter = ['class' => '\opus\ecom\Formatter'];

    public function init()
    {
        if (!isset($this->dataProvider)) {
            $this->dataProvider = new ArrayDataProvider([
                'key' => 'uniqueId',
                'allModels' => $this->basket->getItems(),
                'pagination' => false,
            ]);
        }
        parent::init();
    }
}