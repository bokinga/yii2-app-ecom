<?php
/**
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.01.14
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 */
?>

<h1>Payment log</h1>
<?php
echo \opus\ecom\widgets\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id:text:#',
        'user_id:text:User',
        'bank_code',
        'status',
        'amount:price',
        'created:datetime',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template' => '{view}',
            'buttons' => [
                'view' => function($url, $model) {
                        return \yii\helpers\Html::a('Details', \Yii::$app->urlManager->createUrl('payment/view', ['paymentId' => $model->id]));
                    }
            ]
        ]
    ]
]);