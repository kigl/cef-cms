<?php

namespace app\modules\infosystem\models\backend;

use Yii;
use app\modules\tag\components\TagBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "mn_infosystem_item".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $infosystem_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image_1
 * @property string $image_2
 * @property string $file
 * @property integer $status
 * @property integer $sorting
 * @property integer $user_id
 * @property integer $date
 * @property integer $date_start
 * @property integer $date_end
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $create_time
 * @property integer $update_time
 */
class Item extends \app\modules\infosystem\models\Item
{
    protected $_tags;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['image_1', 'image_2'], 'file', 'extensions' => ['jpg', 'png', 'gif']],
            ['editorTag', 'safe'],
        ]);
    }

    public static function find()
    {
        return new ItemQuery(get_called_class());
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            /*'videoUpload' => [
                'class' => 'app\core\behaviors\file\UploadFile',
                'attribute' => 'video',
                'deleteKey' => 'deleteVideo',
                'path' => Yii::$app->controller->module->getPublicPath() . '/video',
                'pathUrl' => Yii::$app->controller->module->getPublicPathUrl() . '/video',
            ],
            'fileUpload' => [
                'class' => 'app\core\behaviors\file\UploadFile',
                'attribute' => 'file',
                'deleteKey' => 'deleteFile',
                'path' => Yii::$app->controller->module->getPublicPath() . '/files',
                'pathUrl' => Yii::$app->controller->module->getPublicPathUrl() . '/files',
            ],*/
            [
                'class' => TagBehavior::className(),
                'relativeModelClass' => ItemTag::class,
            ],
            'convertDate' => [
                'class' => 'app\core\behaviors\ConvertDate',
                'attribute' => 'date',
            ],
            'convertDateStart' => [
                'class' => 'app\core\behaviors\ConvertDate',
                'attribute' => 'date_start',
            ],
            'convertDateEnd' => [
                'class' => 'app\core\behaviors\ConvertDate',
                'attribute' => 'date_end',
            ],
            [
                'class' => 'app\core\behaviors\FillData',
                'attribute' => 'create_time',
                'setAttribute' => 'date',
            ],
            [
                'class' => 'app\core\behaviors\FillData',
                'attribute' => 'name',
                'setAttribute' => 'meta_title',
            ],
            [
                'class' => 'app\core\behaviors\UserId',
                'attribute' => 'user_id',
            ],
            [
                'class' => 'app\core\behaviors\GenerateAlias',
                'text' => 'name',
                'alias' => 'alias',
            ],
        ]);
    }

    public function getProperties()
    {
        return $this->hasMany(ItemProperty::className(), ['item_id' => 'id']);
    }
}
