<?php

namespace app\models\api;

class Oblivki
{
	const URL_API = 'https://api.oblivki.biz/1.0/';
	const STAT_TEASER = 'stat/advert-teaser';
	const URL_COMPANIE = 'https://api.oblivki.biz/1.0/campaigns';
	const TOKEN = 'XBaehCEd_FvaFIswhjUK0KYWeatV4QwHQqTy02IYw2Pvvc8-F_a8m_Z5vg4KP8';
	
	public static function _send($url, $data, $headers = []) {
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
	
	protected function _encodeImage($url){
		return base64_encode(file_get_contents($url));
	}
	
	
	public static function getAllTeaserInfo(){
		$json = self::_send(self::URL_API.'teasers?access-token='.self::TOKEN, null, null);//work
		return json_decode($json, true);
	}
	
	public static function getTeaserStat($id){
		$json = self::_send(self::URL_API.self::STAT_TEASER.'?access-token='.self::TOKEN.'&teaserId='.$id, null, null);
		return json_decode($json, true);
	}
	
	public static function getAllTeaserStat(){
		$json = self::_send(self::URL_API.self::STAT_TEASER.'?access-token='.self::TOKEN.'&group=teaserId&dateFrom=2018-11-01', null, null);
		return json_decode($json, true);
	}
	
	public static function getAllCompanies(){
		$json = self::_send(self::URL_COMPANIE.'?access-token='.self::TOKEN, null, null);
		return json_decode($json, true);
	}
	
	public static function getNameCompanieById($id){
		$json = self::_send(self::URL_API.'campaign/'.$id.'?access-token='.self::TOKEN, null, null);
		$response = json_decode($json, true);
		return $response['name'];
	}

	public static function getTeaserStatByCompanie($id){
		$json = self::_send(self::URL_API.self::STAT_TEASER.'?access-token='.self::TOKEN.'&group=teaserId&dateFrom=2018-11-01', null, null);
		return json_decode($json, true);
	}
	
	public static function getTeaserInfoByCompanie($id){
		$json = self::_send(self::URL_API.'teasers?access-token='.self::TOKEN.'&campaignId='.$id, null, null);
		return json_decode($json, true);
	}
	
}
