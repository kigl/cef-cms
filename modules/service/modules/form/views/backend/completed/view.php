<?php
use yii\widgets\DetailView;

?>

<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th><?= Yii::t('app', 'Name')?></th>
            <th><?= Yii::t('app', 'Value')?></th>
        </tr>
<?php foreach ($data['model']->fieldsValue as $field) : ?>
    <tr>
        <td><?= $field->field->name?></td><td><?= $field->value?></td>
    </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>
