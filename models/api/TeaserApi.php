<?php

namespace app\models\oblivki;

use yii\helpers\ArrayHelper;

class Teaser extends Oblivki
{		
	const TEASER = 'teaser/';

	private $_idteaser;
	
	public $idcompany;
	public $text;
	public $title;
	public $imageUrl;
	public $pcCommonPrice;
	public $mobileCommonPrice;
	public $tabletCommonPrice;
		
	function __construct($id = null){
		$this->_idteaser = $id;	
	}
	
	public function create(){
		
		$json = parent::_send(parent::URL_TEASER . self::TEASER. __FUNCTION__, [
				'campaignId' => $this->idcompany, 
				'title' => $this->title,
				'text' => $this->text,
				'uploaded' => $this->_encodeImage($this->imageUrl),
				'pcCommonPrice' => $this->pcCommonPrice,
				'mobileCommonPrice' => $this->mobileCommonPrice,
				'tabletCommonPrice' => $this->tabletCommonPrice,
			], 
			['Authorization: access-token ' . parent::TOKEN]
		);

		return json_decode($json, true);
	}
	
	public function update(){
		
		$json = parent::_send(parent::URL_TEASER . self::TEASER. __FUNCTION__, [
				'id' => $this->_idteaser,
				'title' => $this->title,
				'text' => $this->text,
				'pcCommonPrice' => $this->pcCommonPrice,
				'mobileCommonPrice' => $this->mobileCommonPrice,
				'tabletCommonPrice' => $this->tabletCommonPrice
			],
			['Authorization: access-token ' . parent::TOKEN]
		);

		return json_decode($json, true);
	}
	
	public function start(){
		
		$json = parent::_send(parent::URL_TEASER . self::TEASER. __FUNCTION__, [
				'id' => $this->_idteaser,
			],
			['Authorization: access-token ' . parent::TOKEN]
		);

		return json_decode($json, true);
	}
	
	public function stop(){
		
		$json = parent::_send(parent::URL_TEASER . self::TEASER. __FUNCTION__, [
				'id' => $this->_idteaser,
			],
			['Authorization: access-token ' . parent::TOKEN]
		);

		return json_decode($json, true);
	}
	
	public function delete(){
		
		$json = parent::_send(parent::URL_TEASER . self::TEASER. __FUNCTION__, [
				'id' => $this->_idteaser,
			],
			['Authorization: access-token ' . parent::TOKEN]
		);

		return json_decode($json, true);
	}
	
	public function getTeaserInfo(){
		$json = parent::_send(parent::URL_TEASER.$this->_idteaser.'?access-token='.self::TOKEN, null, null);
		return json_decode($json, true);
	}
}
