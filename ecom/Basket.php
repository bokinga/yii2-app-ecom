<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 23.01.14
 */

namespace opus\ecom;

use opus\ecom\basket\DataProvider;
use opus\ecom\basket\Item;
use opus\ecom\models\PurchasableInterface;
use yii\base\InvalidParamException;
use yii\base\Object;
use yii\web\Session;

/**
 * Class Basket
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package opus\ecom
 *
 * @property int $count
 */
class Basket extends Object
{
    /**
     * @var Component
     */
    public $component;
    /**
     * @var Session
     */
    public $session;
    /**
     * @var string|\opus\ecom\basket\StorageInterface
     */
    public $storage = 'opus\ecom\basket\storage\Session';

    /**
     * @var string Internal class name for holding basket elements
     */
    public $itemClass = 'opus\ecom\basket\Item';
    /**
     * @var array
     */
    protected $items = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->storage = \Yii::createObject($this->storage);
        $this->setItems($this->storage->load($this));
    }

    /**
     * @param PurchasableInterface $element
     * @param array $options
     * @param bool $save
     */
    public function add(PurchasableInterface $element, array $options = [], $save = true)
    {
        $className = $this->itemClass;

        /** @var $className Item */
        $item = new $className($element, $options + ['basket' => $this]);
        $this->addItem($item);

        $save && $this->storage->save($this);
    }

    /**
     * @param bool $save
     */
    public function clear($save = true)
    {
        $this->items = [];
        $save && $this->storage->save($this);
    }

    /**
     * @param string $uniqueId
     * @param bool $save
     * @throws \yii\base\InvalidParamException
     * @return $this
     */
    public function remove($uniqueId, $save = true)
    {
        if (!isset($this->items[$uniqueId])) {
            throw new InvalidParamException('Item not found');
        }
        unset($this->items[$uniqueId]);
        $save && $this->storage->save($this);
        return $this;
    }

    /**
     * @param Item[] $items
     */
    protected function setItems(array $items)
    {
        $this->clear(false);
        foreach ($items as $item) {
            $item->basket = $this;
            $this->addItem($item);
        }
    }

    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Item $item
     */
    protected function addItem(Item $item)
    {
        $this->items[$item->uniqueId] = $item;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return count($this->items);
    }
} 