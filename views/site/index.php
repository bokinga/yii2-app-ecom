<?php
/**
 * @var yii\web\View $this
 */
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div>
                <h2>Users</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
            </div>
            <div>
                <h2>Products</h2>

                <?php
                echo \yii\grid\GridView::widget([
                    'dataProvider' => new \yii\data\ActiveDataProvider([
                        'query' => \app\models\Product::find(),
                        'pagination' => false,
                    ]),
                    'columns' => [
                        'id',
                        'price',
                        [
                            'class' => \yii\grid\ActionColumn::className(),
                            'buttons' => [
                                'addToBasket' => function($url) {
                                    return \yii\helpers\Html::a('Add to basket', $url);
                                }
                            ],
                            'template' => '{addToBasket}',
                            'controller' => 'basket',
                        ]
                    ]
                ])
                ?>
            </div>
        </div>
    </div>
</div>
