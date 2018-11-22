<?php

namespace app\modules\oblivki\controllers;

use yii\web\Controller;
use app\modules\oblivki\components;

/**
 * Default controller for the `oblivki` module
 */
class ApiController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionCreate()
    {
		$teaser = new components\Teaser();
		
		$teaser->idcompany = '204841';
		$teaser->text = 'Закажи супер средство прямо сейчас!';
		$teaser->title = 'Похудейте быстро с синим чаем';
		$teaser->url = 'http://sennokos.net/index.php?r=api/stream&key=82cbNV/sub1/sub2/sub3/';	
		$teaser->imageUrl = 'http://advertpro.biz/image/4tea.jpg';
		$teaser->pcCommonPrice = 2.2;
		$teaser->mobileCommonPrice = 2.4;
		$teaser->tabletCommonPrice = 2.3;
	
		$response = $teaser->create();
		print_r($response);
		if($response['message'] == "success"){
			echo $response['id'];
		}else{
			foreach($response['errors'] as $error){
				echo '<br>'.$error[0];
				//print_r($error);
			}
		}
        //return $this->render('index');
    }
	
	public function actionUpdate()
    {
		$teaser = new components\Teaser('2696760');
		
		$teaser->text = 'Закажи чай для похудения!';
		$teaser->pcCommonPrice = 9;
		$teaser->mobileCommonPrice = 9;
		$teaser->tabletCommonPrice = 9;
	
		$response = $teaser->update();

		print_r($response);
		if($response['message'] == "success"){
			echo $response['id'];
		}else{
			foreach($response['errors'] as $error){
				echo '<br>'.$error[0];
				//print_r($error);
			}
		}
        //return $this->render('index');
    }
	
	public function actionStop()
    {
		$teaser = new components\Teaser('2695781');
	
		$response = $teaser->stop();

		print_r($response);
		if($response['message'] == "success"){
			echo $response['id'];
		}else{
			foreach($response['errors'] as $error){
				echo '<br>'.$error[0];
				//print_r($error);
			}
		}
        //return $this->render('index');
    }
	
	public function actionInfo()
    {
		$teaser = new components\Teaser('2695781');
	
		$response = $teaser->getTeaserInfo();

		print_r($response);
		/*if($response['message'] == "success"){
			echo $response['id'];
		}else{
			foreach($response['errors'] as $error){
				echo '<br>'.$error[0];
				//print_r($error);
			}
		}*/
        //return $this->render('index');
    }
	
	public function actionStart()
    {
		$teaser = new components\Teaser('2695781');
	
		$response = $teaser->start();

		print_r($response);
		if($response['message'] == "success"){
			echo $response['id'];
		}else{
			foreach($response['errors'] as $error){
				echo '<br>'.$error[0];
				//print_r($error);
			}
		}
        //return $this->render('index');
    }
	
	public function actionDelete()
    {
		$teaser = new components\Teaser('2696737');
	
		$response = $teaser->delete();

		print_r($response);
		if($response['message'] == "success"){
			echo $response['id'];
		}else{
			foreach($response['errors'] as $error){
				echo '<br>'.$error[0];
				//print_r($error);
			}
		}
        //return $this->render('index');
    }
	
	public function actionG()
    {
		$teaser = new components\Teaser();
	
		$response = $teaser->getAllCompanies();

		print_r($response);
		/*if($response['message'] == "success"){
			echo $response['id'];
		}else{
			foreach($response['errors'] as $error){
				echo '<br>'.$error[0];
				//print_r($error);
			}
		}*/
        //return $this->render('index');
    }
	
}
