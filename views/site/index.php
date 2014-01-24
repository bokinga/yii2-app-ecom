<?php
/**
 * @var yii\web\View $this
 */
use opus\ecom\widgets\GridView;

?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <h2>Users</h2>

                <?php
                echo GridView::widget([
                        'dataProvider' => new \yii\data\ActiveDataProvider([
                            'query' => \app\models\ar\User::find(),
                            'pagination' => false,
                        ]),
                        'columns' => [
                            'id',
                            'name',
                        ]
                    ]);
                ?>
            </div>
            <div class="col-lg-3">
                <h2>Products</h2>

                <?php
                echo GridView::widget([
                    'dataProvider' => new \yii\data\ActiveDataProvider([
                        'query' => \app\models\ar\Product::find(),
                        'pagination' => false,
                    ]),
                    'columns' => [
                        'id',
                        'price:price',
                        [
                            'class' => \yii\grid\ActionColumn::className(),
                            'buttons' => [
                                'add-product' => function($url) {
                                    return \yii\helpers\Html::a('Add to basket', $url);
                                }
                            ],
                            'template' => '{add-product}',
                            'controller' => 'basket',
                        ]
                    ]
                ])
                ?>
            </div>
        </div>
    </div>
</div>
