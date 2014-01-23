<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 23.01.14
 */

namespace opus\ecom\basket;


use opus\ecom\Basket;
use opus\ecom\models\PurchasableInterface;
use yii\base\Model;

/**
 * Class Item
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package opus\ecom\basket
 */
class Item extends Model implements \Serializable
{
    const OP_SERIALIZE = 'serialize';
    const OP_USER_INPUT = 'user-input';
    /**
     * @var Basket
     */
    public $basket;
    /**
     * @var string
     */
    public $uniqueId;
    /**
     * @var string
     */
    public $modelClass;
    /**
     * @var string
     */
    public $pkValue;

    /**
     * @var integer
     */
    public $price;

    /**
     * @var string
     */
    public $label;

    /**
     * @var double
     */
    public $quantity = 1;

    /**
     * @param PurchasableInterface $element
     * @param array $options
     */
    public function __construct(PurchasableInterface $element, array $options)
    {
        $options += [
            'uniqueId' => md5(uniqid('_bs', true)),
            'modelClass' => $element->className(),
            'pkValue' => $element->getPrimaryKey(),
            'price' => $element->getPrice(),
            'label' => $element->getLabel(),
        ];
        parent::__construct($options);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::OP_SERIALIZE => ['quantity', 'label', 'price', 'pkValue', 'modelClass', 'uniqueId'],
            self::OP_USER_INPUT => ['quantity'],
        ];
    }

    /**
     * @return double
     */
    public function getTotalPrice()
    {
        return $this->price * $this->quantity;
    }

    /**
     * @inheritdoc
     */
    public function serialize()
    {
        $this->scenario = self::OP_SERIALIZE;
        return serialize($this->getAttributes($this->activeAttributes()));
    }

    /**
     * @inheritdoc
     */
    public function unserialize($serialized)
    {
        $this->scenario = self::OP_SERIALIZE;
        $this->setAttributes(unserialize($serialized), false);
    }
}