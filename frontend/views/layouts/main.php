<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\assets\PublicAreaAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

common\assets\AppAsset::register($this);
AppAsset::register($this);
PublicAreaAsset::register($this);
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
    <link rel="shortcut icon" type="image/x-icon" href="<?= Yii::$app->request->baseUrl; ?>/favicon.ico" />

</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <header>
        <?php
        NavBar::begin([
            // 'brandLabel' => Yii::$app->name,
            'brandLabel' => '<img src="/img/global/TCO-Logo_text-white_80pxl.png" alt="TC Olching Logo">',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-area fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => 'Aktuell', 'url' => ['/site/index']],
            ['label' => 'Verein', 'url' => ['/site/verein']],
            ['label' => 'Mannschaften', 'url' => ['/site/teams']],
            ['label' => 'Jugend', 'url' => ['/site/jugend']],
            ['label' => 'Trainer', 'url' => ['/site/trainer']],
            ['label' => 'Kontakt', 'url' => ['/site/kontakt']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Registrieren', 'url' => ['/site/signup']];
        } else {
            $menuItems[] = ['label' => 'Mitglieder', 'url' => ['/members/index']];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => $menuItems,
        ]);
        if (Yii::$app->user->isGuest) {
            echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
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

    <footer class="footer">
        <div class="container px-3">
            <article id="impressum" class="row mt-3">
                <h2>Impressum, Kontakt, Bankverbindung</h2>
                <div class="col">
                    <h4>Anschrift:</h4>
                    Tennis Club Olching e.V.<br>
                    Amperau 14<br>
                    82140 Olching<br>
                    Vereinsnummer im BTV: 02262<br>
                </div>
                <div class="col">
                    <h4>Kontakt:</h4>
                    Telefon: 08142 / 1 24 51 (Vereinsheim)<br>
                    eMail: <a href="mailto:mail@TCOlching.de">mail@TCOlching.de</a>
                    <div id="datenschutz">
                        <a href="datenschutzerklaerung.php">Datenschutzerklärung</a><br>
                    </div>
                </div>
                <div class="col">
                    <h4>Bankverbindung:</h4>
                    VR-Bank<br>
                    IBAN <samp>DE90701633700003265129</samp><br>

                    <div id="anfahrtbutton">
                        <a href="verein.php#anfahrt">Anfahrt</a><br>
                        <a href="verein.php#uebernachtung">Übernachtung</a>
                    </div>
                </div>
            </article>
            <article id="social" class="row mt-3">
                <h2>Social</h2>
                <p>
                    Anregungen und Hinweise zur Website bitte an unseren <a href="mailto://webmaster@tcolching.de">Webmaster Conny Roloff</a>.
                </p>
                <div class="container">
                    <div class="float-start">
                        <h4>Instagram:</h4>
                        <a href="https://instagram.com/tcolching?igshid=MzRlODBiNWFlZA=="><img src="/img/socialmedia/QR_Code_Instagram.png?rnd=<?php echo time(); ?>"></a>
                    </div>
                    <div class="float-end">
                        <h4>Facebook:</h4>
                        <a href="https://www.facebook.com/profile.php?id=100095247892556"><img src="/img/socialmedia/QR_Codes_Facebook.png?rnd=<?php echo time(); ?>"></a>
                    </div>
                </div>
            </article>

            <div class="container mt-3 poweredby">
                <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
                <p class="float-end">Powered by Conny Roloff Enterprises</p>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
