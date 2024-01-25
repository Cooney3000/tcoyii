<?php

/** @var yii\web\View $this */

$this->title = 'TC Olching Web';
?>

<div class="site-index">

    <div class="body-content">

        <!-- <div class="row">
            <div id="carousel">
                </div>
            </div> -->
        <div class="row">
            <article id="willkommen" class="col mt-5">
                <img class="img-fluid" src="img/carousel/Clubheim.jpg" alt="Das Clubheim">
                <header>
                    <h2>MITGLIEDER!</h2>
                </header>
                <p>Wir freuen uns, dass du den Weg auf unsere Homepage gefunden hast.
                    Hier findest Du alles rund um den TC Olching wie Informationen über die laufende Saison, Angebote, Termine und
                    aktuelle Ereignisse, Ansprechpartner und alles, was für die Mitglieder und Freunde des
                    TC Olching von Interesse ist.</p>
                <p>Der TC Olching beim Bayerischen Tennisverband: <a href="mannschaften.php">Link</a></p>
            </article>
        </div>
        <div class="row">
            <article id="erwachsenenangebot" class="col mt-5">
                <img class="img-fluid" src="img/carousel/Zuschauer.jpg" alt="Entspannte Atmosphäre im Tennisclub">
                <header>
                    <h2>Ein Platz für Dich: Tennis und Gemeinschaft im TCO</h2>
                </header>
                <h3>Entspannung und Netzwerken für Erwachsene</h3>
                <p>Im TC Olching geht es nicht nur um Tennis, sondern auch um ein lebendiges Miteinander. Unser Club bietet den idealen Rahmen, um nach einem anstrengenden Arbeitstag zu entspannen. Genieße ein kühles Getränk in unserem Vereinsheim und knüpfe Kontakte in einer freundlichen, erwachsenen Atmosphäre.</p>
                <p>Unsere regelmäßigen Clubabende und das DropIn sind perfekt, um neue Freundschaften zu schließen. Erlebe die Freude am Tennissport gemeinsam mit Gleichgesinnten.</p>
                <p>Für alle, die nach sportlichem Ehrgeiz und sozialer Interaktion suchen, ist der TCO der ideale Ort. Ob bei Turnieren, Mannschaftsspielen oder einfach nur beim freien Spiel - hier findest Du Deine Tennisgemeinschaft.</p>
                <p>Komm zu uns und erlebe, dass Tennis mehr als nur ein Sport sein ist.</p>
                <p>Als Mitglied hast du Zugriff auf viele Online-Möglichkeiten.</p>
                
            </article>

            <article id="familienangebot" class="col mt-5">
                <img class="img-fluid" src="img/carousel/Kids.jpg" alt="Familienfreundliche Atmosphäre im Tennisclub">
                <header>
                    <h2>Tennis für die ganze Familie: Spiel, Spaß und Lernen im TCO</h2>
                </header>
                <h3>Ein sportliches Zuhause für Jung und Alt</h3>
                <p>Der TC Olching ist ein familienfreundlicher Club, der Tennis für alle Altersgruppen anbietet. Wir schaffen eine spielerische und sichere Umgebung, in der Kinder und Jugendliche ihre Fähigkeiten entfalten können, während Eltern die Möglichkeit haben, selbst aktiv zu werden oder entspannt zuzuschauen.</p>
                <p>Eltern finden oft einen Wiedereinstieg, wenn ihre Kinder in das richtige Alter für Tennis kommen, oder erfahren Tennis als neue Sportart. Dies ermöglichen wir auch durch einen niederschwelligen Einstieg mit unserer günstigen Schnuppermitgliedschaft und das Angebot des Come-Back-Trainings. Kinder und Jugendliche und Viele unserer jungen Erwachsenen sind mit dem Verein groß geworden und bleiben ihm ihr Leben lang verbunden.</p>
                <p>Entdeckt den TCO als Ort, an dem Eure Familie wächst - sowohl auf dem Platz als auch daneben. Werdet Teil unserer Tennisfamilie!</p>
            </article>
        </div>

        <div class="row">
            <article id="presse" class="col mt-5">
                <header>
                    <h2>Pressespiegel</h2>
                </header>
                <div class="row">
                    <?php
                    // Verzeichnis mit Presseartikeln frontend\web\img\presse
                    $imageDirectory = 'img/presse';
                    $images = glob($imageDirectory . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    rsort($images, SORT_REGULAR);
                    foreach ($images as $image) {
                        [$datum, $publikation, $titel] = explode('_', basename($image));
                        $ttmmjjjj = substr($datum, 6, 2) . "." . substr($datum, 4, 2) . "." . substr($datum, 0, 4);
                    ?>
                        <div class="col-md-6 image">
                            <div><?= $ttmmjjjj ?> - <?= $publikation ?></div>
                            <a href="<?= $image ?>"><img src="<?php echo $image; ?>" class="img-fluid" alt="<?= $ttmmjjjj ?> - <?= $publikation ?>"></a>
                        </div>
                    <?php
                    };
                    ?>
                </div>
            </article>

        </div>

    </div>