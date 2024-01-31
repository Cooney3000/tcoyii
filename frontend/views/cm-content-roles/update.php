<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CmContentRoles $model */

$this->title = 'Update Cm Content Roles: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cm Content Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cm-content-roles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
