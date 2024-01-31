<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CmContentRoles $model */

$this->title = 'Create Cm Content Roles';
$this->params['breadcrumbs'][] = ['label' => 'Cm Content Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cm-content-roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
