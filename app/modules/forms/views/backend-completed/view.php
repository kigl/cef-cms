<?php
use yii\helpers\Html;

$this->params['breadcrumbs'] = $data['breadcrumbs'];
?>

<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th><?= Yii::t('app', 'Name') ?></th>
            <th><?= Yii::t('app', 'Value') ?></th>
        </tr>
        <?php foreach ($data['fieldsGroup'] as $group) : ?>
            <? foreach ($group as $groupName => $fields) : ?>
                <?php ksort($fields); ?>
                <?php if ($groupName !== 'none') : ?>
                    <tr>
                        <td colspan="2"><b><?= Html::encode($groupName); ?></b></td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($fields as $field) : ?>
                    <?php foreach ($field as $index => $value) : ?>
                        <tr>
                            <td><?= $data['model']->fieldsValue[$index]->field->name; ?></td>
                            <td><?= $value; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
