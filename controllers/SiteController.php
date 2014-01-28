<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * Class SiteController
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package app\controllers
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
