<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teaser_settings".
 *
 * @property int $idcompanie
 * @property int $views
 * @property int $clicks
 * @property int $minutes
 * @property string $ctr
 */
class TeaserSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teaser_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcompanie'], 'required'],
			[['views', 'clicks', 'minutes', 'ctr'], 'oneRequired', 'skipOnEmpty' => false],
			[['idcompanie', 'views', 'clicks', 'minutes'], 'integer'],
            [['ctr'], 'number'],
            [['idcompanie'], 'unique'],
        ];
    }

	public function oneRequired($attribute, $params, $validator){
       if (empty($this->views) && empty($this->clicks) && empty($this->minutes) && empty($this->ctr)) {
			$this->addError($attribute_name, 'At least 1 of the field must be Required');
			return false;
		}
		return true;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcompanie' => 'Idcompanie',
            'views' => 'Views',
            'clicks' => 'Clicks',
            'minutes' => 'Minutes',
            'ctr' => 'Ctr',
        ];
    }
}
