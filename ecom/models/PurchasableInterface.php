<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 23.01.14
 */

namespace opus\ecom\models;

/**
 * Interface PurchasableInterface
 *
 * @package opus\ecom\models
 */
interface PurchasableInterface
{
    /**
     * Returns the ActiveRecord class name for the object
     * @return string
     */
    public static function className();

    /**
     * Returns the primary key for the ActiveRecord item
     * @return string
     */
    public function getPrimaryKey();

    /**
     * Returns the label for the purchasable item (displayed in basket etc)
     * @return string
     */
    public function getLabel();

    public function getPrice();
}