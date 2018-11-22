<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companie".
 *
 * @property int $idcompanie
 * @property string $name
 * @property int $idoffer
 */
class Companie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_api'], 'required'],
            [['id_api'], 'integer'],
            [['name'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcompanie' => 'Idcompanie',
            'name' => 'Name',
            'idoffer' => 'Idoffer',
        ];
    }
}
