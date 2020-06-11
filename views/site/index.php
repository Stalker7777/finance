<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'FINANCE';
?>
<div class="site-index">

    <div id="form-find" class="form-group">

        <?php $form = ActiveForm::begin(['id' => 'find-form']) ?>

        <div class="row">
            <div class="form-group">
                <div class="col-md-4">
                    <?= $form->field($model, 'find_first_name') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'find_second_name') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'find_middle_name') ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-4">
                    <?= $form->field($model, 'find_phone') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'find_email') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'find_address') ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-12 text-right">
                    <?= Html::submitButton('Фильтровать', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end() ?>
        
    </div>

    <table class="table table-striped table-bordered ">
        <thead>
            <tr>
                <th class="text-center">first_name</th>
                <th class="text-center">second_name</th>
                <th class="text-center">middle_name</th>
                <th class="text-center">phone</th>
                <th class="text-center">email</th>
                <th class="text-center">address</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model->data_array as $item) { ?>
                <tr>
                    <td><?= (isset($item['first_name']) ? $item['first_name'] : ''); ?></td>
                    <td><?= (isset($item['second_name']) ? $item['second_name'] : ''); ?></td>
                    <td><?= (isset($item['middle_name']) ? $item['middle_name'] : ''); ?></td>
                    <td><?= (isset($item['phone']) ? $item['phone'] : ''); ?></td>
                    <td><?= (isset($item['email']) ? $item['email'] : ''); ?></td>
                    <td><?= (isset($item['address']) ? $item['address'] : ''); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
