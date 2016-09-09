<?php

namespace app\modules\main\models;

use Yii;
use yii\web\HttpException;

/**
 * This is the model class for table "mn_setting".
 *
 * @property integer $id
 * @property string $module_id
 * @property string $name
 * @property string $label
 * @property string $value
 * @property integer $update_time
 * @property integer $user_id
 * @property integer $type_id
 */
class Setting extends \app\modules\main\components\ActiveRecord
{

    protected $fieldType = ['text', 'checkbox', 'textarea'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'name', 'label', 'value', 'type_id'], 'required'],
            [['module_id', 'name', 'label'], 'string', 'max' => 50],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'module_id' => Yii::t('main', 'Module ID'),
            'name' => Yii::t('main', 'Name'),
            'label' => Yii::t('main', 'Label'),
            'value' => Yii::t('main', 'Value'),
            'create_time' => Yii::t('main', 'Cretate time'),
            'update_time' => Yii::t('main', 'Update Time'),
            'user_id' => Yii::t('main', 'User ID'),
            'type_id' => Yii::t('main', 'Type ID'),
        ];
    }

    public function behaviors()
    {
        return [
						[
							'class' => 'yii\behaviors\TimestampBehavior',
							'createdAtAttribute' => 'create_time',
							'updatedAtAttribute' => 'update_time',
						]
        ];
    }

    public function getFieldTypeList()
    {
        return $this->fieldType;
    }

    public function getFieldType($type)
    {
        return $this->fieldType[$type];
    }

    public static function getModuleSetting($id)
    {
        $model = self::find()
        					->where('module_id = :id', [':id' => $id])
        					->all();
        if ($model == null) {
            throw new HttpException('404');
        }

        return $model;
    }

    /**
     * Пакетное удаление настроек модуля
     */
    public static function deleteSettingModule($id)
    {
        $model = Setting::model()->deleteAll('module_id = :id', ['id' => $id]);

        if ($model == null) {
            throw new CHttpException('404', Yii::t('main', 'not module'));
        }
    }
}
