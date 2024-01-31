<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CmContent $model */

$this->title = 'Update Cm Content: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cm Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cm-content-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
