<?php

namespace app\controllers;

use Yii;
use linslin\yii2\curl;
use app\models\Task;
use app\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public static function actionIndex()
    {
        //Init curl
        $curl = new curl\Curl();

        // GET request to api
        $response = $curl->get(Yii::$app->params['listTasks']);

        return json_decode($response,  true);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        //Init curl
        $curl = new curl\Curl();

        // GET request to api
        $response = $curl->get(Yii::$app->params['showTask'] . '?id=' . $id);

        $record = json_decode($response, true);

        $model = new Task([
            'id' => $record['id'],
            'title' => $record['title'],
            'description' => $record['description'],
            'estimated_points' => $record['estimated_points'],
            'attached_file' => $record['attached_file'],
            'assigned_to' => $record['assigned_to'],
            'status_id' => $record['task_status'],
            'created_at' => $record['created_at'],
            'created_by' => $record['created_by'],
            'updated_at' => $record['updated_at'],
            'updated_by' => $record['updated_by']
        ]);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();
        $userList = UserController::listUsers();
        Yii::$app->view->params['userList'] = $userList;

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    public function actionSave()
    {
        $model = new Task();
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        //Init curl
        $curl = new curl\Curl();

        // POST request to api
        if ($model->load(Yii::$app->request->post())) {
            $response = $curl->setRawPostData(
                json_encode([
                    'title' => $model['title'],
                    'description' => $model['description'],
                    'estimated_points' => $model['estimated_points'],
                    'assigned_to' => $model['assigned_to'],
                    'status_id' => $model['status_id'],
                    'created_by' => Yii::$app->user->id,
                    'updated_by' => Yii::$app->user->id
                ]))
                ->post(Yii::$app->params['createTask']);

            $this->redirect(Yii::$app->urlManager->createUrl('task/list'));
        }
    }

    /* 
     * Renders to a view with a grid of tasks
     */
    public function actionList()
    {
        $model = new Task();
        $keywords = "";
        $results = [];

        //Init curl
        $curl = new curl\Curl();

        if ($model->load(Yii::$app->request->get())) {
            foreach ($model as $attribute) {
                if ($attribute) {
                    // Replace space for separation caracter in case there's more than one word
                    // in the attribute searched
                    $keywords .= str_replace(' ', '|', $attribute) . '|';
                }
            }
        }
        
        $keywords = rtrim($keywords,'|');

        // GET request to api
        $response = $curl->get(Yii::$app->params['searchTask'] . '?keyword=' . $keywords);
        $records = json_decode($response, true);

        foreach($records as $tasks){
            foreach($tasks as $task){
                $results[] = $task;
            }
        }

        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $results,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['id', 'title', 'description','estimated_points','assigned_to', 'task_status'],
            ],
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $users = UserController::listUsers();
        Yii::$app->view->params['users'] = $users;

        //Init curl
        $curl = new curl\Curl();

        // POST request to api
        if ($model->load(Yii::$app->request->post())) {
            $response = $curl->setRawPostData(
                json_encode([
                    'id' => $id,
                    'title' => $model['title'],
                    'description' => $model['description'],
                    'estimated_points' => $model['estimated_points'],
                    'attached_file' => $model['attached_file'],
                    'assigned_to' => $model['assigned_to'],
                    'status_id' => $model['status_id'],
                    'updated_by' => Yii::$app->user->id
                ]))
                ->post(Yii::$app->params['editTask']);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        //Init curl
        $curl = new curl\Curl();

        // POST request to api
        if($model && Yii::$app->request->post()) {
            $response = $curl->setRawPostData(
                json_encode([
                    'id' => $id
                ]))
                ->post(Yii::$app->params['deleteTask']);

            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        };
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSearch()
    {
        $model = new Task(['scenario' => Task::SCENARIO_SEARCH]);

        return $this->renderAjax('search', [
            'model' => $model,
        ]);
    }
}
