<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id_image
 * @property int $id_offer
 * @property string $path
 *
 * @property Teaser[] $teasers
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_offer', 'path'], 'required'],
			['id_offer', 'unique', 'targetAttribute' => ['id_offer', 'path']],
            [['id_offer'], 'integer'],
            [['path'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_image' => 'Id Image',
            'id_offer' => 'Id Offer',
            'path' => 'Path',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeasers()
    {
        return $this->hasMany(Teaser::className(), ['id_image' => 'id_image']);
    }
}
