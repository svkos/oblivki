<?php

namespace app\modules\oblivki\components;

use yii\helpers\ArrayHelper;

class Teaser
{
	const URL_API = 'https://api.oblivki.biz/1.0/';
	const URL_TEASER = 'https://api.oblivki.biz/1.0/teaser/';
	const URL_STAT = 'https://api.oblivki.biz/1.0/stat/';
	const URL_COMPANIE = 'https://api.oblivki.biz/1.0/campaigns';
	const TOKEN = 'XBaehCEd_FvaFIswhjUK0KYWeatV4QwHQqTy02IYw2Pvvc8-F_a8m_Z5vg4KP8';

	private $_idteaser;
	
	public $idcompany;
	public $text;
	public $title;
	public $imageUrl;
	public $pcCommonPrice;
	public $mobileCommonPrice;
	public $tabletCommonPrice;
	
    public function __construct($id = null){
		$this->_idteaser = $id;
	}
	
	private static function _send($url, $data, $headers = []) {
		//echo $url;die;
		$curl = curl_init($url);
		if($data != null && $headers != null){
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);			
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	
	private function _encodeImage($url){
		return base64_encode(file_get_contents($url));
	}
	
	public function create(){
		
		$json = self::_send(self::URL_TEASER. __FUNCTION__, [
				'campaignId' => $this->idcompany, 
				'title' => $this->title,
				'text' => $this->text,
				'uploaded' => $this->_encodeImage($this->imageUrl),
				'pcCommonPrice' => $this->pcCommonPrice,
				'mobileCommonPrice' => $this->mobileCommonPrice,
				'tabletCommonPrice' => $this->tabletCommonPrice,
			], 
			['Authorization: access-token ' . self::TOKEN]
		);

		return json_decode($json, true);
	}
	
	public function update(){
		
		$json = self::_send(self::URL_TEASER. __FUNCTION__, [
				'id' => $this->_idteaser,
				'title' => $this->title,
				'text' => $this->text,
				'pcCommonPrice' => $this->pcCommonPrice,
				'mobileCommonPrice' => $this->mobileCommonPrice,
				'tabletCommonPrice' => $this->tabletCommonPrice
			],
			['Authorization: access-token ' . self::TOKEN]
		);

		return json_decode($json, true);
	}
	
	public function getTeaserInfo(){
		$json = self::_send(self::URL_TEASER.$this->_idteaser.'?access-token='.self::TOKEN, null, null);
		return json_decode($json, true);
	}
	
	public static function getAllTeaserInfo(){
		$json = self::_send('https://api.oblivki.biz/1.0/teasers?access-token='.self::TOKEN, null, null);//work
		return json_decode($json, true);
	}
	
	public static function getTeaserStat($id){
		$json = self::_send(self::URL_STAT.'advert-teaser'.'?access-token='.self::TOKEN.'&teaserId='.$id, null, null);
		return json_decode($json, true);
	}
	
	public static function getAllTeaserStat(){
		$json = self::_send(self::URL_STAT.'advert-teaser'.'?access-token='.self::TOKEN.'&group=teaserId&dateFrom=2018-11-01', null, null);
		return json_decode($json, true);
	}
	
	public static function getAllCompanies(){
		$json = self::_send(self::URL_COMPANIE.'?access-token='.self::TOKEN, null, null);
		return json_decode($json, true);
	}
	
	public static function getAllCompaniesArray(){
		return ArrayHelper::map(self::getAllCompanies(),'id','name');
	}
	
	public static function getNameCompanieById($id){
		$json = self::_send(self::URL_API.'campaign/'.$id.'?access-token='.self::TOKEN, null, null);
		$response = json_decode($json, true);
		return $response['name'];
	}
	
	public function start(){
		
		$json = self::_send(self::URL_TEASER. __FUNCTION__, [
				'id' => $this->_idteaser,
			],
			['Authorization: access-token ' . self::TOKEN]
		);

		return json_decode($json, true);
	}
	
	public function stop(){
		
		$json = self::_send(self::URL_TEASER. __FUNCTION__, [
				'id' => $this->_idteaser,
			],
			['Authorization: access-token ' . self::TOKEN]
		);

		return json_decode($json, true);
	}
	
	public function delete(){
		
		$json = self::_send(self::URL_TEASER. __FUNCTION__, [
				'id' => $this->_idteaser,
			],
			['Authorization: access-token ' . self::TOKEN]
		);

		return json_decode($json, true);
	}
}
