<?php
use yii\helpers\Html;

// Debug: Output cmContent count
// Yii::error("cmContentView is saying: cmContent items count: " . count($cmContent));


if (!empty($widgetOutput)) {
    echo $widgetOutput; 
} else {
    echo "No content available.";
}