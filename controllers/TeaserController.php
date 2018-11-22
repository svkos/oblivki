<?php

namespace app\controllers;

use Yii;
use app\models\Teaser;
use app\models\TeaserSettings;
use app\models\Texts;
use app\models\Images;
	use yii\web\UploadedFile;
    use app\models\MultipleUpload;
    use app\models\ProductImage;
use app\models\Headlines;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
//use app\modules\oblivki\components;
use app\models\api\Oblivki;
use yii\data\ArrayDataProvider;


/**
 * TeaserController implements the CRUD actions for Teaser model.
 */
class TeaserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Teaser models.
     * @return mixed
     */
    public function actionIndex()
    {	
		$responseInfo = Oblivki::getAllTeaserInfo();
		$responseStat = Oblivki::getAllTeaserStat();
		
		$data = $this->_custom_merge($responseInfo,$responseStat);
		
        /*$dataProvider = new ActiveDataProvider([
            'query' => Teaser::find(),
        ]);*/
		
		$provider = new ArrayDataProvider([
			'allModels' => $data,
		]);

        return $this->render('index', [
            'dataProvider' => $provider,
        ]);
    }
	
	private function _custom_merge($array1, $array2){
		$outArr = $array1;
		foreach($array2 as $arr2){
			$key = 0;
			foreach($array1 as $arr1){
				if(array_search($arr2['tid'], $arr1)){
					$outArr[$key]['totalViews'] = $arr2['totalViews'];
					$outArr[$key]['totalClicks'] = $arr2['totalClicks'];
					$outArr[$key]['totalAmount'] = $arr2['totalAmount'];
					break;
				}
				$key++;
			}
		}
		return $outArr;
	}
	
	public function actionTest()
    {
		$api = new components\Teaser();
		$response = $api->getAllTeaserStat();
		echo '<pre>';
		print_r($response);
    }
	
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Teaser();

        if ($model->load(Yii::$app->request->post())) {
			$model->createTeasers();
			return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
			'companies' => ArrayHelper::map(Oblivki::getAllCompanies(),'id','name')
        ]);
    }
	
    public function actionSettings()
    {	
        return $this->render('settings', [
        	'companies' => ArrayHelper::map(Oblivki::getAllCompanies() ,'id','name')
        ]);
    }

	public function actionStart($id)
    {
		$teaser = new components\Teaser($id);
	
		$response = $teaser->start();

		//print_r($response);die;
		if($response['message'] == "success"){
			Yii::$app->session->setFlash('success', 'Запущен');
		}else{
			Yii::$app->session->setFlash('error', $response['message']);
		}
		return $this->redirect(['index']);
	}
	
	public function actionStop($id)
    {
		$teaser = new components\Teaser($id);
	
		$response = $teaser->stop();

		//print_r($response);die;
		if($response['message'] == "success"){
			Yii::$app->session->setFlash('success', 'Остановлен');
		}else{
			Yii::$app->session->setFlash('error', $response['message']);
		}
		return $this->redirect(['index']);
	}

    public function actionDelete($id)
    {
		$model = $this->findModel($id);		
		$model->deleteTeaser($model->api_idteaser);
		$model->delete();
        return $this->redirect(['index']);
    }

	public function actionTexts()
	{
		$model = Texts::find()->all();
		
        return $this->render('addAjax', [
            'model' => $model,
			'type' => 'text'
        ]);
	}
	
	
	public function actionImages()
	{
		$modelImages = Images::find()->all();
		$modelFile = new MultipleUpload;
		
		if ($modelFile->load(Yii::$app->request->post())) {
			$modelFile->files = UploadedFile::getInstances($modelFile, 'files');
			
            if ($modelFile->files && $modelFile->validate()) {
                foreach ($modelFile->files as $file) {
					$name = str_replace(' ', '', $file->baseName);
					$path = 'uploads/'.$name.'.'.$file->extension;
					$file->saveAs($path);
					
					$model = new Images();
					$model->path = $path;
					$model->save();
				}
				$modelImages = Images::find()->all();
				Yii::$app->session->setFlash('success', "Картинка загружена");
            }
		}
		
        return $this->render('addImage', [
            'modelImages' => $modelImages,
			'modelFile' => $modelFile,
        ]);
	}
	
	public function actionAdd(){
		if (Yii::$app->request->isAjax) {
			$text = Yii::$app->request->post('text');  
			$type = Yii::$app->request->post('type'); 
			
			$model = new Texts();
			$model->text = $text;
			$model->save(); 
		}
	}
	
	public function actionGetsettings($idcompanie){
		//if (Yii::$app->request->isAjax){
			$model = TeaserSettings::findOne($idcompanie);
			if($model == null){
				$model = new TeaserSettings;
				$model->idcompanie = $idcompanie;
			}
			
			if ($model->load(Yii::$app->request->post())){
				if(!$model->validate()){
					Yii::$app->session->setFlash('error', "Неправильные параметры");
					return $this->redirect(['settings']);
				}
				$model->save();
				Yii::$app->session->setFlash('success', "Успешно");
				return $this->redirect(['settings']);
			}
			return $this->renderPartial('_settings', [
				'model' => $model,
			]);			
		//}
	}
	
    /**
     * Finds the Teaser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teaser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teaser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
