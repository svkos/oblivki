<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class MultipleUpload extends Model
{
    /**
     * @var UploadedFile[] files uploaded
     */
    public $files;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
			[['files'], 'file', 'extensions' => 'jpg,png,jpeg', 'mimeTypes' => 'image/jpeg', 'maxFiles' => 100, 'skipOnEmpty' => false],
        ];
    }
}
?>