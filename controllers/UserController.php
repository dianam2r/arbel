<?php

namespace app\controllers;

use Yii;
use linslin\yii2\curl;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new User();
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
        $response = $curl->get(Yii::$app->params['searchUser'] . '?keyword=' . $keywords);
        $records = json_decode($response, true);

        foreach($records as $users){
            if($users == 'No users found.') {
                $results = $users;
                break;
            }

            foreach ($users as $user) {
                $results[] = $user;
            }
        }

        if(is_array($results)) {
            Yii::$app->view->params['resultData'] = true;
            $dataProvider = new ArrayDataProvider([
                'key' => 'id',
                'allModels' => $results,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'attributes' => ['id', 'name', 'last_name','team_name','username'],
                ],
            ]);
        } else {
            $data['result'] = $results;
            $dataProvider = new ArrayDataProvider([
                'allModels' => $data,
            ]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

         //Init curl
         $curl = new curl\Curl();
 
         // GET request to api
         $response = $curl->get(Yii::$app->params['showUser'] . '?id=' . $id);
 
         $record = json_decode($response, true);
 
         $model = new User([
             'id' => $record['id'],
             'name' => $record['name'],
             'last_name' => $record['last_name'],
             'group_id' => $record['team'],
             'username' => $record['username'],
             'created_at' => $record['created_at'],
             'updated_at' => $record['updated_at'],
         ]);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        Yii::$app->view->params['editing'] = false;

        //Init curl
        $curl = new curl\Curl();

        // POST request to api
        if ($model->load(Yii::$app->request->post())) {
            $response = $curl->setRawPostData(
                json_encode([
                    'name' => $model['name'],
                    'last_name' => $model['last_name'],
                    'group_id' => $model['group_id'],
                    'username' => $model['username'],
                    'password' => $model['password']
                ]))
                ->post(Yii::$app->params['createUser']);

            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        Yii::$app->view->params['editing'] = true;

        //Init curl
        $curl = new curl\Curl();

        if ($model->load(Yii::$app->request->post())) {
            $response = $curl->setRawPostData(
                json_encode([
                    'id' => $id,
                    'name' => $model['name'],
                    'last_name' => $model['last_name'],
                    'group_id' => $model['group_id'],
                    'username' => $model['username'],
                    //'password' => $model['password']
                ]))
                ->post(Yii::$app->params['updateUser']);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
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
                ->post(Yii::$app->params['deleteUser']);

            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        };
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*
     * Simple list of users by name and last name
     */
    public static function listUsers()
    {
        //Init curl
        $curl = new curl\Curl();

        // GET request to api
        $response = $curl->get(Yii::$app->params['listUsers']);

        $records = json_decode($response,  true);

        foreach($records as $users){
            foreach($users as $user){
                $list[$user['id']] = $user['name'] . ' ' . $user['last_name'];
            }
        }

        return $list;
    }

    /*
     * Renders view in modal through ajax
     */
    public function actionSearch()
    {
        $model = new User(['scenario' => User::SCENARIO_SEARCH]);

        return $this->renderAjax('search', [
            'model' => $model,
        ]);
    }
}
