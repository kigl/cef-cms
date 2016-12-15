<?php
$modelForm = new \app\models\CouponForm();

if ($modelForm->load(\Yii::$app->request->post()) and $modelForm->validate()) {
    $model = new \app\models\Coupon();

    $itemCouponModel = $model->getOneItem();
    $itemCouponModel->setAttributes([
            'user_name' => $modelForm->name,
            'user_email' => $modelForm->email,
            'status' => \app\models\Coupon::STATUS_COUPON_ISSUED,
        ]
    );
    if ($itemCouponModel->save()) {
        $itemCouponModel->sendEmail();
    }
}
