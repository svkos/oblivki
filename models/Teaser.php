<?php

namespace app\models;

use Yii;
use app\models\oblivki\TeaserApi;
use yii\helpers\Url;
/**
 * This is the model class for table "teaser".
 *
 * @property int $idteaser
 * @property int $idcompanie
 * @property string $name_companie
 * @property string $date
 * @property int $id_text
 * @property int $id_image
 * @property string $price_pc
 * @property string $price_mob
 * @property string $price_tab
 * @property string $rating
 * @property int $api_idteaser
 *
 * @property Images $image
 * @property Texts $text
 */
class Teaser extends \yii\db\ActiveRecord
{
	public $count;
	public $idcompanie;
	public $url;
	
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
            [['idcompanie', 'name_companie', 'date', 'id_text', 'id_image', 'price_pc', 'price_mob', 'price_tab'], 'required'],
            [['idcompanie', 'id_text', 'id_image', 'api_idteaser', 'count'], 'integer'],
            [['date'], 'safe'],
			[['url'], 'safe'],
            [['price_pc', 'price_mob', 'price_tab', 'rating'], 'number'],
            [['name_companie'], 'string', 'max' => 80],
            [['id_text'], 'unique'],
            [['id_image'], 'unique'],
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
            'idcompanie' => 'Idcompanie',
            'name_companie' => 'Name Companie',
            'date' => 'Date',
            'id_text' => 'Id Text',
            'id_image' => 'Id Image',
            'price_pc' => 'Price Pc',
            'price_mob' => 'Price Mob',
            'price_tab' => 'Price Tab',
            'rating' => 'Rating',
            'api_idteaser' => 'Api Idteaser',
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
			$text = Texts::find()->all();
			$randomText = rand(0,count($text));
			
			$image = Images::find()->all();
			$randomImage = rand(0,count($image));
			
			
			//validate
			
			$api = new TeaserApi();	
		
			$api->idcompany = $this->idcompanie;
			$api->text = $text[$randomText]->text;
			$api->imageUrl = Url::base(true).'/'.$image[$randomImage]->path;
			$api->pcCommonPrice = 0.5;
			$api->mobileCommonPrice = 0.5;
			$api->tabletCommonPrice = 0.5;
			
			$response = $api->create();
			echo '<pre>';
			if($response['message'] == 'success'){
				
				$teaser = new self();
				$teaser->idcompanie = $this->idcompanie;
				$teaser->name_companie = 'name';
				$teaser->date = date('Y-m-d H:i:s');
				$teaser->id_text = $text[$randomText]->id_text;
				$teaser->id_image = $image[$randomImage]->id_image;
				$teaser->price_pc = 0.5;
				$teaser->price_mob = 0.5;
				$teaser->price_tab = 0.5;
				$teaser->api_idteaser = (int)$response['id'];
				$teaser->save(false);
				
				//print_r($teaser);
				
				$this->count--;
			}else{
				//print_r($response);
			}	
		}
    }
	
}
