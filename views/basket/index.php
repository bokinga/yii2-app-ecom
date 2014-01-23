<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 23.01.14
 * @var \yii\web\View $this
 * @var \opus\ecom\Basket $basket
 */
echo \opus\ecom\widgets\BasketGridView::widget([
    'basket' => $basket,
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