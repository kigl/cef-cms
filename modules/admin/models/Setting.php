<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\HttpException;

/**
 * This is the model class for table "mn_setting".
 *
 * @property integer $id
 * @property string $module_id
 * @property string $name
 * @property string $label
 * @property string $views
 * @property integer $update_time
 * @property integer $user_id
 * @property integer $type_id
 */
class Setting extends \yii\db\ActiveRecord
{

    protected $fieldType = ['text', 'checkbox', 'textarea'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'name', 'label', 'views', 'type_id'], 'required'],
            [['module_id', 'name', 'label'], 'string', 'max' => 50],
            [['views'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'Setting id'),
            'module_id' => Yii::t('admin', 'Module id'),
            'name' => Yii::t('admin', 'Setting name'),
            'label' => Yii::t('admin', 'Label'),
            'views' => Yii::t('admin', 'Value'),
            'create_time' => Yii::t('app', 'Cretate time'),
            'update_time' => Yii::t('app', 'Update time'),
            'user_id' => Yii::t('admin', 'User id'),
            'type_id' => Yii::t('admin', 'Setting type id'),
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
