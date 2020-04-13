<?php
namespace app\helpers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

trait AuthGuardTrait
{
    public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
                    'delete' => ['post'],
                    'pegawai'=> ['post']
				],
			],
		];
	}
}