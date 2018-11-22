<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "texts".
 *
 * @property int $id_text
 * @property string $text
 * @property int $rating
 *
 * @property Teaser $teaser
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
            [['text'], 'required'],
            [['rating'], 'integer'],
            [['text'], 'string', 'max' => 100],
            [['text'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_text' => 'Id Text',
            'text' => 'Text',
            'rating' => 'Rating',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeaser()
    {
        return $this->hasOne(Teaser::className(), ['id_text' => 'id_text']);
    }
	
}
