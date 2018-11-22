<?php

namespace app\controllers;

use Yii;
use app\models\Offer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CompanieController implements the CRUD actions for Companie model.
 */
class OfferController extends Controller
{

    /**
     * Lists all Companie models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = Offer::find()->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
