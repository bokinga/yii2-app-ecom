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

?>

<h1>Your shopping basket</h1>
<div class="row">
    <div class="col-lg-8 ">

        <?php
        echo \opus\ecom\widgets\BasketGridView::widget([
            'basket' => $basket,
            'itemClass' => \app\models\ar\Product::className(),
            'columns' => [
                ['class' => \yii\grid\SerialColumn::className()],
                'label',
                'price:price',
                'quantity',
                'totalPrice:price',
                [
                    'class' => \yii\grid\ActionColumn::className(),
                    'template' => '{delete}'
                ]
            ]
        ]);

        echo \opus\ecom\widgets\BasketGridView::widget([
            'basket' => $basket,
            'itemClass' => \app\models\ar\Discount::className(),
            'layout' => '{items}',
            'columns' => ['label:text:Discounts']
        ]);
        echo Html::a('Empty basket', ['basket/clear'], ['class' => 'btn btn-danger']);
        ?>
    </div>
</div>
<div class="col-lg-3 row">
    <h3>Total due: <?= $basket->getTotalDue() ?> </h3>
    <?php
    $form = \yii\widgets\ActiveForm::begin();
    echo $form->field($model, 'userId')->dropDownList($users);
    echo Html::submitButton('Post order', ['class' => 'btn btn-lg btn-success']);
    $form->end();
    ?>
</div>