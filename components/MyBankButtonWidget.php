<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.01.14
 */

namespace app\components;


use opus\payment\widgets\PaymentWidget;
use yii\helpers\Html;

/**
 * This is a custom class that overrides the default opus\payment\widgets\PaymentWidget (which generates one form
 * per bank, hidden inputs and a submit button) to replace submit buttons with images
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package app\components
 */
class MyBankButtonWidget extends PaymentWidget
{
    /**
     * @inheritdoc
     */
    protected function generateSubmit()
    {
        $image = \Yii::$app->urlManager->baseUrl . '/img/banks/' . strtolower($this->form->getProviderTag()) . '.jpg';
        return Html::input('image', $this->form->getProviderName(), null, ['src' => $image]);
    }
}