<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CmContent $model */

$this->title = 'Create Cm Content';
$this->params['breadcrumbs'][] = ['label' => 'Cm Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cm-content-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
