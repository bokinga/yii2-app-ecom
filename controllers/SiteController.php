<?php

namespace app\controllers;

use Yii;
use yii\web\AccessControl;
use yii\web\Controller;
use yii\web\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

/**
 * Class SiteController
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package app\controllers
 */
class SiteController extends Controller
{


	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],

		];
	}

	public function actionIndex()
	{
		return $this->render('index');
	}



}
