<?php

namespace frontend\controllers;

use app\models\CmContent;
use app\models\CmContentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\BadRequestHttpException;;

/**
 * CmContentController implements the CRUD actions for CmContent model.
 */
class CmContentController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all CmContent models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CmContentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmContent model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CmContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CmContent();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CmContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CmContent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CmContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CmContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmContent::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionSwitchStateAction()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            // Log the received data
            Yii::info("Received AJAX data: " . print_r($data, true), __METHOD__);
            $contentId = $data['contentId'];  // Retrieve the content ID sent from AJAX
            
            // Log the content ID
            Yii::info("Content ID: " . $contentId, __METHOD__);

            // Find the content item and switch its state
            $contentItem = CmContent::findOne($contentId);
            if ($contentItem) {
                // Switch logic, e.g., swap title and body
                $temp = $contentItem->title;
                $contentItem->title = $contentItem->body;
                $contentItem->body = $temp;

                if ($contentItem->save()) {
                    // Return the new state
                    return json_encode(['newState' => $contentItem->title]);
                }
            }

            return json_encode(['error' => 'Content not found or update failed']);
        }

        throw new BadRequestHttpException('Invalid request');
    }
}
