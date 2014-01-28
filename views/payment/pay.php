<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.01.14
 * @var \yii\web\View $this
 * @var \opus\ecom\models\OrderableInterface $order
 */
?>


<h1>Select your method of payment</h1>
<h3>Total due: <?=$order->getTransactionSum()?> </h3>

<?php
// renders \opus\ecom\widgets\PaymentButtons
\Yii::$app->ecom->payment->createWidget($order, [])->run();
?>
