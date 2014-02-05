<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 23.01.14
 * @var \yii\web\View $this
 * @var \opus\ecom\Basket $basket
 * @var \app\models\ar\User[] $users
 */
use yii\helpers\Html;
use opus\ecom\Basket;

?>

<h1>Your shopping basket</h1>
<div class="row">
    <div class="col-lg-8 ">

        <?php
        // render products table
        echo \opus\ecom\widgets\BasketGridView::widget([
            'basket' => $basket,
            'columns' => [
                ['class' => \yii\grid\SerialColumn::className()],

                // all the attributes are accessed directly from the Product AR model (via properties or magic getters)
                'label',
                'price:price',
                'vat:percent',
                'basketQuantity',
                'totalPrice:price',
                [
                    'class' => \yii\grid\ActionColumn::className(),
                    'template' => '{delete}'
                ]
            ]
        ]);

        // render discounts table
        echo \opus\ecom\widgets\BasketGridView::widget([
            'basket' => $basket,
            'itemType' => Basket::ITEM_DISCOUNT, // ask for discounts
            'layout' => '{items}',
            'columns' => ['label:text:Discounts']
        ]);
        echo Html::a('Empty basket', ['basket/clear'], ['class' => 'btn btn-danger']);
        ?>
    </div>
</div>
<div class="col-lg-4 row">

    <?php
    // calls getTotalPrice from every product model
    $totalPrice = $basket->getAttributeTotal('totalPrice', Basket::ITEM_PRODUCT);

    // calls getTotalVat from every product model
    $vat = $basket->getAttributeTotal('totalVat', Basket::ITEM_PRODUCT);

    // subtract to find out the price without vat
    $priceWithoutVat = $totalPrice - $vat;

    ?>

    <h4>
        Total: <?= \Yii::$app->ecom->formatter->asPrice($priceWithoutVat) ?>
        + <?= \Yii::$app->ecom->formatter->asPrice($vat) ?> (VAT)
        = <?= \Yii::$app->ecom->formatter->asPrice($totalPrice) ?>
    </h4>

    <h4>Discounts: <?= $basket->getTotalDiscounts() ?> </h4>
    <h3>Total due: <?= $basket->getTotalDue(); ?> </h3>


    <?php
        $form = \yii\widgets\ActiveForm::begin();
        echo $form->field($model, 'userId')->dropDownList($users);
        echo Html::submitButton('Post order', ['class' => 'btn btn-lg btn-success']);
        $form->end();
    ?>
</div>