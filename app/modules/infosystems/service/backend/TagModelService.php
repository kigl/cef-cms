<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.01.2017
 * Time: 19:21
 */

namespace app\modules\infosystems\service\backend;


use app\modules\infosystems\Module;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\infosystems\models\backend\Tag;

class TagModelService extends InfosystemModelService
{
    public function manager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tag::find(),
        ]);
        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs()
        ]);
    }

    public function create()
    {
        $model = new Tag();

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);

        if ($model->load($this->getData('post')) and $model->save()) {
            return true;
        }

        return false;
    }

    public function update()
    {
        $model = Tag::find()
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbs(null, $model->name),
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {
            return true;
        }

        return false;
    }

    protected function getBreadcrumbs(Model $infosystem = null, $data = null)
    {
        $breadcrumbs = parent::getBreadcrumbs($infosystem, null);

        $breadcrumbs[] = ['label' => Module::t('Tags'), 'url' => 'backend-tag/manager'];

        if ($data) {
            $breadcrumbs[] = ['label' => $data];
        }

        return $breadcrumbs;
    }
}