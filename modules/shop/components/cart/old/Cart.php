<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 24.12.2016
 * Time: 21:14
 */

namespace app\modules\shop\components\cart;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;

class Cart extends Component implements CartInterface, BootstrapInterface
{
    public $classProduct;

    public $cookieName;

    public $cookieTimeDays;

    public $cookie;

    public $product;

    public function bootstrap($app)
    {
        // TODO: Implement bootstrap() method.
    }

    public function init()
    {
        parent::init();

        $this->product = Yii::createObject([
            'class' => CartProductModel::class,
            'classModel' => $this->classProduct,
        ]);

        $this->cookie = Yii::createObject([
            'class' => CartCookie::class,
            'name' => $this->cookieName,
            'timeDays' => $this->cookieTimeDays,
        ]);
    }

    public function add($productId, $count)
    {
        $this->cookie->setValue($productId, $count);
    }

    public function delete($productId)
    {

    }

    public function deleteAll()
    {
        // TODO: Implement deleteAll() method.
    }

    public function getClass()
    {
        return $this->cookie;
    }
}