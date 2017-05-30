<?php
/**
 * Class InfosystemModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\service\backend;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use app\core\traits\Breadcrumbs;
use app\modules\infosystems\Module;
use app\modules\infosystems\models\backend\Infosystem;

class InfosystemModelService extends \app\core\service\ModelService
{
    use Breadcrumbs;

    protected $_model;

    public function manager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => infosystem::find()
                ->where(['site_id' => Yii::$app->site->getId()]),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs()
        ]);
    }

    public function create()
    {
        $this->_model = new Infosystem();

        $dataProvider = new ActiveDataProvider([
            'query' => $this->_model->getProperties(),
        ]);

        $this->setData([
            'model' => $this->_model,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs()
        ]);

        return $this->save();
    }

    public function update()
    {
        $this->_model = Infosystem::find()
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        if (!$this->_model) {
            throw new HttpException(500);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $this->_model->getProperties(),
            'sort' => [
                'defaultOrder' => ['sorting' => SORT_ASC],
            ],
        ]);

        $this->setData([
            'model' => $this->_model,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs($this->_model, $this->_model->name),
        ]);

        return $this->save();
    }

    public function delete($id)
    {
        $this->_model = Infosystem::find()
            ->where(['id' => $id])
            ->with(['groups'])
            ->one();

        if (!$this->_model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $this->_model,
        ]);

        if ($this->_model && $this->_model->delete()) {

            foreach ($this->_model->groups as $group) {
                Yii::createObject(GroupModelService::class)->actionDelete($group->id);
            }

            $items = $this->_model->getItems()
                ->all();

            foreach ($items as $item) {
                Yii::createObject(ItemModelService::class)->actionDelete($item->id);
            }

            return true;
        }

        return false;
    }

    private function save($validate = true)
    {
        if ($this->_model->load(Yii::$app->request->post()) && $this->_model->validate($validate)) {

            $this->_model->save(false);

            return true;
        }

        return false;
    }

    protected function getBreadcrumbs(Model $infosystem = null, $data = null)
    {
        $breadcrumbs = [];

        $breadcrumbs[] = ['label' => Module::t('Infosystems'), 'url' => ['backend-infosystem/manager']];

        if ($infosystem) {
            $breadcrumbs[] = [
                'label' => $infosystem->name,
                'url' => ['backend-group/manager', 'infosystem_id' => $infosystem->id]
            ];
        }

        if ($data) {
            $breadcrumbs[] = ['label' => $data];
        }

        return $breadcrumbs;
    }
}