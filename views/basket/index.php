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

echo \opus\ecom\widgets\BasketGridView::widget([
    'basket' => $basket,
    'showFooter' => true,
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
?>

<div class="col-lg-3">
    <h3>Total due: <?= $basket->getTotalDue()?> </h3>
    <?php
    $form = \yii\widgets\ActiveForm::begin();
    echo $form->field($model, 'userId')->dropDownList($users);
    echo Html::submitButton('Post order', ['class' => 'btn btn-lg btn-success']);
    $form->end();
    ?>
</div>