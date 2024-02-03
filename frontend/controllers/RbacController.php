<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * Administrator area controller
 */
class RbacController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'AdministratorsLayout'; // Set the layout
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['permissions', 'menuItem2', 'menuItem3', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Provide data for user and roles assignment dialog
     */
    public function actionIndex()
    {
        $users = User::find()->all();
        $userRoles = [];
        $roleHierarchy = $this->getAllRolesWithChildren();
        foreach ($users as $user) {
            $roles = Yii::$app->authManager->getRolesByUser($user->id);
            $userRoles[$user->id] = [
                'id' => $user->id, // Ensure this line is present
                'username' => $user->username,
                'roles' => ArrayHelper::getColumn($roles, 'name'),
            ];
        }

        return $this->render('index', ['userRoles' => $userRoles, 'roleHierarchy' => $roleHierarchy],);
    }

    /**
     * Assign roles to user
     */
    public function actionAssignRole()
    {
        $userId = Yii::$app->request->post('userId');
        $roleNames = Yii::$app->request->post('roleNames'); // Assuming 'roleNames' is an array of role names

        $authManager = Yii::$app->authManager;

        // Begin transaction
        $transaction = Yii::$app->db->beginTransaction();

        try {
            // Clear existing assignments
            $authManager->revokeAll($userId);

            foreach ($roleNames as $roleName) {
                $role = $authManager->getRole($roleName);
                if ($role) {
                    $authManager->assign($role, $userId);
                }
            }

            // Commit transaction
            $transaction->commit();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['status' => 'success', 'message' => 'Roles assigned successfully'];
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['status' => 'error', 'message' => 'Error assigning roles. Rolled back.'];
        }
    }
    public function getAllRolesWithChildren()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $roleHierarchy = [];

        foreach ($roles as $role) {
            $roleHierarchy[$role->name] = $this->getRecursiveChildren($role->name, $auth);
        }

        return $roleHierarchy;
    }

    private function getRecursiveChildren($roleName, $authManager, &$children = [])
    {
        $directChildren = $authManager->getChildren($roleName);
        foreach ($directChildren as $child) {
            $children[$child->name] = $this->getRecursiveChildren($child->name, $authManager, $children);
        }
        return array_keys($children);
    }
}
