<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "texts".
 *
 * @property int $id_text
 * @property int $id_offer
 * @property string $text
 * @property int $rating
 *
 * @property Teaser[] $teasers
 */
class Texts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'texts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_offer', 'text'], 'required'],
			['id_offer', 'unique', 'targetAttribute' => ['id_offer', 'text']],
            [['id_offer'], 'integer'],
            [['text'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_text' => 'Id Text',
            'id_offer' => 'Id Offer',
            'text' => 'Text',
            'rating' => 'Rating',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeasers()
    {
        return $this->hasMany(Teaser::className(), ['id_text' => 'id_text']);
    }
}
