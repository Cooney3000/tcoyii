<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CmContentRoles $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cm-content-roles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content_id')->textInput() ?>

    <?= $form->field($model, 'role_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
