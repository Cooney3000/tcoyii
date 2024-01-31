<?php

namespace frontend\components;

use yii\base\Widget;
use app\models\CmContent; 
use frontend\components\CmSwitchWidget; 
// use frontend\components\CmCopyWidget; 
use Yii;

class CmContentWidget extends Widget
{
    public $restrictByName = null; 

    public function run()
    {

        $userRoles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        $userRoleNames = array_keys($userRoles);

        $query = CmContent::find()->alias('cc')
            ->joinWith('cmContentRoles ccr');

        // Add this conditional to apply the restriction
        if ($this->restrictByName !== null) {
            $query->andWhere(['cc.name' => $this->restrictByName]);
        }
        // Add restricting role names to the query
        $query->andWhere(['ccr.role_name' => $userRoleNames]);

        $cmContent = $query->all();
        $widgetOutput = '';  // Initialize an empty string to accumulate widget outputs

        foreach ($cmContent as $contentItem) {
            switch ($contentItem->type) {
                case 'Switch':
                    $widgetOutput .= CmSwitchWidget::widget(['content' => $contentItem]);
                    break;
                // case 'Copy':
                //     echo CmCopyWidget::widget(['content' => $contentItem]);
                //     break;
                // Add other cases as needed
            }
        }
        return $this->render('cmContentView', [
            'widgetOutput' => $widgetOutput,
        ]);
    }
}
