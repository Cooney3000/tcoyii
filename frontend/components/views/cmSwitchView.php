<?php

use yii\helpers\Html;
use yii\helpers\Url;

echo '<span id="cm-content-item" class="switch-label ' . Html::encode($title) . '">' . Html::encode($title) . "</span>";

if (Yii::$app->user->can('RestaurantAdministrator')) {
    echo '<span class="cm-icon-container" onclick="switchRestaurantState()">' .
        Html::tag('i', '', ['class' => 'bi bi-arrow-left-right']) .  // Using Bootstrap icon
        "</span>";
}
?>

<script>
    function switchRestaurantState() {
        var switchUrl = "<?= Url::to(['cm-content/switch-state-action']) ?>";
        $.ajax({
            url: switchUrl,
            type: "POST",
            data: {
                contentId: "<?= $contentId ?>", // Replace with actual content ID variable
                _csrf: yii.getCsrfToken() // CSRF token for Yii2
            },
            success: function(response) {
                var parsedResponse = JSON.parse(response); // Parse the JSON string
                var newState = parsedResponse.newState;

                var item = $('#cm-content-item');
                item.text(newState); // Update the text

                // Remove the old classes and add the new class
                item.removeClass('geoeffnet geschlossen');
                item.addClass(newState);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });

    }
</script>