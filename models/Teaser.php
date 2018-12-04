<?php

namespace app\models;

use Yii;
use app\models\api\TeaserApi;
use yii\helpers\Url;

/**
 * This is the model class for table "teaser".
 *
 * @property int $idteaser
 * @property int $api_idteaser
 * @property int $idcompanie
 * @property int $id_text
 * @property int $id_image
 * @property string $rating
 * @property int $views
 * @property int $clicks
 * @property string $ctr
 * @property string $price_pc
 * @property string $price_mob
 * @property string $price_tab
 * @property string $date
 *
 * @property Images $image
 * @property Texts $text
 */
class Teaser extends \yii\db\ActiveRecord
{
	public $count;
	//public $idcompanie;
	public $id_offer;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teaser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['api_idteaser', 'idcompanie', 'count', 'id_offer', 'id_text', 'id_image', 'views', 'clicks'], 'integer'],
            [['idcompanie', 'id_text', 'id_image', 'price_pc', 'price_mob', 'price_tab', 'date'], 'required'],
            [['rating', 'ctr', 'price_pc', 'price_mob', 'price_tab'], 'number'],
            [['date'], 'safe'],
            [['api_idteaser'], 'unique'],
            [['id_image'], 'exist', 'skipOnError' => true, 'targetClass' => Images::className(), 'targetAttribute' => ['id_image' => 'id_image']],
            [['id_text'], 'exist', 'skipOnError' => true, 'targetClass' => Texts::className(), 'targetAttribute' => ['id_text' => 'id_text']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idteaser' => 'Idteaser',
            'api_idteaser' => 'Api Idteaser',
            'idcompanie' => 'Idcompanie',
            'id_text' => 'Id Text',
            'id_image' => 'Id Image',
            'rating' => 'Rating',
            'views' => 'Views',
            'clicks' => 'Clicks',
            'ctr' => 'Ctr',
            'price_pc' => 'Price Pc',
            'price_mob' => 'Price Mob',
            'price_tab' => 'Price Tab',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['id_image' => 'id_image']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getText()
    {
        return $this->hasOne(Texts::className(), ['id_text' => 'id_text']);
    }
	
	public function createTeasers(){
        while($this->count != 0){
			$text = Texts::find()->where(['id_offer' => $this->id_offer])->all();
			$randomText = rand(0,count($text));
			
			$image = Images::find()->where(['id_offer' => $this->id_offer])->all();
			$randomImage = rand(0,count($image));
			
			if(!(count($text) && count($image))){
				echo 'null';die;
			}
			
			
			//validate
			
			$api = new TeaserApi();	
		
			$api->idcompany = $this->idcompanie;
			$api->text = $text[$randomText]->text;
			$api->imageUrl = Url::base(true).'/'.$image[$randomImage]->path;
			$api->pcCommonPrice = 0.5;
			$api->mobileCommonPrice = 0.5;
			$api->tabletCommonPrice = 0.5;
			
			$response = $api->create();
			//echo '<pre>';
			if($response['message'] == 'success'){
				$teaser = new self();
				$teaser->idcompanie = $this->idcompanie;
				$teaser->date = date('Y-m-d H:i:s');
				$teaser->id_text = $text[$randomText]->id_text;
				$teaser->id_image = $image[$randomImage]->id_image;
				$teaser->price_pc = 0.5;
				$teaser->price_mob = 0.5;
				$teaser->price_tab = 0.5;
				$teaser->api_idteaser = (int)$response['id'];
				$teaser->save();
				
				$this->count--;
			}else{
				//print_r($response);
			}	
		}
    }
}
