<?php

namespace app\models\api;

class CompanieApi extends Oblivki
{		
	const COMPANIE = 'campaign/';
	
	public $name;
		
	private $_idcompanie;
	
	function __construct($id = null){
		$this->_idcompanie = $id;
	}
	
	public function create(){
		
		/*$json = parent::_send(parent::URL_TEASER . self::COMPANIE. __FUNCTION__, [
				
						'name' => $name,						//- название кампании 
						'typeId' => 1, 							// - тип кампании (1 - товарная, 2 - контент, 3 - премиум)
						'location'								// - список(массив) ID стран (см. метод locations)
						'browserSelectType' 					//- вид браузеров (* 1 - Все, 4 - Выборочно)
						'platformSelectType' 					//- вид платформ (* 1 - Все, 4 - Выборочно)
						'browser'								// - список(массив) ID браузеров, для browserSelectType=4 (см. метод browsers)
						'platform'								// - список(массив) ID платформ, для platformSelectType=4 (см. метод platforms)
						'deviceTypeSelectMode'					// - способ выбора типа устройств (* 0 - Все, 1 - Выборочно)
						'deviceType'							// - список типов устройств, для deviceTypeSelectMode=1, может содержать значения: 1 - ПК, 2 - мобильный телефон, 3 - планшет 
						'categoryType'							// - способ выбора категории новостей/тематики площадок (* 1 - Все, 2 - Выборочно)
						'categoryWl'							// - список(массив) ID категорий новостей/тематик площадок, для categoryType=2 (см. метод subjects)
						'useBid'  								// - использовать общую цену клика (* 0 - нет, 1 - да)
						* если useBid = 1 pcCommonPrice, mobileCommonPrice, tabletCommonPrice - цены для каждого типа устройств float число 
						* если useBid = 1 showcasePcPricesJson, showcaseTabletPricesJson, showcaseMobilePricesJson, sitePcPricesJson, siteTabletPricesJson, siteMobilePricesJson - тонкая настройка цен в разрезе типа устройства, места отображения тизера (витрины, сайты) и категории новости на витрине либо тематики сайта сериализованный в json массив с элементами формата [id категории => цена] 
						'utmType'								// - передача UTM-меток (* 0 - отключено, 1 - стандартные, 2 - индивидуальные)
						'utmParams'								// - строка параметров, которая будет добавлена к URL (при utmType == 2)
						'useUrl'								// - использовать общий URL для кампании (* 0 - нет, 1 - да необходимо передать url)
						'url'									// - общий URL (при useUrl = 1)
						'useList'								// - фильтр (1 - черный список, 2 - белый список, * 3 - не используется)
						'sourceBl'								//- черный список ID площадок через "," (для useList = 1)
						'sourceWl'								// - белый список ID площадок через "," (для useList = 2)
						'newsSourceUrl'							// - источник (для новостных кампаний)
						'autoStart'								// - автоматически запускать тизеры после модерации (* 0 - нет, 1 - да)
						'budgetType'							// - тип лимита бюджета на кампанию (* 1 - Без ограничений, 2 - Единоразовый лимит, 3 - Дневной лимит, 4 - Дневной лимит на тизеры)
						В случае указания какого-либо типа бюджета кроме 1, необходимо послать цифру в budget
						'budget'								// - сумма лимита бюджета на кампанию 
						'schedule'								// - открутить кампанию в определенный период (* 1 - Все даты, 2 - Интервал)
						'intervalStart'							// - начало периода открутки в формате ДД.ММ.ГГГГ
						'intervalEnd'							// - конец периода открутки в формате ДД.ММ.ГГГГ
						'scheduler'								// - планировщик (автозапуск / остановка в указанные дни недели и время) (* 0 - Отключено, 1 - Выборочно)
						'days'									// - массив дней недели, подробнее
						'time'									// - массив времен суток, подробнее


			], 
			['Authorization: access-token ' . parent::TOKEN]
		);*/

		return json_decode($json, true);
	}
	
	public function update(){
		
		$json = parent::_send(parent::URL_API . self::COMPANIE. __FUNCTION__, [
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
	
	public function delete(){
		
		$json = parent::_send(parent::URL_API . self::COMPANIE. __FUNCTION__, [
				'id' => $this->_idcompanie,
			],
			['Authorization: access-token ' . parent::TOKEN]
		);
		
		return json_decode($json, true);
	}
}
