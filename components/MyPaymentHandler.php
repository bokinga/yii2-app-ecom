<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.01.14
 */

namespace app\components;

use opus\ecom\Payment;

/**
 * This class is a customization of the PaymentHandler class, its purpose is to provide application-specific functionality
 * for the payment component (such as generating file paths, urls and loading configuration)
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package components
 */
class MyPaymentHandler extends Payment
{
    /**
     * Overridden to provide one directory for all key files
     *
     * @param string $relativePath
     * @return string
     */
    public function createFilePath($relativePath)
    {
        return \Yii::getAlias('@app/config/keys/' . $relativePath);
    }
}