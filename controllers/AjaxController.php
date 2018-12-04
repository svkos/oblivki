<?php

namespace app\controllers;

use Yii;
use app\models\Companie;
use app\models\Texts;
use app\models\Images;
use yii\web\UploadedFile;
use app\models\MultipleUpload;
use app\models\ProductImage;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

/**
 * CompanieController implements the CRUD actions for Companie model.
 */
class AjaxController extends Controller
{
	/*public function beforeAction($action)
	{
		if(!Yii::$app->request->isAjax)
			exit;
		return parent::beforeAction($action);
	}
    /**
     * Lists all Companie models.
     * @return mixed
     */
    public function actionGetCompanieByOffer($id)
    {				
        $posts = Companie::find()
				->where(['id_offer' => $id])
				->all();
				
		if (!empty($posts)) {
			foreach($posts as $post) {
				echo "<option value='".$post->id_api."'>".$post->name."</option>";
			}
		} else {
			echo "<option>-</option>";
		}
    }
	
	public function actionGetTextsByOffer($id)
    {			
        $models = Texts::find()
				->where(['id_offer' => $id])
				->orderBy('id_text DESC')
				->all();
		
		if($models){
			return $this->renderPartial('//teaser/_addText',[
				'models' => $models,
				'id_offer' => $id,
			]);
		}
    }
	
	public function actionGetImagesByOffer($id)
    {
		$modelImages = Images::find()
					 ->where(['id_offer' => $id])
					 ->all();
					 
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
					$model->id_offer = $id;
					$model->save();
				}
				Yii::$app->session->setFlash('success', "Картинка загружена");
				return $this->redirect(['/offer/companie/teaser/images']);
            }
			Yii::$app->session->setFlash('error', $modelFile->errors['files'][0]);
			return $this->redirect(['/offer/companie/teaser/images']);
		}
		
		return $this->renderPartial('//teaser/_addImage', [
			'modelImages' => $modelImages,
			'modelFile' => $modelFile,
			'id_offer' => $id,
		]);
			
	}	
	
	public function actionAddText()
    {				
		$text = Yii::$app->request->post('text');  
		$id_offer = Yii::$app->request->post('id_offer'); 
		
		$model = new Texts();
		$model->text = $text;
		$model->id_offer = $id_offer;
		$model->save(); 
    }

}
