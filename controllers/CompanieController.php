<?php

namespace app\controllers;

use Yii;
use app\models\Companie;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\api\Oblivki;
use app\models\api\CompanieApi;
use yii\data\ArrayDataProvider;

/**
 * CompanieController implements the CRUD actions for Companie model.
 */
class CompanieController extends Controller
{

    /**
     * Lists all Companie models.
     * @return mixed
     */
    public function actionLoadFromApi()
    {
		$api = Oblivki::getAllCompanies();
		
		foreach($api as $item){
			if( !Companie::find()->where(['id_api' => $item['id']])->exists() ){
				$model = new Companie;
				$model->id_api = $item['id'];
				$model->name = $item['name'];
				$model->save();
			}
		}
		
		return $this->redirect(['companie/edit']);
    }
	
	public function actionAjaxSetOffer($id_api, $id_offer)
    {
		$model = Companie::find()->where(['id_api'=>$id_api])->one();
		$model->id_offer = $id_offer;
		if($model->save())
			return '<div style="color:green">Сохранено</div>';
		else
			return '<div style="color:red">Неудачно</div>';
    }
	
	public function actionIndex($id)
    {
		$dataProvider = new ActiveDataProvider([
            'query' => Companie::find()->where(['id_offer'=>$id]),
        ]);
		//$model = Companie::find()->where(['id_offer'=>$id])->all();
		
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

	public function actionEdit()
    {
		$dataProvider = new ActiveDataProvider([
            'query' => Companie::find(),
        ]);
			
		return $this->render('edit', [
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionDelete($id)
    {
		$model = Companie::findOne($id);		
		$api = new CompanieApi($model->id_api);
		
		$api->delete();
		$model->delete();
        return $this->redirect(['companie/edit']);
    }
    
}
