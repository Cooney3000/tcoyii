<?php

namespace console\controllers;

use yii\console\Controller;

class RbacController extends Controller
{
    public function actionUpdateRoles()
    {
        $auth = \Yii::$app->authManager;

        // Get existing roles
        $visitor = $auth->getRole('Visitor');
        $member = $auth->getRole('Member');
        $gastronomie = $auth->getRole('Gastronomie');
        $mannschaftsfuehrer = $auth->getRole('Mannschaftsführer');
        $turnierleiter = $auth->getRole('Turnierleiter');
        $executive = $auth->getRole('Executive');
        $schatzmeister = $auth->getRole('Schatzmeister');
        $trainer = $auth->getRole('Trainer');
        $admin = $auth->getRole('Administrator');

        // Create 'Administrator' role if it doesn't exist
        if (!$admin) {
            $admin = $auth->createRole('Administrator');
            $auth->add($admin);
        }

        // Set up role inheritance
        $auth->addChild($member, $visitor);
        $auth->addChild($mannschaftsfuehrer, $member);
        $auth->addChild($gastronomie, $member);
        $auth->addChild($trainer, $member);
        $auth->addChild($turnierleiter, $mannschaftsfuehrer);
        $auth->addChild($executive, $turnierleiter);
        $auth->addChild($executive, $gastronomie);
        $auth->addChild($executive, $trainer);
        $auth->addChild($admin, $executive);
        $auth->addChild($admin, $schatzmeister);

        echo "RBAC roles have been updated.\n";
    }
}
