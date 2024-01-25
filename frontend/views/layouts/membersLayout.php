<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\assets\MembersAreaAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
MembersAreaAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?= Yii::$app->request->baseUrl; ?>/favicon.ico"/>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>


<header>
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="/img/global/TCO-Logo_text-white_80pxl.png" alt="TC Olching Logo">'.
                        '&nbsp;<img src="/img/tools/intern_v.png" alt="Bereich">',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-area fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Events', 'url' => ['/members/index']],
        ['label' => 'Turnier', 'url' => ['/members/tournaments']],
        ['label' => 'Hall of Fame', 'url' => ['/members/halloffame']],
        ['label' => 'Platzbuchung', 'url' => ['/members/booking']],
    ];
    if (Yii::$app->user->can('Executive')) {
        $menuItems[] = ['label' => 'Executives', 'url' => ['/executives/index']];
    }
    $menuItems[] = ['label' => '[<<<]', 'url' => ['/site/index']];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0 '],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end">Powered by Conny Roloff Enterprises</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
